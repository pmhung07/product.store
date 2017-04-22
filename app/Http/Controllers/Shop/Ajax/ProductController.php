<?php

namespace App\Http\Controllers\Shop\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getQuickView(Request $request)
    {
        $productId = (int) $request->get('product_id');
        $product = Product::findOrFail($productId);

        return view('shop/product/quickview', compact('product'));
    }
}
