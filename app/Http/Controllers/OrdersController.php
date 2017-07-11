<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Orders;
use App\OrderDetails;
use App\Customers;
use App\PaymentMethods;
use App\Channel;
use App\Product;
use App\OrderProcessing;
use App\Provinces;
use App\Districts;
use App\Warehouse;
use App\WarehouseReturnProductPh;
use App\WarehouseReturnProductPhDetails;
use App\Models\AffiliateUserOrderDetail;
use App\AffiliateUserProduct;

use Carbon\Carbon;

use Auth;
use DB;

class OrdersController extends Controller
{

    // Tạo đơn hàng
    public function getCreate(){
        $warehouse = Warehouse::select('id','name')->get();
        $provinces = Provinces::select('id','name')->get();
        $payment_methods = PaymentMethods::select('id','name')->get();
        $channel = Channel::select('id','name')->get();
        return view('admin.orders.create',compact('provinces','payment_methods','channel','warehouse'));
    }

    public function postCreate(Request $request){

        $arr_product_id = $request->product_id;

        if($request->order_status == 3){
            // Check xem còn hàng không:
            foreach($arr_product_id as $key => $value){
                // Sum quantity Inventory
                if(($value) > (DB::table('warehouse_inventory')->where('product_id','=',$key)->sum('quantity')) ){
                    return response()->json(['msg' => 'Không đủ sản phẩm trong kho hàng!']);
                }
            }

            foreach($arr_product_id as $key => $value){
                // Trừ hàng trong kho
                //update_inventory($key,$value);
            }
        }


        //  Kiểm tra khách hàng có tồn tại không
        $customers = Customers::select('id')->where('phone','LIKE', $request->customer_phone)->get()->toArray();
        if (count($customers) > 0){
            $customer_id = $customers[0]['id'];

            $customers_update = Customers::find($customer_id);
            $customers_update->name = $request->customer_name;
            $customers_update->phone = $request->customer_phone;
            $customers_update->email = $request->customer_email;
            $customers_update->province_id = $request->customer_provinces;
            $customers_update->district_id = $request->customer_districts;
            $customers_update->address = $request->customer_address;
            $customers_update->birthdate = $request->customer_birthdate;
            $customers_update->gender = $request->customer_gender;
            $customers_update->save();

        }else{  // Thêm khách hàng
            $customer = new Customers();
            $customer->name = $request->customer_name;
            $customer->phone = $request->customer_phone;
            $customer->email = $request->customer_email;
            $customer->province_id = $request->customer_provinces;
            $customer->district_id = $request->customer_districts;
            $customer->address = $request->customer_address;
            $customer->birthdate = $request->customer_birthdate;
            $customer->gender = $request->customer_gender;
            $customer->save();
            $customer_id = $customer->id;
        }

        $orders = new Orders();
        $orders->user_id = Auth::user()->id;
        $orders->customer_id = $customer_id;
        $orders->code = 'MDH/'.date('dmYhis');
        $orders->payment_method_id = $request->payment_methods;
        $orders->channel_id = $request->channel;
        $orders->status = 1;
        $orders->order_status = $request->order_status;
        $orders->payment_status = $request->payment_status;
        $orders->save();
        $insertedId = $orders->id;

        $arr_product_id = $request->product_id;
        $dataInsert = array();
        $order_total_price = 0;
        foreach($arr_product_id as $key => $value){
            $product = Product::select('price')->where('id',$key)->get()->toArray();
            $arrayPush = array('order_id'=> $insertedId,'product_id'=> $key,'quantity' => $value,'price' => $product[0]['price'],'total_price'=>$product[0]['price'] * $value);
            array_push($dataInsert,$arrayPush);
            $order_total_price = $order_total_price + ($product[0]['price'] * $value);
        }
        DB::table('order_details')->insert($dataInsert); // Query Builder

        $order_update = Orders::find($insertedId);
        $order_update->total_price = $order_total_price;
        $order_update->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $insertedId;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->status = 1;
        $orderProcessing->order_status = $request->order_status;
        $orderProcessing->save();

        return response()->json(['msg' => 'Tạo đơn hàng thành công!']);
    }

    public function updateCustomer(Request $request){

        //  Kiểm tra khách hàng có tồn tại không
        $customers = Customers::select('id')->where('phone','LIKE', $request->customer_phone)->get()->toArray();
        if (count($customers) > 0){
            $customer_id = $customers[0]['id'];

            $customers_update = Customers::find($customer_id);
            $customers_update->name = $request->customer_name;
            //$customers_update->phone = $request->customer_phone;
            $customers_update->email = $request->customer_email;
            $customers_update->province_id = $request->customer_provinces;
            $customers_update->district_id = $request->customer_districts;
            $customers_update->address = $request->customer_address;
            $customers_update->birthdate = $request->customer_birthdate;
            $customers_update->gender = $request->customer_gender;
            $customers_update->save();

        }else{  // Thêm khách hàng
            $customer = new Customers();
            $customer->name = $request->customer_name;
            $customer->phone = $request->customer_phone;
            $customer->email = $request->customer_email;
            $customer->province_id = $request->customer_provinces;
            $customer->district_id = $request->customer_districts;
            $customer->address = $request->customer_address;
            $customer->birthdate = $request->customer_birthdate;
            $customer->gender = $request->customer_gender;
            $customer->save();
            $customer_id = $customer->id;
        }

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->status = 1;
        $orderProcessing->note = 'Cập nhật lại thông tin khách hàng';
        $orderProcessing->order_status = $request->order_status;
        $orderProcessing->save();

        return response()->json(['msg' => 'Cập nhật thông tin khách hàng thành công!']);
    }

    public function updateOrder(Request $request){

        // Delete all product orders
        $ids_product_to_delete = array();
        $order_details = OrderDetails::select('id')->where('order_id','=',$request->order_id)->get()->toArray();
        foreach($order_details as $value){
            array_push($ids_product_to_delete,$value);
        }
        DB::table('order_details')->whereIn('id', $ids_product_to_delete)->delete();

        // Insert lại product
        $arr_product_id = $request->product_id;
        $dataInsert = array();
        $order_total_price = 0;
        foreach($arr_product_id as $key => $value){
            $product = Product::select('price')->where('id',$key)->get()->toArray();
            $arrayPush = array('order_id'=> $request->order_id,'product_id'=> $key,'quantity' => $value,'price' => $product[0]['price'],'total_price'=>$product[0]['price'] * $value);
            array_push($dataInsert,$arrayPush);
            $order_total_price = $order_total_price + ($product[0]['price'] * $value);
        }
        DB::table('order_details')->insert($dataInsert); // Query Builder

        $order_update = Orders::find($request->order_id);
        $order_update->total_price = $order_total_price;
        $order_update->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->status = 1;
        $orderProcessing->note = 'Cập nhật lại chi tiết đơn hàng';
        $orderProcessing->order_status = $request->order_status;
        $orderProcessing->save();

        return response()->json(['msg' => 'Cập nhật chi tiết đơn hàng thành công!']);
    }


    public function updateCallStatus(Request $request){

        $orders = new Orders();
        $orders = Orders::find($request->order_id);

        $orders->call_status = $request->call_status;
        $orders->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->status = 1;
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->call_status = $request->call_status;
        $orderProcessing->save();

        return response()->json(['msg' => 'Bạn đã cập nhật trạng thái liên lạc với khách hàng, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!']);
    }

    public function updateLadingStatus(Request $request){

        $orders = new Orders();
        $orders = Orders::find($request->order_id);

        // Update tồn kho khi đổi trạng thái lấy hàng
        if($request->lading_status == 2){
            if ($request->export_warehouse != 0){
            $order_details = OrderDetails::select('order_details.quantity as order_details_quantity','product.name as product_name','product.id as product_id')
                                           ->join('product', 'product.id', '=', 'order_details.product_id')
                                           ->where('order_id','=',$request->order_id)->get();
                // Check xem còn hàng không:
                foreach($order_details as $key => $value){
                    // Sum quantity Inventory
                    if(($value->order_details_quantity) > (DB::table('warehouse_inventory')->where('product_id','=',$value->product_id)->where('warehouse_id','=',$request->export_warehouse)->sum('quantity')) ){
                        return response()->json(['msg' => 'Sản phẩm '.$value->product_name.' không đủ hàng trong kho!']);
                    }
                }

                foreach($order_details as $key => $value){
                    // Trừ hàng trong kho
                    update_inventory($request->order_id,$value->product_id,$value->order_details_quantity,$request->export_warehouse);
                }
            }
        }

        $orders->lading_status = $request->lading_status;
        $orders->export_warehouse = $request->export_warehouse;
        $orders->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->status = 1;
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->order_status = 2;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->lading_status = $request->lading_status;
        $orderProcessing->save();
        return response()->json(['msg' => 'Bạn đã cập nhật trạng thái giao hàng, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!']);
    }

    public function updatePaymentStatus(Request $request){

        $orders = new Orders();
        $orders = Orders::find($request->order_id);

        $orders->payment_status = $request->payment_status;
        $orders->save();

        return response()->json(['msg' => 'Bạn đã cập nhật trạng thái thanh toán thành công!']);
    }

    public function updateReceiverOrder(Request $request){
        $orders = new Orders();
        $orders = Orders::find($request->order_id);

        $orders->receiver_provinces = $request->receiver_provinces;
        $orders->receiver_districts = $request->receiver_districts;
        $orders->receiver_address = $request->receiver_address;
        $orders->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->status = 1;
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->note = 'Cập nhật lại địa chỉ giao hàng';
        $orderProcessing->save();

        return response()->json(['msg' => 'Bạn đã cập nhật địa chỉ giao hàng thành công, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!']);
    }

    // Danh sách đơn hàng
	public function getIndex(Request $request){
    	$sort='created_at';
        $order='desc';
        $rows = Orders::select('orders.*','payment_methods.name as payment_method_name')
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.order_status','!=',5);

        $sum_total_price = DB::table('orders')
                        ->select(DB::raw('SUM(total_price) as total_sales'))
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.order_status','!=',5);

        if ($request->has('filter-cus-name') && $request->GET('filter-cus-name') != ""){
            $rows = $rows->where('customers.name','LIKE','%'.$request->GET("filter-cus-name").'%');
            $sum_total_price = $sum_total_price->where('customers.name','LIKE','%'.$request->GET("filter-cus-name").'%');
        }

        if ($request->has('filter-order-status') && $request->GET('filter-order-status') != -1){
            $rows = $rows->where('orders.order_status',$request->GET("filter-order-status"));
            $sum_total_price = $sum_total_price->where('orders.order_status',$request->GET("filter-order-status"));
        }

        if ($request->has('filter-order-time') && $request->GET('filter-order-time') == 'today'){
            $rows = $rows->whereDate('orders.created_at','=',date('Y-m-d'));
            $sum_total_price = $sum_total_price->whereDate('orders.created_at','=',date('Y-m-d'));
        }

        $fromDateWeek = Carbon::now()->startOfWeek();//->toDateString();
        $tillDateWeek = date('Y-m-d h-i-s');

        if ($request->has('filter-order-time') && $request->GET('filter-order-time') == 'week'){
            $rows = $rows->whereBetween('orders.created_at', [$fromDateWeek, $tillDateWeek] );
            $sum_total_price = $sum_total_price->whereBetween('orders.created_at', [$fromDateWeek, $tillDateWeek] );
        }

        if ($request->has('filter-order-time') && $request->GET('filter-order-time') == 'month'){
            $rows = $rows->whereMonth('orders.created_at','=',date('m'));
            $sum_total_price = $sum_total_price->whereMonth('orders.created_at','=',date('m'));
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('orders.created_at','>',($request->GET('filter-date-start')))
                         ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            $sum_total_price = $sum_total_price->where('orders.created_at','>',($request->GET('filter-date-start')))
                         ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('orders.created_at','>',($request->GET('filter-date-start')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

                $sum_total_price = $sum_total_price->where('orders.created_at','>',($request->GET('filter-date-start')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));
            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('orders.created_at','>',($request->GET('filter-date-end')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

                $sum_total_price = $sum_total_price->where('orders.created_at','>',($request->GET('filter-date-end')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $data = $rows->orderBy($sort,$order)->with('customers')->paginate(20);
        $order_total = count($data);
        $total_order = $sum_total_price->get();
        return view('admin.orders.index', ['rows' => $data, 'order_total' => $order_total, 'total_order' => $total_order]);
    }

    // Danh sách đơn hàng
    public function getTrash(Request $request){
        $sort='created_at';
        $order='desc';
        $rows = Orders::select('orders.*','payment_methods.name as payment_method_name')
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.order_status','=',5);

        $sum_total_price = DB::table('orders')
                        ->select(DB::raw('SUM(total_price) as total_sales'));


        $data = $rows->orderBy($sort,$order)->with('customers')->paginate(20);
        $order_total = count($data);
        $total_order = $sum_total_price->get();
        return view('admin.orders.trash', ['rows' => $data, 'order_total' => $order_total, 'total_order' => $total_order]);
    }

    // Chi tiết đơn hàng
 	public function getDetails($id){
        $provinces = Provinces::select('id','name')->get();
        $payment_methods = PaymentMethods::select('id','name')->get();
        $channel = Channel::select('id','name')->get();
        $order = Orders::find($id)->toArray();
        $customer = Customers::findOrNew($order['customer_id']);
        $payment_method_name_order = PaymentMethods::select('name')->where('id',$order['payment_method_id'])->first();
        $channel_name_order = Channel::select('name')->where('id',$order['channel_id'])->first();
        $provinces_name_customer = Provinces::select('name','id')->where('id',$customer['province_id'])->first();
        $districts_name_customer = Districts::select('name','id')->where('id',$customer['district_id'])->first();
        $warehouse = Warehouse::select('id','name')->get();

        $districts_customer = Districts::select('id','name')->where('province_id',$provinces_name_customer['id'])->get();

        $cur_provinces = 0;
        $cur_districts = 0;
        if($order['receiver_provinces'] != 0){
            $cur_provinces = $order['receiver_provinces'];
            $cur_districts = $order['receiver_districts'];
        }elseif($customer['province_id'] != 0){
            $cur_provinces = $customer['province_id'];
            $cur_districts = $customer['district_id'];
        }

        $districts_receiver_order = Districts::select('id','name')->where('province_id',$cur_provinces)->get();

        $provinces_name_receiver = Provinces::select('name')->where('id',$cur_provinces)->first();
        $districts_name_receiver = Districts::select('name')->where('id',$cur_districts)->first();

        $order_details = OrderDetails::select('order_details.*','product.name','product.sku')->join('product', 'product.id', '=', 'order_details.product_id')->where('order_id','=',$id)->get();//->with('product')->get();
        $order_processing = OrderProcessing::select('order_processing.*','users.name as username','order_processing.created_at as processing_created_at')
        ->join('users', 'order_processing.user_id', '=', 'users.id')
        ->join('orders', 'orders.id', '=', 'order_processing.order_id')
        ->where('order_id','=',$id);

        $data_order_processing = $order_processing->orderBy('created_at','desc')->get();
        return view('admin.orders.details',compact('order','id','order_details','customer','provinces','payment_methods','channel','data_order_processing','payment_method_name_order','channel_name_order','provinces_name_customer','provinces_name_receiver','districts_customer','districts_name_customer','districts_receiver_order','districts_name_receiver','warehouse'));
    }

    // Chi tiết đơn hàng
    public function getDeliveryDetails($id){
        $warehouse = Warehouse::select('id','name')->get();
        $provinces = Provinces::select('id','name')->get();
        $payment_methods = PaymentMethods::select('id','name')->get();
        $channel = Channel::select('id','name')->get();
        $order = Orders::find($id)->toArray();
        $payment_method_name_order = PaymentMethods::select('name')->where('id',$order['payment_method_id'])->first();
        $channel_name_order = Channel::select('name')->where('id',$order['channel_id'])->first();
        $customer = Customers::find($order['customer_id'])->toArray();
        $provinces_name_customer = Provinces::select('name','id')->where('id',$customer['province_id'])->first();
        $districts_name_customer = Districts::select('name','id')->where('id',$customer['district_id'])->first();

        $districts_customer = Districts::select('id','name')->where('province_id',$provinces_name_customer['id'])->get();

        $cur_provinces = 0;
        $cur_districts = 0;
        if($order['receiver_provinces'] != 0){
            $cur_provinces = $order['receiver_provinces'];
            $cur_districts = $order['receiver_districts'];
        }elseif($customer['province_id'] != 0){
            $cur_provinces = $customer['province_id'];
            $cur_districts = $customer['district_id'];
        }

        $districts_receiver_order = Districts::select('id','name')->where('province_id',$cur_provinces)->get();
        $provinces_name_receiver = Provinces::select('name')->where('id',$cur_provinces)->first();
        $districts_name_receiver = Districts::select('name')->where('id',$cur_districts)->first();

        $order_details = OrderDetails::select('order_details.*','name','sku')->join('product', 'product.id', '=', 'order_details.product_id')->where('order_id','=',$id)->get();//->with('product')->get();
        $order_processing = OrderProcessing::select('order_processing.*','users.name as username','order_processing.created_at as processing_created_at')
        ->join('users', 'order_processing.user_id', '=', 'users.id')
        ->join('orders', 'orders.id', '=', 'order_processing.order_id')
        ->where('order_id','=',$id);

        $data_order_processing = $order_processing->orderBy('created_at','desc')->get();
        return view('admin.orders.delivery',compact('warehouse','order','id','order_details','customer','provinces','payment_methods','channel','data_order_processing','payment_method_name_order','channel_name_order','provinces_name_customer','provinces_name_receiver','districts_customer','districts_name_customer','districts_receiver_order','districts_name_receiver'));
    }

    public function postDetailsSuccess(Request $request, $order_id){
        $orders = new Orders();
        $orders = Orders::find($order_id);

        if ($request->has('export_warehouse') && $request->export_warehouse != 0){
            $order_details = OrderDetails::select('order_details.id as order_detail_id','order_details.quantity as order_details_quantity','product.name as product_name','product.id as product_id')
                                           ->join('product', 'product.id', '=', 'order_details.product_id')
                                           ->where('order_id','=',$order_id)->get();
            // Check xem còn hàng không:
            foreach($order_details as $key => $value){
                // Sum quantity Inventory
                if(($value->order_details_quantity) > (DB::table('warehouse_inventory')->where('product_id','=',$value->product_id)->where('warehouse_id','=',$request->export_warehouse)->sum('quantity')) ){
                    return redirect()->back()->with(['flash_error' => 'Sản phẩm '.$value->product_name.' không đủ hàng trong kho!!']);
                }
            }

            foreach($order_details as $key => $value){
                // Trừ hàng trong kho // Truyền vào order_details_id để Update giá nhập
                update_inventory($request->order_id, $value->product_id,$value->order_details_quantity,$request->export_warehouse);
            }

            $orders->export_warehouse = $request->export_warehouse;
            $orders->order_status = 3;
            $orders->user_id = Auth::user()->id;
            $orders->save();

            $user_current_login = Auth::user()->id;
            $orderProcessing = new OrderProcessing();
            $orderProcessing->order_id = $order_id;
            $orderProcessing->user_id = $user_current_login;
            $orderProcessing->order_status = 3;
            $orderProcessing->save();

            // Affiliate
            $aff_details = AffiliateUserOrderDetail::select('affiliate_user_order_detail_logs.*')->where('order_id', $order_id)->get()->toArray();
            if (count($aff_details) > 0){
                $dataInsert = array();
                foreach($aff_details as $key => $value){
                    // Lấy UserID
                    $aff_user_product = AffiliateUserProduct::select('user_id')->where('id',$value['affiliate_user_product_id'])->first();
                    $arrayPush = array('user_id'=> $aff_user_product['user_id'],'affiliate_user_order_logs_id'=> 1,'order_id'=> $value['order_id'],'product_id' => $value['product_id'],'product_quantity' => $value['quantity'],'current_price'=>$value['price'],'current_profit'=>$value['profit'],'profit_price'=>(($value['price']/100)*$value['profit'])*$value['quantity'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
                    array_push($dataInsert,$arrayPush);
                }
                DB::table('affiliate_user_product_logs')->insert($dataInsert); // Query Builder
            }
            return redirect()->route('admin.orders.details',$order_id)->with(['flash_message' => 'Cập nhật trạng thái đơn hàng thành công!']);

        }elseif($request->has('lading_status') && $request->lading_status == 3 && $request->has('payment_status') && $request->payment_status == 1){
            $orders->order_status = 3;
            $orders->user_id = Auth::user()->id;
            $orders->save();
            $user_current_login = Auth::user()->id;
            $orderProcessing = new OrderProcessing();
            $orderProcessing->order_id = $order_id;
            $orderProcessing->user_id = $user_current_login;
            $orderProcessing->order_status = 3;
            $orderProcessing->save();

            // Affiliate
            $aff_details = AffiliateUserOrderDetail::select('affiliate_user_order_detail_logs.*')->where('order_id', $order_id)->get()->toArray();
            if (count($aff_details) > 0){
                $dataInsert = array();
                foreach($aff_details as $key => $value){
                    // Lấy UserID
                    $aff_user_product = AffiliateUserProduct::select('user_id')->where('id',$value['affiliate_user_product_id'])->first();
                    $arrayPush = array('user_id'=> $aff_user_product['user_id'],'affiliate_user_order_logs_id'=> 1,'order_id'=> $value['order_id'],'product_id' => $value['product_id'],'product_quantity' => $value['quantity'],'current_price'=>$value['price'],'current_profit'=>$value['profit'],'profit_price'=>(($value['price']/100)*$value['profit'])*$value['quantity'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
                    array_push($dataInsert,$arrayPush);
                }
                DB::table('affiliate_user_product_logs')->insert($dataInsert); // Query Builder
            }

            return redirect()->route('admin.orders.details',$order_id)->with(['flash_message' => 'Cập nhật trạng thái đơn hàng thành công!']);

        }else{
            return redirect()->back()->with(['flash_error' => 'Bạn chưa chọn kho xuất hàng!']);
        }
    }

    public function postDetailsCancel(Request $request,$order_id){
        $orders = new Orders();
        $orders = Orders::find($order_id);
        $orders->order_status = 4;
        $orders->user_id = Auth::user()->id;
        $orders->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->order_status = 4;
        $orderProcessing->save();

        return redirect()->route('admin.orders.details',$order_id)->with(['flash_message' => 'Cập nhật trạng thái đơn hàng huỷ!']);
    }

    public function postDetailsDelivered(Request $request,$order_id){
        $orders = new Orders();
        $orders = Orders::find($order_id);

        $orders->status = 1;
        $orders->order_status = 2;
        $orders->user_id = Auth::user()->id;
        //  Kiểm tra xem có biến trạng thái thì Update
        if ($request->has('radioInlineUpdateDelivery')){
            if($request->input("radioInlineUpdateDelivery") >= ($orders->lading_status)){
                $orders->lading_status = $request->input("radioInlineUpdateDelivery");
            }else{
                return redirect()->route('admin.orders.details',$order_id)->with(['flash_message' => 'Không thực thi được trạng thái giao hàng này!']);
            }
        }
        //  Check output message
        if ($request->has('radioInlineUpdateDelivery')){
            if ($request->input("radioInlineUpdateDelivery")  == 0){
                $flash_message = 'Cập nhật tình trạng đợi lấy hàng thành công!';
            }elseif($request->input("radioInlineUpdateDelivery")  == 1){
                $flash_message = 'Cập nhật tình trạng đang giao hàng thành công!';
            }elseif($request->input("radioInlineUpdateDelivery")  == 2){
                $flash_message = 'Cập nhật tình trạng đã giao hàng thành công!';
            }elseif($request->input("radioInlineUpdateDelivery")  == 3){
                $flash_message = 'Cập nhật tình trạng giao hàng hoàn thành!';
            }
        }else{
            $flash_message = 'Đơn hàng đã chuyển sang hệ thống kho vận!';
        }
        $orders->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->status = 1;
        $orderProcessing->order_status = 2;
        $orderProcessing->lading_status = $request->input("radioInlineUpdateDelivery");
        $orderProcessing->save();

        return redirect()->route('admin.orders.delivery',$order_id)->with(['flash_message' => $flash_message]);
    }

    public function postDetailsVirtual(Request $request,$order_id){
        $orders = new Orders();
        $orders = Orders::find($order_id);
        $orders->order_status = 5;
        $orders->user_id = Auth::user()->id;

        $customers = new Customers();
        $customers = Customers::find($orders->customer_id);
        $customers->active = 0;

        $orders->save();
        $customers->save();

        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->order_id = $order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->order_status = 5;
        $orderProcessing->save();

        return redirect()->route('admin.orders.details',$order_id)->with(['flash_message' => 'Cập nhật trạng thái đơn hàng ảo!']);
    }

    public function loadPrice(Request $request){
        $product_id = $request->get('product_id');
        $product = Product::where('id','=',$product_id)->get();
        $price = $product[0]->price;
        return response()->json(['msg' => $price]);
    }

    public function getCustomerAutoComplete(Request $request)
    {
        $usersArray = array();
        $data = Customers::select("id","name","email","phone","address","gender","province_id","district_id","birthdate")
                ->where("name","LIKE","%{$request->get('search-input-customer')}%")
                ->orWhere("email","LIKE","%{$request->get('search-input-customer')}%")
                ->orWhere("phone","LIKE","%{$request->get('search-input-customer')}%")
                ->get();

        foreach($data as $index=>$user ){
            $usersArray[$index] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'gender' => $user->gender,
                'province_id' => $user->province_id,
                'district_id' => $user->district_id,
                'birthdate' => $user->birthdate
            ];
        }
        return response()->json($usersArray);
    }

    public function getProductAutoComplete(Request $request)
    {
        $productArray = array();
        $data = Product::select("id","name","sku","barcode","price")
                ->where("name","LIKE","%{$request->get('search-input-product')}%")
                ->orWhere("sku","LIKE","%{$request->get('search-input-product')}%")
                ->orWhere("barcode","LIKE","%{$request->get('search-input-product')}%")
                ->get();

        foreach($data as $index=>$product ){
            $productArray[$index] = [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'barcode' => $product->barcode,
                'price' => $product->price
                ];
        }
        return response()->json($productArray);
    }

    public function getOrderAutoComplete(Request $request)
    {
        $orderArray = array();
        $data = Orders::select("id","code")
                ->where("code","LIKE","%{$request->get('search-order')}%")
                ->get();

        foreach($data as $index=>$order ){
            $orderArray[$index] = [
                'id' => $order->id,
                'code' => $order->code
                ];
        }
        return response()->json($orderArray);
    }

    public function postCreateInfoDelivery(Request $request){
        $this->validate($request,
            [
                'lading_code' => 'required|unique:orders,lading_code',
                'cod_price' => 'required:orders,cod_price',
            ],
            [
                'lading_code.required' => 'Vui lòng nhập mã vận đơn!',
                'cod_price.required' => 'Vui lòng nhập chi phí thu hộ'
            ]
        );

        $orders = new Orders();
        $orders = Orders::find($request->order_id);
        $orders->lading_code = $request->lading_code;
        $orders->cod_price = $request->cod_price;
        $orders->save();

        return redirect()->route('admin.orders.createInfoDelivery',$request->order_id)->with(['flash_message' => 'Cập nhật thông tin giao hàng thành công!']);
    }

    public function loadDistricts(Request $request){
        $strDistricts = '<option value="">-- Quận huyện --</option>';
        $districts = Districts::where('province_id','=',$request->provinces_id)->get();
        foreach($districts as $key => $value){
            $strDistricts .= '<option value='.$value['id'].'>-- '.$value['name'].' --</option>';
        }
        return response()->json(['strappend' => $strDistricts]);
    }

    public function updateNoteOrder(Request $request){
        $user_current_login = Auth::user()->id;
        $orderProcessing = new OrderProcessing();
        $orderProcessing->status = 1;
        $orderProcessing->order_id = $request->order_id;
        $orderProcessing->user_id = $user_current_login;
        $orderProcessing->note = $request->order_note;
        $orderProcessing->save();

        return response()->json(['msg' => 'Bạn đã cập nhật ghi chú thành công, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!']);
    }

    public function getReturn(Request $request){
        $sort='orders.created_at';
        $order='desc';
        $rows = WarehouseReturnProductPh::select('warehouse.name as warehouse_name','warehouse_return_product_ph.*','payment_methods.name as payment_method_name','customers.name as customer_name','orders.id as order_id','orders.code as order_code','orders.order_status as order_status','orders.payment_status as payment_status','orders.lading_status as lading_status',DB::raw('SUM(warehouse_return_product_ph_details.total_price) as total_price_return'),DB::raw('SUM(warehouse_return_product_ph_details.quantity) as total_quantity_return'))
                        ->leftJoin('warehouse_return_product_ph_details','warehouse_return_product_ph_details.warehouse_return_product_ph_id','=','warehouse_return_product_ph.id')
                        ->leftJoin('orders', 'orders.id', '=', 'warehouse_return_product_ph.order_id')
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->leftJoin('warehouse', 'warehouse.id', '=', 'warehouse_return_product_ph.warehouse_id')
                        ->where('orders.order_status','=',6);

        $sum_total_price = WarehouseReturnProductPhDetails::select(DB::raw('SUM(price * quantity) as total_price'), DB::raw('SUM(quantity) as total_quantity'))
                            ->join('warehouse_return_product_ph', 'warehouse_return_product_ph.id', '=', 'warehouse_return_product_ph_details.warehouse_return_product_ph_id')
                            ->join('orders', 'warehouse_return_product_ph.order_id', '=', 'orders.id');

        if ($request->has('filter-cus-name') && $request->GET('filter-cus-name') != ""){
            $rows = $rows->where('customers.name','LIKE','%'.$request->GET("filter-cus-name").'%');
            $sum_total_price = $sum_total_price->where('customers.name','LIKE','%'.$request->GET("filter-cus-name").'%');
        }

        if ($request->has('filter-order-status') && $request->GET('filter-order-status') != -1){
            $rows = $rows->where('orders.order_status',$request->GET("filter-order-status"));
            $sum_total_price = $sum_total_price->where('orders.order_status',$request->GET("filter-order-status"));
        }

        if ($request->has('filter-order-time') && $request->GET('filter-order-time') == 'today'){
            $rows = $rows->whereDate('orders.created_at','=',date('Y-m-d'));
            $sum_total_price = $sum_total_price->whereDate('orders.created_at','=',date('Y-m-d'));
        }

        $fromDateWeek = Carbon::now()->startOfWeek();//->toDateString();
        $tillDateWeek = date('Y-m-d H:i:s');

        if ($request->has('filter-order-time') && $request->GET('filter-order-time') == 'week'){
            $rows = $rows->whereBetween('orders.created_at', [$fromDateWeek, $tillDateWeek] );
            $sum_total_price = $sum_total_price->whereBetween('orders.created_at', [$fromDateWeek, $tillDateWeek] );
        }

        if ($request->has('filter-order-time') && $request->GET('filter-order-time') == 'month'){
            $rows = $rows->whereMonth('orders.created_at','=',date('m'));
            $sum_total_price = $sum_total_price->whereMonth('orders.created_at','=',date('m'));
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('orders.created_at','>',($request->GET('filter-date-start')))
                         ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d H:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            $sum_total_price = $sum_total_price->where('orders.created_at','>',($request->GET('filter-date-start')))
                         ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d H:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('orders.created_at','>',($request->GET('filter-date-start')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

                $sum_total_price = $sum_total_price->where('orders.created_at','>',($request->GET('filter-date-start')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));
            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('orders.created_at','>',($request->GET('filter-date-end')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

                $sum_total_price = $sum_total_price->where('orders.created_at','>',($request->GET('filter-date-end')))
                             ->where('orders.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $sum_total_price = $sum_total_price->first();

        $data = $rows->orderBy($sort,$order)->groupBy('warehouse_return_product_ph.id')->paginate(20);
        $order_total = count($data);
        return view('admin.orders.return', ['rows' => $data, 'order_total' => $order_total, 'sum_total_price' => $sum_total_price]);
    }

}
