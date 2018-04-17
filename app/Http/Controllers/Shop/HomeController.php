<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Orders;
use App\Product;
use App\ShopPost;
use App\ShopPostSuggest;

class HomeController extends ShopController {

    public function getIndex()
    {
        $slideItems = Banner::where('page', 'home')
                            ->where('position', 'top')
                            ->where('status', 1)
                            ->orderBy('created_at', 'DESC')
                            ->get();

        $footerImg = Banner::where('page', 'home')
                            ->where('position', 'bottom')
                            ->where('status', 1)
                            ->orderBy('created_at', 'DESC')
                            ->get();

        // Sản phẩm hot
        $hotProducts = Product::join('order_details', 'product.id', '=', 'order_details.product_id')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('parent_id', 0)
                        // ->where('order_status', Orders::STATUS_SUCCESS)
                        // ->where('payment_status', Orders::PAYMENT_STATUS_SUCCESS)
                        ->orderBy('order_details.quantity', 'DESC')
                        ->select('product.*')
                        ->groupBy('product.id')
                        ->take(8)
                        ->get();

        // Kien thuc phong thuy thiet yeu
        $postSuggest = ShopPostSuggest::take(5)->orderByRaw('RAND()')->get();

        $hotProducts = $newestProductsInWeek = Product::take(5)->where('parent_id', 0)
                                       // ->whereBetween('created_at', [$sevenDayAgo, $today])
                                       ->orderByRaw('RAND()')->get();

        // Sản phẩm mới trong tuần
        $sevenDayAgo = date('Y-m-d 00:00:00', strtotime('-7 days'));
        $today = date('Y-m-d 23:59:59');
        $newestProductsInWeek = Product::take(6)->where('parent_id', 0)
                                       // ->whereBetween('created_at', [$sevenDayAgo, $today])
                                       ->orderBy('created_at', 'DESC')->get();

        // Tin tức
        $posts = ShopPost::take(5)->with('category')->orderByRaw('RAND()')->get();

        // Ý kiến khách hàng
        $testimonials = Testimonial::orderBy('created_at', 'DESC')->take(10)->get();

        // Metadata
        $this->metadata->title = $this->setting->meta_title ? $this->setting->meta_title : url('/');
        $this->metadata->description = $this->setting->meta_description ? $this->setting->meta_description : url('/');
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = url('/');
        $metadata = $this->metadata->toArray();

        return view('shop/home/index', compact('hotProducts', 'newestProductsInWeek', 'posts', 'slideItems', 'testimonials', 'metadata', 'footerImg', 'postSuggest'));
    }
}