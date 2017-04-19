<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Orders;
use App\Product;

class HomeController extends ShopController {

    public function getIndex()
    {
        // Sản phẩm hot
        $hotProducts = Product::join('order_details', 'product.id', '=', 'order_details.product_id')
                              ->join('orders', 'order_details.order_id', '=', 'orders.id')
                              ->where('order_status', Orders::STATUS_SUCCESS)
                              ->where('payment_status', Orders::PAYMENT_STATUS_SUCCESS)
                              ->orderBy('order_details.quantity', 'DESC')
                              ->take(5)
                              ->get();

        // Sản phẩm mới trong tuần
        $sevenDayAgo = date('Y-m-d 00:00:00', strtotime('-7 days'));
        $today = date('Y-m-d 23:59:59');
        $newestProductsInWeek = Product::take(15)->whereBetween('created_at', [$sevenDayAgo, $today])->orderBy('created_at', 'DESC')->get();

        return view('shop/home/index', compact('hotProducts', 'newestProductsInWeek'));
    }
}