<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;
use App\WarehouseInventory;
use App\Units;
use App\Inventory;
use App\ProductGroup;

use DB;

class WarehouseInventoryController extends Controller
{
    public function getIndex(Request $request){
    	
		$sort='id';
		$order='desc';

		$product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

		$rows = WarehouseInventory::select('warehouse_inventory.*')
				->join('product', 'product.id', '=', 'warehouse_inventory.product_id')
				->join('product_group', 'product_group.id', '=', 'product.product_group_id');

		$sum_total_price = WarehouseInventory::select(DB::raw('SUM(warehouse_inventory.price * warehouse_inventory.quantity) as total_price'), DB::raw('SUM(warehouse_inventory.quantity) as total_quantity'))
				->join('product', 'product.id', '=', 'warehouse_inventory.product_id')
				->join('product_group', 'product_group.id', '=', 'product.product_group_id');

		if ($request->has('product')){
			$rows = $rows->where('product.name', 'LIKE', '%'.$request->input("product").'%');
			$sum_total_price = $sum_total_price->where('product.name', 'LIKE', '%'.$request->input("product").'%');
		}

		if ($request->has('product-group') && $request->GET('product-group') != -1){
            $rows = $rows->where('product_group.id',$request->GET("product-group"));
            $sum_total_price = $sum_total_price->where('product_group.id', $request->GET("product-group"));
        }

        $sum_total_price = $sum_total_price->first(); 

		$data = $rows->groupBy('warehouse_inventory.product_id')->orderBy($sort,$order)->with('product')->paginate(10);
		return view('admin.inventory.index', ['rows' => $data, 'product_group' => $product_group, 'sum_total_price' => $sum_total_price]);

		
    }
}
