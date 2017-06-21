<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Customers;
use App\Districts;
use App\Http\Requests;
use App\Http\Requests\CustomersRequest;
use App\OrderDetails;
use App\OrderProcessing;
use App\Orders;
use App\PaymentMethods;
use App\Product;
use App\Provinces;
use App\User;
use App\Warehouse;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Excel;

class CustomersController extends Controller
{
    public function getCreate(){
    	$provinces = Provinces::select('id','name','order_number','active')->get()->toArray();

    	return view('admin.customer.create',compact('provinces'));
    }

    public function postCreate(CustomersRequest $request){
    	$customer = new Customers();
    	$customer->name = $request->customer_name;;
    	$customer->email = $request->customer_email;
    	$customer->phone = $request->customer_phone;
    	$customer->address = $request->customer_address;
    	$customer->birthdate = $request->customer_birthdate;
    	$customer->gender = $request->customer_gender;
    	$customer->save();
    	return redirect()->route('admin.customer.index')->with(['flash_message' => 'Thêm khách hàng thành công!']);
    }

    public function getIndex(Request $request){
    	$sort='created_at';
		$order='DESC';
        $rows = Customers::select('customers.*','provinces.name as provinces_name','districts.name as districts_name')
                           ->Join('provinces', 'provinces.id', '=', 'customers.province_id')
                           ->join('districts', 'districts.id', '=', 'customers.district_id')
                           ->where('customers.active','!=',0);

		if ($request->has('cus_name'))
			$rows = $rows->where('customers.name', 'LIKE', '%'.$request->input("cus_name").'%');
		if ($request->has('cus_phone'))
            $rows = $rows->where('customers.phone', 'LIKE', '%'.$request->input("cus_phone").'%');
        if ($request->has('cus_email'))
            $rows = $rows->where('customers.email', 'LIKE', '%'.$request->input("cus_email").'%');

        $province_id = (int) $request->get('province_id');
        $district_id = (int) $request->get('district_id');
        $vip_customer = (int) $request->get('vip_customer');
        $gender = (int) $request->get('gender', -1);

        if($province_id) $rows->where('customers.province_id', '=', $province_id);
        if($district_id) $rows->where('customers.district_id', '=', $district_id);
        if($gender != -1) $rows->where('customers.gender', '=', $gender);
        if($vip_customer) {
            $rows->join('orders', 'customers.id', '=', 'orders.customer_id')
                 ->orderBy('orders.total_price', 'DESC');
            $sort = 'orders.total_price';
            $order = 'DESC';
        }

		$data = $rows->orderBy($sort,$order);

        $wantToExport = $request->get('export');
        if($wantToExport == 0) {
            $data = $data->paginate(10);//->with('category', 'brand')->paginate(10);
        } else {
            $data = $data->paginate(5000);
        }

        $provinces = Provinces::orderBy('name', 'DESC')->get();
        $districts = new Collection();
        if($province_id) {
            $districts = Districts::where('province_id', $province_id)->get();
        }

        // Bulk action
        $bulkActions = [
            "SEND_SMS"     => 'Gửi tin nhắn',
            "SEND_EMAIL"   => 'Gửi mail',
            // "DELETE_MULTI" => 'Xóa'
        ];

        // _debug($wantToExport);

        // Nếu muốn export
        if($wantToExport == 1 && $data->count() > 0) {
            Excel::create('DS_CUSTOMER_'.date('Ymd').'_'.time(), function($excel) use($data) {
                $excel->sheet('Sheet1', function($sheet) use($data) {
                    $i = 1;
                    $sheet->row($i, ['id', 'name', 'phone', 'email']);
                    foreach($data as $item) {
                        $i++;
                        $sheet->row($i, [$item->id, $item->name, $item->phone, $item->email]);
                    }
                });
            })->download('xls');
        }

        return view('admin.customer.index',['rows' => $data, 'provinces' => $provinces, 'districts' => $districts, 'bulkActions' => $bulkActions]);//, ['rows' => $data]);
    }

    public function getUpdate($id){

    	$customer = Customers::find($id)->toArray();
        return view('admin.customer.update',compact('customer'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'customer_name' => 'required',
                'customer_email' => 'required',
                'customer_phone' => 'required',
                'customer_address' => 'required',
                'customer_gender' => 'required'
	        ],
            [
				'customer_name.required' => 'Vui lòng nhập tên khách hàng!',
                'customer_email.required' => 'Vui lòng nhập địa chỉ Email khách hàng!',
                'customer_phone.required' => 'Vui lòng nhập số điện thoại khách hàng!',
                'customer_address.required' => 'Vui lòng nhập địa chỉ khách hàng!',
                'customer_gender.required' => 'Vui lòng chọn giới tính khách hàng!'
             ]
        );
        $customer = new Customers();
        $customer = Customers::find($id);
    	$customer->name = $request->customer_name;;
    	$customer->email = $request->customer_email;
    	$customer->phone = $request->customer_phone;
    	$customer->address = $request->customer_address;
    	$customer->gender = $request->customer_gender;
    	$customer->save();
        return redirect()->route('admin.customer.index')->with(['flash_message' => 'Cập nhật thông tin khách hàng thành công!']);
    }

    public function getTakecare(Request $request){
        $sort='created_at';
        $order='DESC';
        $rows = Customers::select('customers.*','provinces.name as provinces_name','districts.name as districts_name')
                           ->Join('provinces', 'provinces.id', '=', 'customers.province_id')
                           ->join('districts', 'districts.id', '=', 'customers.district_id')->where('customers.active','!=',0);
        if ($request->has('cus_name'))
            $rows = $rows->where('customers.name', 'LIKE', '%'.$request->input("cus_name").'%');
        if ($request->has('cus_phone'))
            $rows = $rows->where('customers.phone', 'LIKE', '%'.$request->input("cus_phone").'%');
        if ($request->has('cus_email'))
            $rows = $rows->where('customers.email', 'LIKE', '%'.$request->input("cus_email").'%');

        $data=$rows->orderBy($sort,$order)->paginate(10);//->with('category', 'brand')->paginate(10);
        return view('admin.customer.takecare',['rows' => $data]);//, ['rows' => $data]);
    }

    public function getDetails(Request $request, $uid){

        $data_user = Customers::select('customers.*')->where('id','=',$uid)->first();

        $sort='created_at';
        $order='desc';
        $rows = Orders::select('orders.*','payment_methods.name as payment_method_name')
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.order_status','!=',5)
                        ->where('orders.customer_id','=',$uid);

        $sum_total_price = DB::table('orders')
                        ->select(DB::raw('SUM(total_price) as total_sales'))
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.order_status','!=',5)
                        ->where('orders.customer_id','=',$uid);

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
        return view('admin.customer.details', ['rows' => $data, 'order_total' => $order_total, 'total_order' => $total_order, 'uid' => $uid, 'data_user' => $data_user]);

    }


    public function getDelete($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->active = 0;
        $customer->save();
        return redirect()->route('admin.customer.index')->with(['flash_message' => 'Xóa thành công!']);
    }

}
