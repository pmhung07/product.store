<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PaymentMethods;

class PaymentMethodsController extends Controller
{
    public function getCreate(){
    	return view('admin.payment-method.create');
    }

    public function postCreate(Request $request){
    	$this->validate($request,
            [
				'payment_method_name' => 'required|unique:payment_methods,name'
	        ],
            [
				'payment_method_name.required' => 'Vui lòng nhập tên phương thức thanh toán!',
				'payment_method_name.unique' => 'Phương thức thanh toán này đã tồn tại trên hệ thống!'
            ]
        );
    	$payment_method = new PaymentMethods();
    	$payment_method->name = $request->payment_method_name;
    	$payment_method->save();
    	return redirect()->route('admin.payment-method.getCreate')->with(['flash_message' => 'Tạo phương thức thanh toán thành công!']);
    }
    
    public function getIndex(Request $request){
    	$sort='type';
		$order='desc';
		$rows = new PaymentMethods();

        $rows = PaymentMethods::select('payment_methods.*');
        
        if ($request->has('admin_id') && $request->GET('admin_id') != 0){
            $rows = $rows->where('payment_methods.admin_id','=',$request->GET("admin_id"));
        }   

        $data = $rows->orderBy($sort,$order)->paginate(20);

        return view('admin.payment-method.index', ['rows' => $data]);

    }

    public function getUpdate($id){

    	$payment_method = PaymentMethods::find($id)->toArray();
        return view('admin.payment-method.update',compact('payment_method'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'payment_method_name' => 'required'
	        ],
            [
				'payment_method_name.required' => 'Vui lòng nhập tên phương thức thanh toán!'
            ]
        );
        $payment_method = new PaymentMethods();
        $payment_method = PaymentMethods::find($id);
    	$payment_method->name = $request->payment_method_name;;
    	$payment_method->save();
        return redirect()->route('admin.payment-method.index')->with(['flash_message' => 'Cập nhật phương thức thanh toán thành công!']);
    }

    public function getDelete($id){
        $data = PaymentMethods::find($id);
        $data->delete($id);
        return redirect()->route('admin.payment-method.index')->with(['flash_message' => 'Xoá phương thức thanh toán thành công!']);    
    }
}
