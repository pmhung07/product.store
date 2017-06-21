<?php

namespace App\Http\Controllers\Shop;

use App\AffiliateProduct;
use App\AffiliateUserProduct;
use App\Customers;
use App\Districts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Shop\OrderFormRequest;
use App\Models\AffiliateUserOrderDetail;
use App\Models\Coupon;
use App\OrderDetails;
use App\Orders;
use App\Product;
use App\Provinces;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Cookie;

class OrderController extends ShopController
{

    public function getIndex(Request $request)
    {
        $provinces = Provinces::orderBy('name', 'ASC')->get();
        $districts = new Collection;

        if($provinceId = (int) $request->old('city_id')) {
            $districts = Districts::where('province_id', $provinceId)->get();
        }

        return view('shop/order/index', compact('provinces', 'districts'));
    }

    public function postIndex(OrderFormRequest $request)
    {
        $gRecaptchaResponse = $request->get('g-recaptcha-response');
        $remoteIp = get_client_ip();
        $secret = config('google-recapcha.secret');
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

        if ($resp->isSuccess()) {
            // Lưu thông tin khách hàng
            $phone = clean($request->get('customer_phone'));
            $exist = Customers::where('phone', $phone)->first();
            if(!$exist) {
                $customer = new Customers;
            } else {
                $customer = $exist;
            }
            $customer->province_id = (int) $request->get('city_id');
            $customer->district_id = (int) $request->get('district_id');
            $customer->name = clean($request->get('customer_name'));
            $customer->phone = clean($request->get('customer_phone'));
            $customer->email = clean($request->get('customer_email'));
            $customer->address = clean($request->get('customer_address'));
            $customer->save();

            // Tổng giá trị đơn hàng
            $totalPrice = to_numberic(Cart::subtotal(0,'.','.'));

            $couponCode = clean($request->get('coupon'));
            // Kiểm tra mã giảm giá nếu có
            $coupon = Coupon::where('code', $couponCode)->first();

            foreach(Cart::content() as $item) {
                if($coupon) {
                    switch ($coupon->type) {
                        case Coupon::TYPE_PRODUCT:
                            $productIds = $coupon->decodeData();
                            foreach($productIds as $pid) {
                                if($item->id == $pid) {
                                    if($coupon->type_value == Coupon::VALUE_IS_VALUE) {
                                        $item->price -= $coupon->value;
                                        if($item->price < 0) $item->price = 0;
                                    }
                                    elseif($coupon->type_value == Coupon::VALUE_IS_PERCENT) {
                                        $item->price -= ($item->price * $coupon->value / 100);
                                        if($item->price < 0) $item->price = 0;
                                    }
                                }
                            }
                            break;

                        case Coupon::TYPE_PRODUCT_GROUP:
                            $productGroupIds = $coupon->decodeData();
                            $_products = Product::whereIn('product_group_id', $productGroupIds)->get();
                            foreach($_products as $pItem) {
                                if($item->id == $pItem->id) {
                                    if($coupon->type_value == Coupon::VALUE_IS_VALUE) {
                                        $item->price -= $coupon->value;
                                        if($item->price < 0) $item->price = 0;
                                    }
                                    elseif($coupon->type_value == Coupon::VALUE_IS_PERCENT) {
                                        $item->price -= ($item->price * $coupon->value / 100);
                                        if($item->price < 0) $item->price = 0;
                                    }
                                }
                            }
                            break;

                        case Coupon::TYPE_ORDER_VALUE:
                            if($coupon->type_value == Coupon::VALUE_IS_VALUE) {
                                $totalPrice -= $coupon->value;
                                if($totalPrice < 0) $totalPrice = 0;
                            }
                            elseif($coupon->type_value == Coupon::VALUE_IS_PERCENT) {
                                $totalPrice -= ($totalPrice * $coupon->value / 100);
                                if($totalPrice < 0) $totalPrice = 0;
                            }
                            break;

                        default:
                            break;
                    }
                }
            }

            // Lưu thông tin đơn hàng
            $order = new Orders;
            $order->customer_id = $customer->id;
            $order->order_status = 0;
            $order->status = 1;
            $order->total_price = $totalPrice;
            $order->code = Orders::generateCode();
            $order->coupon = $couponCode;
            $order->save();

            // Lưu đơn hàng chi tiết
            foreach(Cart::content() as $item) {
                $orderDetail = new OrderDetails;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item->id;
                $orderDetail->quantity = $item->qty;
                $orderDetail->price = $item->price;
                $orderDetail->total_price = $item->qty * $item->price;
                $orderDetail->save();
            }

            Cart::destroy();

            // Send email
            $paramsSetToMailTemplate = [
                'order' => $order,
                'orderDetail' => $order->details()->with('product')->get()
            ];
            $configEmail = config('mail.from');
            \Mail::send('shop/mail/order', $paramsSetToMailTemplate , function ($m) use ($order, $orderDetail, $customer, $configEmail) {
                $m->from($configEmail['address'], $configEmail['name']);
                $m->to($customer->email, $customer->name)->subject('Đơn hàng tại '.$_SERVER['SERVER_NAME']);
            });


            $orderDetailItems = OrderDetails::where('order_id', $order->id)->get();

            // Kiểm tra có sp affiliate thì lưu vào cho thằng làm affilate nó thống kê và tính toán
            $affilitateUserProductId = (int) Cookie::get('affiliate_user_product');

            if( $affilitateUserProductId )
            {
                $affiliateUserProduct = AffiliateUserProduct::where('id', $affilitateUserProductId)->first();

                if( $affiliateUserProduct )
                {
                    $affilateProduct = AffiliateProduct::where('product_id', $affiliateUserProduct->product_id)->first();
                }
            }

            foreach($orderDetailItems as $item) {
                // Lấy cấu hình % hoa hồng
                if( isset($affilateProduct) && $affilateProduct->product_id == $item->product_id )
                {
                    $affiliateUserOrderDetail = new AffiliateUserOrderDetail();
                    $affiliateUserOrderDetail->affiliate_user_product_id = $affilitateUserProductId;
                    $affiliateUserOrderDetail->order_id = $order->id;
                    $affiliateUserOrderDetail->order_detail_id = $item->id;
                    $affiliateUserOrderDetail->product_id = $item->product->id;
                    $affiliateUserOrderDetail->merchant_id = 0;
                    $affiliateUserOrderDetail->quantity = $item->quantity;
                    $affiliateUserOrderDetail->price = $item->price;
                    $affiliateUserOrderDetail->money = $item->quantity*$item->price;
                    $affiliateUserOrderDetail->profit = $affilateProduct->profit;

                    $affiliateUserOrderDetail->save();
                }
            }

            // Clear cookie affiliate
            \Cookie::queue(\Cookie::forget('affiliate_user_product'));

            return redirect()->to('/thank.html');
        }

        return redirect()->back()->withInput()->with('error', 'Gửi đơn hàng không thành công, vui lòng thử lại');
    }

    public function getThank()
    {
        $metadata = $this->metadata;
        return view('shop/order/success', compact('metadata'));
    }
}
