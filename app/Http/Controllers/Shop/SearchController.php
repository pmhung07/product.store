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

        $this->metadata->title = 'Tìm kiếm sản phẩm, tra cứu thông tin';
        $this->metadata->description = 'Kết quả tìm kiếm với từ khóa '.$q;
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = $request->url();
        $metadata = $this->metadata->toArray();

        return view('shop/search/index', compact('products', 'q', 'metadata'));
    }
}
