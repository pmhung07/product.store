<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends ShopController
{
    public function getIndex(Request $request)
    {
        $q = clean($request->get('q'));
        $products = Product::where('name', 'LIKE', '%'. $q .'%')->orderBy('updated_at', 'DESC')->take(20)->get();
        return view('shop/search/index', compact('products', 'q'));
    }
}
