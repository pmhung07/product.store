<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Orders;
use App\Product;
use App\ShopPost;

class HomeController extends ShopController {

    public function getIndex()
    {
        // Slider
        $slideItems = [
            'https://file.hstatic.net/1000003969/file/banner-web-collection-ngoctrinh-fix2.jpg',
            'https://file.hstatic.net/1000003969/file/banner-web-876cmt8.jpg',
            '/shop/assets/file.hstatic.net/1000003969/file/sd01034-banner-web-fix.jpg'
        ];

        // Sản phẩm hot
        $hotProducts = Product::join('order_details', 'product.id', '=', 'order_details.product_id')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        // ->where('order_status', Orders::STATUS_SUCCESS)
                        // ->where('payment_status', Orders::PAYMENT_STATUS_SUCCESS)
                        ->orderBy('order_details.quantity', 'DESC')
                        ->take(8)
                        ->get();

        // Sản phẩm mới trong tuần
        $sevenDayAgo = date('Y-m-d 00:00:00', strtotime('-7 days'));
        $today = date('Y-m-d 23:59:59');
        $newestProductsInWeek = Product::take(15)
                                       // ->whereBetween('created_at', [$sevenDayAgo, $today])
                                       ->orderBy('created_at', 'DESC')->get();

        // Tin tức
        $posts = ShopPost::take(5)->with('category')->orderByRaw('RAND()')->get();

        return view('shop/home/index', compact('hotProducts', 'newestProductsInWeek', 'posts', 'slideItems'));
    }
}