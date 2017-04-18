<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Product;

class HomeController extends ShopController {

    public function getIndex()
    {
        $hotProducts = Product::take(5)->orderByRaw('RAND()')->get();

        $newestProductsInWeek = Product::take(15)->orderByRaw('RAND()')->get();

        return view('shop/home/index', compact('hotProducts', 'newestProductsInWeek'));
    }
}