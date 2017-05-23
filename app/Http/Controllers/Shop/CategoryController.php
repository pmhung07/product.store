<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;

class CategoryController extends ShopController
{

    public function getProducts($id, $slug, Request $request)
    {
        $category = ProductGroup::findOrFail($id);

        // Tìm tất cả con của nó
        $categoriesId = [$id];
        $categoryChilds = ProductGroup::where('parent_id', $id)->lists('id');
        foreach($categoryChilds as $childId) {
            $categoriesId[] = $childId;
        }

        // $products = Product::whereIn('product_group_id', $categoriesId)->take(20)->orderBy('updated_at', 'DESC')->get();

        $products = Product::join('products_groups', 'product.id', '=', 'products_groups.product_id')
                            ->whereIn('products_groups.group_id', $categoriesId)
                            ->select('product.*')
                            ->groupBy('product.id')
                            ->take(20)
                            ->orderBy('updated_at', 'DESC')
                            ->get();

        $this->metadata->title = $category->name;
        $this->metadata->description = $category->name;
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = $request->url();
        $metadata = $this->metadata->toArray();

        return view('shop/product_category/products', compact('category', 'products', 'metadata'));
    }
}
