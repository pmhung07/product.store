<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use App\Properties;
use App\Provinces;
use App\Warehouse;
use App\WarehouseInventory;
use Illuminate\Http\Request;

class ProductController extends ShopController
{

    /**
     * Chi tiết sản phẩm
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
    public function getDetail($id, $slug)
    {
        $product = Product::with('category', 'images')->findOrFail($id);

        // Cửa hàng bán sản phẩm
        $warehouses = Warehouse::join('warehouse_inventory', 'warehouse.id', '=', 'warehouse_id')
                            ->with('province', 'district')
                            ->where('warehouse_inventory.product_id', $id)
                            ->select('warehouse.*')
                            ->get();


        // Thành phố
        $provinces = Provinces::with('districts')->whereIn('id', $warehouses->pluck('province_id')->toArray())->get();

        // Variant
        $properties = Properties::with('values')->where('product_id', $id)->get();

        return view('shop/product/detail', compact('product', 'warehouses', 'provinces', 'properties'));
    }


    public function ajaxHtmlStockItem(Request $request)
    {
        $productId = (int) $request->get('product_id');
        $provinceId = (int) $request->get('province_id');

        // Cửa hàng bán sản phẩm
        $queryWarehouses = Warehouse::join('warehouse_inventory', 'warehouse.id', '=', 'warehouse_id')
                            ->with('province', 'district')
                            ->where('warehouse_inventory.product_id', $productId)
                            ->select('warehouse.*');

        if($provinceId > 0) {
            $queryWarehouses->where('warehouse.province_id', $provinceId);
        }

        $warehouses = $queryWarehouses->get();

        $responseHTML = '';
        foreach($warehouses as $item) {
            $responseHTML .= view('shop/product/stock_item', ['stock' => $item])->render();
        }

        return $responseHTML;
    }
}
