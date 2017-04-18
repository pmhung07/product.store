<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\UsersPosition;
use App\Permissions; 

use Carbon\Carbon;
use Auth;
use DB;
use Hash;


class UsersPositionController extends Controller
{
	public function getIndex(Request $request){
    	$sort='fixed';
		$order='desc';
		$rows = new UsersPosition();

		$data=$rows->orderBy($sort,$order)->paginate(20);//->with('category', 'brand')->paginate(10);
		return view('admin.position.index',['rows' => $data]);//, ['rows' => $data]);
    }	

    public function getPermissions(Request $request,$id){
        $user_position = UsersPosition::find($id);
        $sort='order';
        $order='ASC';
        $rows = new Permissions();
        $data=$rows->orderBy($sort,$order)->get()->toArray();
        return view('admin.position.permissions',compact('user_position','data'));
    }

    public function postPermissions(Request $request,$uid){
        if($request->input('permissions_check')){
            $permissions_check_data = $request->permissions_check;
            $json_check_data = json_encode($permissions_check_data);
            $user = UsersPosition::find($uid);
            $user->permissions = $json_check_data;
            $user->save();
        }else{
            $user = UsersPosition::find($uid);
            $user->permissions = null;
            $user->save();
        }
        return redirect()->route('admin.position.index')->with(['flash_message' => 'Cập nhật thông tin thành công!']);
    }

    public function getCreate(){
    	return view('admin.position.create');
    }

    public function postCreate(Request $request){

    	$this->validate($request,
            [
				'name' => 'required|unique:users_position,name',
	        ],
            [
                'name.required' => 'Vui lòng nhập tên chức vụ nhân viên!',
                'name.unique' => 'Chức vụ nhân viên này đã tồn tại!',
            ]
        );

    	$userPos = new UsersPosition();
    	$userPos->name = $request->name;;
    	$userPos->save();
    	return redirect()->route('admin.position.index')->with(['flash_message' => 'Thêm chức vụ nhân viên thành công!']);
    }

    

    public function getUpdate($id){
    	$user_current_login = Auth::user()->id;
    	$user = Staff::find($id);
    	$userdata = Staff::find($id)->toArray();


    	if($user_current_login == 1 || $id == $user_current_login){
        	return view('admin.staff.update',compact('userdata'));
        }else{
        	return redirect()->route('admin.staff.index')->with(['flash_message' => 'Bạn không có quyền sửa thông tin thành viên này!']);
        }
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'name' => 'required',
                'email' => 'required',
	        ],
            [
				'name.required' => 'Vui lòng nhập tên User!',
                'email.required' => 'Vui lòng nhập địa chỉ Email!',      
            ]
        );

        $user = new Staff();
        $user = Staff::find($id);
        $user->name = $request->name;
    	$user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
    	if($request->input('password')){
    		$user->password = Hash::make($request->password);
    	}
    	$user->remember_token = $request->_token;
    	$user->save();
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
}
