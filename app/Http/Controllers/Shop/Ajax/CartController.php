<?php

namespace App\Http\Controllers\Shop\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Coupon;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getHtmlCartInOrderPage(Request $request)
    {
        $cartItems = Cart::content();
        $couponCode = clean($request->get('coupon'));

        // Kiểm tra mã giảm giá nếu có
        $coupon = Coupon::where('code', $couponCode)->first();

        // Tổng giá trị đơn hàng
        $totalPrice = to_numberic(Cart::subtotal(0,'.','.'));

        foreach($cartItems as $item) {
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

        return view('shop/order/ajax-cart', compact('cartItems', 'totalPrice'));
    }
}
