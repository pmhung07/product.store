<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ShopPostCategories;

class ShopPostCategoriesController extends Controller {

    public function getIndex(Request $request){
        $sort='sort';
        $order='desc';
        $rows = new ShopPostCategories();

        if ($request->has('post_categories_name')){
            $rows = $rows->where('name', 'LIKE', '%'.$request->input("post_categories_name").'%');
        }
        $data=$rows->orderBy($sort,$order)->get()->toArray();//->with('category', 'brand')->paginate(10);
        return view('admin.post-categories.index',['data' => $data]);//, ['rows' => $data]);
    }

    public function getCreate(){
    	$parent = ShopPostCategories::select('id','name','parent_id')->get()->toArray();
    	return view('admin.post-categories.create',compact('parent'));
    }

    public function postCreate(Request $request){
    	$post_categories = new ShopPostCategories();
    	$post_categories->parent_id = $request->slc_post_categories;;
    	$post_categories->name = $request->post_categories_name;
    	$post_categories->save();
    	return redirect()->route('admin.post-categories.create')->with(['flash_message' => 'Thêm nhóm tin thành công!']);
    }

    public function getUpdate($id){
        $data = ShopPostCategories::find($id)->toArray();
        $parent = ShopPostCategories::get()->toArray();
        return view('admin.post-categories.update',compact('parent','data'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            ['post_categories_name' => 'required'],
            ['post_categories_name.required' => "Vui lòng nhập tên nhóm tin!"]
        );
        $post_categories = ShopPostCategories::find($id);
        $post_categories->parent_id = $request->post_categories_id;
        $post_categories->name = $request->post_categories_name;
        $post_categories->sort = (int) $request->get('sort');
        $post_categories->save();
        return redirect()->route('admin.post-categories.index')->with(['flash_message' => 'Cập nhật nhóm tin thành công!']);
    }

    public function getDelete($id){
        $countParent = ShopPostCategories::where('parent_id',$id)->count();
        if($countParent == 0){
            $data = ShopPostCategories::find($id);
            $data->delete($id);
            return redirect()->route('admin.post-categories.index')->with(['flash_message' => 'Xoá nhóm tin thành công!']);
        }else{
            echo "<script>
                    alert('Bạn không thể xoá dữ liệu này! Hiện tại có danh mục cấp thấp hơn còn tồn tại.');
                    window.location = '";
                        echo route('admin.post-categories.index');
            echo "'</script>";
        }
    }

    public function getCateList(){
        $data = ShopPostCategories::select('id','name','parent_id')->get()->toArray();
        return view('admin.post-categories.index',['data'=> $data]);
    }

}
