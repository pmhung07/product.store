<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\WarehouseTransferPh;
use App\Warehouse;
use App\WarehouseTransferPhDetails;
use App\Product;
use App\WarehouseInventory;

class WarehouseTransferPhController extends Controller
{
    public function getIndex(Request $request){

        $warehouse = Warehouse::select('id','name')->get();

    	$sort='created_at';
		$order='desc';
		$rows = WarehouseTransferPh::select('warehouse_transfer_ph.*','users.id as user_id','users.name as user_name','users_position.name as users_position_name')
                                ->join('users', 'users.id', '=', 'warehouse_transfer_ph.admin_id')
                                ->leftjoin('users_position', 'users_position.id', '=', 'users.user_position_id');;

		if ($request->has('wareph_name')){
			$rows = $rows->where('warehouse_transfer_ph.name', 'LIKE', '%'.$request->input("wareph_name").'%');
		}
		if ($request->has('wareph_code')){
			$rows = $rows->where('warehouse_transfer_ph.code', 'LIKE', '%'.$request->input("wareph_code").'%');
		}
		if ($request->has('warehouse_name')){
			$rows = $rows->where('warehouse.id', '=', $request->input("warehouse_name"));
		}

		$data = $rows->orderBy($sort,$order)->with('warehouse')->paginate(10);
        $total_row = count($data);
		return view('admin.transfer-product.index', ['rows' => $data, 'total_row' => $total_row, 'warehouse' => $warehouse]);

    }

 	public function getDetails($id){
		$data_warehouse_ph = WarehouseTransferPh::find($id)->toArray();
		$data_warehouse = Warehouse::find($data_warehouse_ph['warehouse_id'])->toArray();
		$warehouse_ph_details = WarehouseTransferPhDetails::where('warehouse_ph_id','=',$id)->with('product')->get();
        return view('admin.stock-receipt.details',compact('data_warehouse_ph','data_warehouse','data_suppier','warehouse_ph_details'));
    }

    public function getCreate(){
    	//return view("admin.stock-receipt.create");
    	$data_supplier = Supplier::all()->toArray();
    	$data_warehouse = Warehouse::all()->toArray();
    	return view('admin.stock-receipt.create',compact('data_warehouse','data_supplier'));
    }

    public function postCreate(WarehousePhRequest $request){
    	$warehouse_ph = new WarehousePh();
    	$warehouse_ph->supplier_id = $request->warehouse_ph_supplier_id;
    	$warehouse_ph->warehouse_id = $request->warehouse_ph_warehouse_id;
    	$warehouse_ph->name = $request->warehouse_ph_name;
    	$warehouse_ph->admin_id = 1;
    	$warehouse_ph->code = 'NK/'.date('dmYhis');
    	$warehouse_ph->status = 0;
    	$warehouse_ph->save();
    	$insertedId = $warehouse_ph->id;
    	return redirect()->route('admin.stock-receipt.getUpdate',$insertedId)->with(['flash_message' => 'Tạo phiếu thành công! Hãy thêm sản phẩm nhập vào kho!']);
    }

    public function getUpdate($id){
    	$data_warehouse_ph = WarehousePh::find($id)->toArray();
		$data_warehouse = Warehouse::find($data_warehouse_ph['warehouse_id'])->toArray();
		$data_suppier = Supplier::find($data_warehouse_ph['supplier_id'])->toArray();
		$warehouse_ph_details = WarehousePhDetails::where('warehouse_ph_id','=',$id)->with('product')->get();
        return view('admin.stock-receipt.update',compact('data_warehouse_ph','data_warehouse','data_suppier','warehouse_ph_details'));
    }

    public function postUpdate(WarehousePhDetailsRequest $request,$id){
    	if($request->has('warehouse_ph_details_product')){
    		$productid = $request->warehouse_ph_details_product;
    		$arr_pro = WarehousePhDetails::where('warehouse_ph_id','=',$id)->where('product_id','=',$productid)->count();
    	}
    	if(($arr_pro) <= 0){
	    	$warehouse_ph_details = new WarehousePhDetails();
	    	$warehouse_ph_details->warehouse_ph_id = $id;
	    	$warehouse_ph_details->product_id = $request->warehouse_ph_details_product;
	    	$warehouse_ph_details->quantity = $request->warehouse_ph_details_quantity;
	    	$warehouse_ph_details->price = $request->warehouse_ph_details_price;
	    	$warehouse_ph_details->total_price = ($request->warehouse_ph_details_quantity) * ($request->warehouse_ph_details_price);
	    	$warehouse_ph_details->save();
	    	return redirect()->route('admin.stock-receipt.getUpdate',$id)->with(['flash_message' => 'Thêm sản phẩm thành công!']);
	    }else{
	    	return redirect()->route('admin.stock-receipt.getUpdate',$id)->with(['flash_error' => 'Sản phẩm này đã tồn tại trên phiếu!']);
	    }
    }

    public function getEdit($id){
        $data = WarehousePhDetails::find($id)->toArray();
        return view('admin.stock-receipt.edit',compact('data'));
    }

    public function postEdit(Request $request,$id){
        $this->validate($request,
            [
	            'warehouse_ph_details_quantity' => 'required',
	            'warehouse_ph_details_price' => 'required',
	        ],
            [
	            'warehouse_ph_details_quantity.required' => 'Vui lòng điền số lượng nhập kho!',
	            'warehouse_ph_details_price.required' => 'Vui lòng điền giá sản phẩm nhập kho!',
             ]
        );
        $data = new WarehousePhDetails();
        $data = WarehousePhDetails::find($id);
    	$data->quantity = $request->warehouse_ph_details_quantity;
    	$data->price = $request->warehouse_ph_details_price;
    	$data->total_price = ($request->warehouse_ph_details_quantity) * ($request->warehouse_ph_details_price);
    	$data->save();
        return back()->with(['flash_message' => 'Cập nhật sản phẩm thành công!']);
    }

    public function getDelete($id){
        $data = WarehousePhDetails::find($id);
        $data->delete($id);
        //return redirect()->route('admin.product.index')->with(['flash_message' => 'Xoá sản phẩm thành công!']);    
        return back()->with(['flash_message' => 'Xoá sản phẩm thành công!']);    
    }

    public function postWarehousing(Request $request,$id){
        $count = 1;
        $data_inventory = array();
        for($count = 1; $count <= ($request->input("count_loop_insert")); $count++){
            array_push($data_inventory, array(
                'warehouse_id'      => $request->input("warehouse_id") ,
                'warehouse_ph_id'   => $request->input("warehouse_ph_id") ,
                'product_id'        => $request->input("product_id_".$count) ,
                'quantity'          => $request->input("product_quantity_".$count) ,
                'price'             => $request->input("product_price_".$count) ,
                'total_price'       => ($request->input("product_quantity_".$count)) * ($request->input("product_price_".$count))
            ));
        }

        WarehouseInventory::insert($data_inventory); // Eloquent

        $warehouseph = new WarehousePh();
        $warehouseph = WarehousePh::find($id);
        $warehouseph->status = 1;
        $warehouseph->save();

        return redirect()->route('admin.stock-receipt.details',$id)->with(['flash_message' => 'Sản phẩm đã được nhập vào kho!']);
    }
}
