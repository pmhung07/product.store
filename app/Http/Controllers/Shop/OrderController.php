<?php

namespace App\Http\Controllers\Shop;

use App\Customers;
use App\Districts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Shop\OrderFormRequest;
use App\OrderDetails;
use App\Orders;
use App\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Cart;

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
        // _debug($resp->isSuccess());die;
        if ($resp->isSuccess()) {
            // Lưu thông tin khách hàng
            $customer = new Customers;
            $customer->province_id = (int) $request->get('city_id');
            $customer->district_id = (int) $request->get('district_id');
            $customer->name = clean($request->get('customer_name'));
            $customer->phone = clean($request->get('customer_phone'));
            $customer->email = clean($request->get('customer_email'));
            $customer->address = clean($request->get('customer_address'));
            $customer->save();

            // Lưu thông tin đơn hàng
            $order = new Orders;
            $order->customer_id = $customer->id;
            $order->order_status = 0;
            $order->status = 1;
            $order->total_price = to_numberic(Cart::subtotal(0,'.','.'));
            $order->code = Orders::generateCode();
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

            return redirect()->to('/thank.html');
        }

        return redirect()->back()->withInput()->with('error', 'Gửi đơn hàng không thành công, vui lòng thử lại');
    }

    public function getThank()
    {
        return view('shop/order/success');
    }
}
