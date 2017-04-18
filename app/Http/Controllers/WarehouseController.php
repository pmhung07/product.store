<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\WarehouseRequest;

use App\Warehouse;
use App\WarehouseInventory;
use DB;

class WarehouseController extends Controller
{

	public function getIndex(Request $request){
    	$sort='id';
		$order='desc';
		$rows = Warehouse::select('warehouse.*','users.name as user_name','users_position.name as users_position_name',DB::raw('SUM(warehouse_inventory.quantity) as quantity_inventory'),DB::raw('SUM(warehouse_inventory.price * warehouse_inventory.quantity) as total_price_inventory'))
                ->join('users', 'users.id', '=', 'warehouse.admin_id')
                ->leftjoin('users_position', 'users_position.id', '=', 'users.user_position_id')
                ->leftjoin('warehouse_inventory', 'warehouse_inventory.warehouse_id', '=', 'warehouse.id');

        $sum_total_price = WarehouseInventory::select(DB::raw('SUM(price * quantity) as total_price'), DB::raw('SUM(quantity) as total_quantity'))->join('warehouse', 'warehouse.id', '=', 'warehouse_inventory.warehouse_id');

        if ($request->has('name')){
            $rows = $rows->where('warehouse.name', 'LIKE', '%'.$request->input("name").'%');
            $sum_total_price = $sum_total_price->where('warehouse.name', 'LIKE', '%'.$request->input("name").'%');
        }
        if ($request->has('code')){
            $rows = $rows->where('warehouse.code', 'LIKE', '%'.$request->input("code").'%');
            $sum_total_price = $sum_total_price->where('warehouse.code', 'LIKE', '%'.$request->input("code").'%');
        }

        $sum_total_price = $sum_total_price->first();

		$data=$rows->orderBy($sort,$order)->groupBy('warehouse.id')->paginate(20);//->with('category', 'brand')->paginate(10);
		return view('admin.stock.index',['rows' => $data,'sum_total_price' => $sum_total_price]);//, ['rows' => $data]);
    }

	public function getCreate(){
    	return view('admin.stock.create');
    }

    public function postCreate(WarehouseRequest $request){
    	$warehouse = new Warehouse();
    	$warehouse->name = $request->name;
    	$warehouse->code = $request->code;
    	$warehouse->address = $request->address;
    	$warehouse->save();
    	return redirect()->route('admin.stock.getCreate')->with(['flash_message' => 'Thêm kho hàng thành công!']);
    }

    public function getUpdate($id){
        $data = Warehouse::find($id)->toArray();
        //$inventoryProduct = DB::table('warehouse_inventory')
          //                  ->where('warehouse_ph_id','=',$key)->sum('quantity') $total_order[0]->total_sales
        $inventory_in_stock = DB::table('warehouse_inventory')
                ->select('product.name as iven_product_name',DB::raw('SUM(quantity) as iven_total_quantity'), DB::raw('SUM(warehouse_inventory.price * warehouse_inventory.quantity) as iven_total_price'))
                ->join('product','warehouse_inventory.product_id','=','product.id')
                ->groupBy('warehouse_inventory.product_id')
                ->where('warehouse_id','=',$id)
                ->get();
        return view('admin.stock.update',compact('data','inventory_in_stock'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'name' => 'required',
				'code' => 'required',
				'address' => 'required',
	        ],
            [
				'name.required' => 'Vui lòng nhập tên kho hàng!',
				'code.required' => 'Vui lòng nhập mã kho hàng!',
				'address.required' => 'Vui lòng nhập địa chỉ kho hàng!',
             ]
        );
        $warehouse = new Warehouse();
        $warehouse = Warehouse::find($id);
    	$warehouse->name = $request->name;
    	$warehouse->code = $request->code;
    	$warehouse->address = $request->address;
    	$warehouse->save();
        return redirect()->route('admin.stock.index')->with(['flash_message' => 'Cập nhật kho hàng thành công!']);
    }

    public function getDelete($id){
        $data = Warehouse::find($id);
        $data->delete($id);
        return redirect()->route('admin.stock.index')->with(['flash_message' => 'Xoá kho hàng thành công!']);    
    }

}
