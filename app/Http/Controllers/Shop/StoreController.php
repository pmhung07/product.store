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

        // Metadata
        $this->metadata->title = 'Hệ thống cửa hàng';
        $this->metadata->description = 'Hệ thống cửa hàng';
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = route('shop.store.index');
        $metadata = $this->metadata->toArray();

        return view('shop/store/index', compact('stores', 'products', 'metadata'));
    }

    public function getDetail($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('parent_id', 0)->orderBy('updated_at', 'DESC')->take(5)->get();

        // Metadata
        $this->metadata->title = $store->name;
        $this->metadata->description = $store->name;
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = route('shop.store.detail', $id);
        $metadata = $this->metadata->toArray();

        return view('shop/store/detail', compact('store', 'products', 'metadata'));
    }
}
