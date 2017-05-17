<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Store;
use App\Product;
use Illuminate\Http\Request;

class StoreController extends ShopController
{

    public function getIndex()
    {
        $stores = Store::orderBy('name', 'ASC')->get();
        $products = Product::where('parent_id', 0)->orderBy('updated_at', 'DESC')->take(5)->get();
        return view('shop/store/index', compact('stores', 'products'));
    }

    public function getDetail($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('parent_id', 0)->orderBy('updated_at', 'DESC')->take(5)->get();
        return view('shop/store/detail', compact('store', 'products'));
    }
}
