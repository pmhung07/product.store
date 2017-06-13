<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StaffRequest;

use App\Staff;
use App\Permissions;
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
use App\User;
use App\UsersPosition;

use Carbon\Carbon;

use Auth;
use DB;
use Hash;


class StaffController extends Controller
{
	public function getIndex(Request $request){
    	$sort='id';
		$order='desc';

        $users_position = UsersPosition::select('id','name')->get()->toArray();
		$rows = Staff::select('users.id', 'users.name', 'users.email', 'users.phone', 'users.address', 'users.identity_card_number', 'users.permissions', 'users.created_at' ,'users_position.name as users_position_name')
                ->leftjoin('users_position', 'users_position.id', '=', 'users.user_position_id')
                ->where('users.id','!=',Auth::user()->id);

        if ($request->has('staff_name') && $request->GET('staff_name') != ""){
            $rows = $rows->where('name','LIKE','%'.$request->GET("staff_name").'%');
        }   

        if ($request->has('staff_phone') && $request->GET('staff_phone') != ""){
            $rows = $rows->where('phone','LIKE','%'.$request->GET("staff_phone").'%');
        }   

        if ($request->has('user_position_id') && $request->GET('user_position_id') != -1){
            $rows = $rows->where('user_position_id',$request->GET("user_position_id"));
        }


		$data=$rows->orderBy($sort,$order)->paginate(20);//->with('category', 'brand')->paginate(10);
		return view('admin.staff.index',['rows' => $data, 'users_position' => $users_position]);//, ['rows' => $data]);
    }	

    public function getCreate(){
    	//$staff = Staff::select('id','name','order_number','active')->get()->toArray();
    	$users_position = UsersPosition::select('id','name')->where('fixed',1)->get()->toArray();
    	return view('admin.staff.create',compact('users_position'));
    }

    public function postCreate(Request $request){

    	$this->validate($request,
            [
				'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'user_position_id' => 'required',
	        ],
            [
				'name.required' => 'Vui lòng nhập tên User!',
                'email.required' => 'Vui lòng nhập địa chỉ Email!',
                'email.unique' => 'Địa chỉ Email này đã tồn tại!',
                'password.required' => 'Vui lòng nhập mật khẩu!',
                'user_position_id.required' => 'Vui lòng chọn chức vụ nhân viên!',
            ]
        );

        $user_position_data = UsersPosition::find($request->user_position_id)->toArray();

    	$user = new Staff();
    	$user->name = $request->name;;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
        $user->identity_card_number = $request->identity_card_number;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->user_position_id  = $request->user_position_id;
    	$user->remember_token = $request->_token;
    	$user->user_position_id  = $request->user_position_id;
        $user->permissions = $user_position_data['permissions'];
    	$user->save();
    	return redirect()->route('admin.staff.index')->with(['flash_message' => 'Thêm nhân viên thành công!']);
    }

    

    public function getUpdate($id){
    	$user_current_login = Auth::user()->id;
    	$user = Staff::find($id);
    	$userdata = Staff::find($id)->toArray();
        $users_position = UsersPosition::select('id','name')->get()->toArray();


    	if($user_current_login == 1 || $id == $user_current_login){
        	return view('admin.staff.update',compact('userdata','users_position'));
        }else{
        	return redirect()->route('admin.staff.index')->with(['flash_message' => 'Bạn không có quyền sửa thông tin thành viên này!']);
        }
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'name' => 'required',
                'email' => 'required',
                'user_position_id' => 'required'
	        ],
            [
				'name.required' => 'Vui lòng nhập tên User!',
                'email.required' => 'Vui lòng nhập địa chỉ Email!',      
                'user_position_id.required' => 'Vui lòng chọn chức vụ nhân viên!'
            ]
        );

        $user_position_data = UsersPosition::find($request->user_position_id)->toArray();
        $user_data = Staff::find($id)->toArray();

        $user = new Staff();
        $user = Staff::find($id);
        $user->name = $request->name;
    	$user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->user_position_id  = $request->user_position_id;
        $user->identity_card_number = $request->identity_card_number;

        if($request->user_position_id != $user_data['user_position_id']){
            $user->permissions = $user_position_data['permissions'];
        }

    	if($request->input('password')){
    		$user->password = Hash::make($request->password);
    	}
    	$user->remember_token = $request->_token;
    	$user->save();
        return redirect()->route('admin.staff.index')->with(['flash_message' => 'Cập nhật thông tin thành công!']);
    }

    public function getPermissions(Request $request,$uid){
    	$user_data = Staff::find($uid);
    	$sort='order';
        $order='ASC';
        $rows = new Permissions();
        $data=$rows->orderBy($sort,$order)->get()->toArray();
        return view('admin.staff.permissions',compact('user_data','data'));
    }

    public function postPermissions(Request $request,$uid){
    	if($request->input('permissions_check')){
    		$permissions_check_data = $request->permissions_check;
    		$json_check_data = json_encode($permissions_check_data);
    		$user = Staff::find($uid);
    		$user->permissions = $json_check_data;
    		$user->save();
    	}else{
            $user = Staff::find($uid);
            $user->permissions = null;
            $user->save();
        }
        return redirect()->route('admin.staff.index')->with(['flash_message' => 'Cập nhật thông tin thành công!']);
    }

    // Danh sách đơn hàng
    public function getOrders(Request $request,$uid){

        $data_user = User::select('users.*')->where('id','=',$uid)->first();
        
        $sort='created_at';
        $order='desc';
        $rows = Orders::select('orders.*','payment_methods.name as payment_method_name')
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.order_status','!=',5)
                        ->where('orders.user_id','=',$uid);

        $sum_total_price = DB::table('orders')
                        ->select(DB::raw('SUM(total_price) as total_sales'))
                        ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                        ->leftJoin('payment_methods','payment_methods.id', '=', 'orders.payment_method_id')
                        ->where('orders.user_id','=',$uid);

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
        return view('admin.staff.orders', ['rows' => $data, 'order_total' => $order_total, 'total_order' => $total_order, 'uid' => $uid, 'data_user' => $data_user]);

    }

    public function getUserAutoComplete(Request $request){
        $usersArray = array();
        $data = User::select("id","name","email","phone","address")
                ->where("name","LIKE","%{$request->get('search-input-user')}%")
                ->where("user_position_id","=",4)
                ->orWhere("email","LIKE","%{$request->get('search-input-user')}%")
                ->where("user_position_id","=",4)
                ->orWhere("phone","LIKE","%{$request->get('search-input-user')}%")
                ->where("user_position_id","=",4)
                ->get();

        foreach($data as $index=>$user ){
            $usersArray[$index] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
            ];
        }
        return response()->json($usersArray);
    }

}
