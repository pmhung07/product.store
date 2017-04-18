<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Supplier;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function getCreate(){
    	return view('admin.supplier.create');
    }

    public function postCreate(Request $request){
    	$this->validate($request,
            [
				'name' => 'required|unique:supplier,name',
				'phone' => 'required|unique:supplier,phone',
				'email' => 'required|unique:supplier,email',
				'address' => 'required'
	        ],
            [
				'name.required' => 'Vui lòng nhập tên nhà cung cấp!',
				'name.unique' => 'Nhà cung cấp này đã tồn tại!',
				'phone.required' => 'Vui lòng nhập số điện thoại!',
				'phone.unique' => 'Số điện thoại này đã tồn tại!',
				'email.required' => 'Vui lòng nhập địa chỉ Email!',
				'email.unique' => 'Địa chỉ Email này đã tồn tại!',
				'address.required' => 'Vui lòng nhập địa chỉ!',
            ]
        );
    	$supplier = new Supplier();
    	$supplier->name = $request->name;
    	$supplier->phone = $request->phone;
    	$supplier->email = $request->email;
    	$supplier->address = $request->address;
    	$supplier->save();
    	return redirect()->route('admin.supplier.getCreate')->with(['flash_message' => 'Thêm thông tin nhà cung cấp thành công!']);
    }
    
    public function getIndex(Request $request){
    	$sort='id';
		$order='desc';
		$rows = new Supplier();

		$data=$rows->orderBy($sort,$order)->paginate(20);//->with('category', 'brand')->paginate(10);
		return view('admin.supplier.index',['rows' => $data]);//, ['rows' => $data]);
    }

    public function getUpdate($id){

    	$supplier = Supplier::find($id)->toArray();
        return view('admin.supplier.update',compact('supplier'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'name' => 'required',
				'phone' => 'required',
				'email' => 'required',
				'address' => 'required'
	        ],
            [
				'name.required' => 'Vui lòng nhập tên nhà cung cấp!',
				'phone.required' => 'Vui lòng nhập số điện thoại!',
				'email.required' => 'Vui lòng nhập Email!',
				'address.required' => 'Vui lòng nhập địa chỉ!'
            ]
        );
        $supplier = new Supplier();
        $supplier = Supplier::find($id);
    	$supplier->name = $request->name;
    	$supplier->phone = $request->phone;
    	$supplier->email = $request->email;
    	$supplier->address = $request->address;
    	$supplier->save();
        return redirect()->route('admin.supplier.index')->with(['flash_message' => 'Cập nhật thông tin nhà cung cấp thành công!']);
    }

    public function getDelete($id){
        $data = Supplier::find($id);
        $data->delete($id);
        return redirect()->route('admin.supplier.index')->with(['flash_message' => 'Xoá thông tin nhà cung cấp thành công!']);    
    }
}
