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

        // Tìm tất cả con của nó
        $categoriesId = [$id];
        $categoryChilds = ProductGroup::where('parent_id', $id)->lists('id');
        foreach($categoryChilds as $childId) {
            $categoriesId[] = $childId;
        }

        $products = Product::whereIn('product_group_id', $categoriesId)->take(20)->orderBy('updated_at', 'DESC')->get();

        return view('shop/product_category/products', compact('category', 'products'));
    }
}
