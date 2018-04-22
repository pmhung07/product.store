<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Store;
use App\Product;
use App\Properties;
use App\Provinces;
use App\Warehouse;
use App\WarehouseInventory;
use App\ShopPostSuggest;
use Illuminate\Http\Request;
use Cookie;

class ProductController extends ShopController
{

    /**
     * Chi tiết sản phẩm
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
    public function getDetail($id, $slug, Request $request)
    {
        $product = Product::with('category', 'images')->findOrFail($id);

        // Cửa hàng bán sản phẩm
        // $warehouses = Warehouse::join('warehouse_inventory', 'warehouse.id', '=', 'warehouse_id')
        //                     ->with('province', 'district')
        //                     ->where('warehouse_inventory.product_id', $id)
        //                     ->select('warehouse.*')
        //                     ->get();

        $warehouses = Store::with('province', 'district')->orderBy('name', 'ASC')->get();

        // Thành phố
        $provinces = Provinces::with('districts')->whereIn('id', $warehouses->pluck('province_id')->toArray())->get();

        // Options
        $properties = Properties::with('values')->where('product_id', $id)->get();

        // Sản phẩm có thể bạn quan tâm
        $relatedProducts = Product::where('product_group_id', $product->product_group_id)->whereNotIn('id',[$product->id])->orderBy('updated_at', 'DESC')->take(10)->get();

        $relatedPosts = ShopPostSuggest::where('product_group_id', $product->product_group_id)->orderBy('updated_at', 'DESC')->take(10)->get();

        // Metadata
        $this->metadata->title = $product->name;
        $this->metadata->description = substr(strip_tags($product->content), 0, 200);
        $this->metadata->image = $product->image ? url(parse_image_url($product->image)) : '';
        $this->metadata->url = $product->getUrl();
        $metadata = $this->metadata->toArray();

        // Nếu là sp affilitate
        $affilitateUserProductId = (int) Cookie::get('affiliate_user_product');
        if( $affilitateUserProductId )
        {

        }

        return view('shop/product/detail', compact('product', 'warehouses', 'provinces', 'properties', 'relatedProducts', 'metadata', 'relatedPosts'));
    }


    public function ajaxHtmlStockItem(Request $request)
    {
        $productId = (int) $request->get('product_id');
        $provinceId = (int) $request->get('province_id');

        // Cửa hàng bán sản phẩm
        // $queryWarehouses = Warehouse::join('warehouse_inventory', 'warehouse.id', '=', 'warehouse_id')
        //                     ->with('province', 'district')
        //                     ->where('warehouse_inventory.product_id', $productId)
        //                     ->select('warehouse.*');

        // if($provinceId > 0) {
        //     $queryWarehouses->where('warehouse.province_id', $provinceId);
        // }

        // $warehouses = $queryWarehouses->get();

        $query = Store::with('district');
        if($provinceId) {
            $query->where('province_id', $provinceId)->get();
        }

        $stores = $query->get();

        $responseHTML = '';
        foreach($stores as $item) {
            $responseHTML .= view('shop/product/stock_item', ['stock' => $item])->render();
        }

        return $responseHTML;
    }
}
