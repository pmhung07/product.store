<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Warehouse;
use App\WarehouseReturnProductPhDetails;
use App\WarehouseReturnProductPh;
use App\Product;
use App\WarehouseInventory;
use App\Orders;
use App\OrderProcessing;
use App\OrderDetails;

use Auth;
use DB;

class WarehouseReturnProductPhController extends Controller
{
 	public function getIndex(Request $request){
 		$warehouse = Warehouse::select('id','name')->get();
    	$sort='created_at';
		$order='desc';
		$rows = WarehouseReturnProductPh::select('warehouse_return_product_ph.*','orders.code as order_code','users.id as user_id','users.name as user_name','users_position.name as users_position_name')
                ->join('users', 'users.id', '=', 'warehouse_return_product_ph.admin_id')
                ->leftjoin('users_position', 'users_position.id', '=', 'users.user_position_id')
				->join('warehouse', 'warehouse.id', '=', 'warehouse_return_product_ph.warehouse_id')
				->join('orders', 'orders.id', '=', 'warehouse_return_product_ph.order_id');

		if ($request->has('order_code')){
			$rows = $rows->where('orders.code', 'LIKE', '%'.$request->input("order_code").'%');
		}
		if ($request->has('warehouse_name')){
			$rows = $rows->where('warehouse.id', '=', $request->input("warehouse_name"));
		}

		$data = $rows->orderBy($sort,$order)->with('warehouse')->paginate(10);
		return view('admin.return-product.index', ['rows' => $data, 'warehouse' => $warehouse]);
    }   

    public function getProcessing(Request $request){
    	$orders = array();
    	$order_details = array();
    	if ($request->has('order-code')){
			$orders = Orders::select('orders.*')->where('code','LIKE',$request->input("order-code"))->get()->toArray();
		}
		if(count($orders) > 0){
			$order_details = OrderDetails::select('order_details.*','name')->join('product', 'product.id', '=', 'order_details.product_id')->where('order_id','=',$orders[0]['id'])->get()->toArray();
    	}

    	$warehouse = Warehouse::select('id','name')->get();
    	return view('admin.return-product.processing',['orders' => $orders, 'order_details' => $order_details, 'warehouse' => $warehouse]);
    }   

    public function postReturnProduct(Request $request){
    	$arr_product_id = $request->product_id;
    	$order_id = $request->order_id;
    	$warehouse_return = $request->warehouse_return;
    	$return_product_name = "Phiếu trả hàng đơn hàng: ".$request->order_code." - ".date('dmYhis');
    	$return_product_code = "PTH".date('dmYhis');

        $return = new WarehouseReturnProductPh();
        $return->admin_id = Auth::user()->id;
        $return->order_id = $order_id;
        $return->code = $return_product_code;
        $return->warehouse_id = $warehouse_return;
        $return->name = $return_product_name;
        $return->status = 1;
        $return->save();
        $insertedId = $return->id;

        $arr_product_id = $request->product_id;
        $dataInsert = array();
        $order_total_price = 0;

        // Chi tiết trả hàng va giá bán
        foreach($arr_product_id as $key => $value){
            $product = Product::select('price')->where('id',$key)->get()->toArray();
            $arrayPush = array('warehouse_return_product_ph_id'=> $insertedId,'product_id'=> $key,'quantity' => $value,'price' => $product[0]['price'],'total_price'=>$product[0]['price'] * $value);
            array_push($dataInsert,$arrayPush);
            $order_total_price = $order_total_price + ($product[0]['price'] * $value);
        }
        DB::table('warehouse_return_product_ph_details')->insert($dataInsert); // Query Builder

        update_inventory_return_product($arr_product_id,$order_id,$warehouse_return);

        $orders = new Orders();
        $orders = Orders::find($order_id);
        $orders->order_status = 6;
        $orders->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->status = 1;
        $orderProcessing->note = 'Tạo phiếu trả hàng';
        $orderProcessing->order_status = $request->order_status;
        $orderProcessing->save();

        return response()->json(['msg' => 'Tạo phiếu trả hàng thành công, hàng đã được nhập vào trong kho!']);
    }

    public function getDetails($id){
        $data_warehouse_return_product_ph = WarehouseReturnProductPh::find($id)->toArray();
        $data_warehouse = Warehouse::find($data_warehouse_return_product_ph['warehouse_id'])->toArray();
        $data_warehouse_return_product_ph_details = WarehouseReturnProductPhDetails::where('warehouse_return_product_ph_id','=',$id)->with('product')->get();
        return view('admin.return-product.details',compact('data_warehouse_return_product_ph','data_warehouse','data_warehouse_return_product_ph_details'));
    }

}












