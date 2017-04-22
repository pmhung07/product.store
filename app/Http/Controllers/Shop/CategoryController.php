<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;

class CategoryController extends ShopController
{

    public function getProducts($id, $slug)
    {
        $category = ProductGroup::findOrFail($id);
        $products = Product::where('product_group_id', $id)->take(20)->orderBy('updated_at', 'DESC')->get();

        return view('shop/product_category/products', compact('category', 'products'));
    }
}
