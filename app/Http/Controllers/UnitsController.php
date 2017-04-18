<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Units;

class UnitsController extends Controller
{
    public function getCreate(){
    	return view('admin.units.create');
    }

    public function postCreate(Request $request){
    	$this->validate($request,
            [
				'name' => 'required|unique:payment_methods,name'
	        ],
            [
				'name.required' => 'Vui lòng nhập đơn vị đo sản phẩm!',
				'name.unique' => 'Đơn vị đo sản phẩm này đã tồn tại trên hệ thống!'
            ]
        );
    	$units = new Units();
    	$units->name = $request->name;
    	$units->save();
    	return redirect()->route('admin.units.getCreate')->with(['flash_message' => 'Tạo đơn vị đo sản phẩm thành công!']);
    }
    
    public function getIndex(Request $request){
    	$sort='id';
		$order='desc';
		$rows = new Units();

		$data=$rows->orderBy($sort,$order)->paginate(20);//->with('category', 'brand')->paginate(10);
		return view('admin.units.index',['rows' => $data]);//, ['rows' => $data]);
    }

    public function getUpdate($id){

    	$units = Units::find($id)->toArray();
        return view('admin.units.update',compact('units'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'name' => 'required'
	        ],
            [
				'name.required' => 'Vui lòng nhập tên đơn vị đo sản phẩm!'
            ]
        );
        $units = new Units();
        $units = Units::find($id);
    	$units->name = $request->name;;
    	$units->save();
        return redirect()->route('admin.units.index')->with(['flash_message' => 'Cập nhật đơn vị đo sản phẩm thành công!']);
    }

    
    public function getDelete($id){
        $data = Units::find($id);
        $data->delete($id);
        return redirect()->route('admin.units.index')->with(['flash_message' => 'Xoá dữ liệu đơn vị đo sản phẩm thành công!']);    
    }
}
