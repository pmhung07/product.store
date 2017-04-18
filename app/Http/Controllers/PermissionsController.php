<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Requests;
use App\Http\Requests\PermissionsRequest;
use App\Permissions;

class PermissionsController extends Controller
{
    public function getCreate(){
    	$parent = Permissions::select('id','name','parent_id')->get()->toArray();
    	return view('admin.permissions.create',compact('parent'));
    }

    public function postCreate(PermissionsRequest $request){
    	$permissions = new Permissions();
    	$permissions->parent_id = $request->slc_name;;
    	$permissions->name = $request->name;
    	$permissions->description = $request->description;
    	$permissions->slug = $request->slug;
        $permissions->order = $request->order;
    	$permissions->save();
    	return redirect()->route('admin.permissions.getCreate')->with(['flash_message' => 'Thêm quyền hạn thành công!']);
    }

    public function getIndex(Request $request){
        $sort='order';
        $order='ASC';
        $rows = new Permissions();

        if ($request->has('name')){
            $rows = $rows->where('name', 'LIKE', '%'.$request->input("name").'%');
        }
        $data=$rows->orderBy($sort,$order)->get()->toArray();//->with('category', 'brand')->paginate(10);
        return view('admin.permissions.index',['data' => $data]);//, ['rows' => $data]);
    }

    public function getDelete($id){
        $countParent = Permissions::where('parent_id',$id)->count();
        if($countParent == 0){
            $data = Permissions::find($id);
            $data->delete($id);
            return redirect()->route('admin.permissions.index')->with(['flash_message' => 'Xoá quyền hạn thành công!']);    
        }else{
            echo "<script>
                    alert('Bạn không thể xoá dữ liệu này! Hiện tại có danh mục cấp thấp hơn còn tồn tại.');
                    window.location = '";
                        echo route('admin.permissions.index');
            echo "'</script>";
        }
    }

    public function getUpdate($id){
        $data = Permissions::find($id)->toArray();
        $parent = Permissions::select('id','name','parent_id')->get()->toArray();
        //$currentPath= Route::getCurrentRoute()->getName();
        //echo $currentPath;die();
        return view('admin.permissions.update',compact('parent','data'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => "Vui lòng nhập tên quyền hạn!"]
        );
        $permissions = Permissions::find($id);
        $permissions->parent_id = $request->slc_name;
        $permissions->name = $request->name;
        $permissions->description = $request->description;
        $permissions->order = $request->order;
        $permissions->slug = $request->slug;
        $permissions->save();
        return redirect()->route('admin.permissions.index')->with(['flash_message' => 'Cập nhật quyền hạn thành công!']);
    }

    public function getCateList(){
        $data = Permissions::select('id','name','parent_id')->get()->toArray();
        return view('admin.permissions.index',['data'=> $data]);
    }

}
