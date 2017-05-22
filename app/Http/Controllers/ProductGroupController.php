<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductGroupRequest;
use App\ProductGroup;
use App;

class ProductGroupController extends Controller
{
    public function __construct()
    {
        $this->imageUploader = App::make('ImageUploader');
    }

    public function getCreate(){
    	$parent = ProductGroup::select('id','name','parent_id')->get()->toArray();
    	return view('admin.product-group.create',compact('parent'));
    }

    public function postCreate(ProductGroupRequest $request){
    	$product_group = new ProductGroup();
    	$product_group->parent_id = $request->slc_product_group;;
    	$product_group->name = $request->name_product_group;
    	$product_group->description = $request->des_product_group;
        if($request->hasFile('icon')) {
            $resultUpload = $this->imageUploader->upload('icon');
            $product_group->icon = $resultUpload['filename'];
        }
    	$product_group->save();
    	return redirect()->route('admin.product-group.getCreate')->with(['flash_message' => 'Thêm nhóm sản phẩm thành công!']);
    }

    public function getIndex(Request $request){
        $sort='id';
        $order='desc';
        $rows = new ProductGroup();
        //$data_paging = ProductGroup::where('parent_id','==',0)->paginate(1);
        //$data = ProductGroup::select('id','name','parent_id')->get()->toArray();
        //return view('admin.product-group.index',compact('data','data_paging'));

        if ($request->has('product_group_name')){
            $rows = $rows->where('name', 'LIKE', '%'.$request->input("product_group_name").'%');
        }
        $data=$rows->orderBy($sort,$order)->get()->toArray();//->with('category', 'brand')->paginate(10);
        return view('admin.product-group.index',['data' => $data]);//, ['rows' => $data]);
    }

    public function getDelete($id){
        $countParent = ProductGroup::where('parent_id',$id)->count();
        if($countParent == 0){
            $data = ProductGroup::find($id);
            $data->delete($id);
            return redirect()->route('admin.product-group.index')->with(['flash_message' => 'Xoá nhóm sản phẩm thành công!']);
        }else{
            echo "<script>
                    alert('Bạn không thể xoá dữ liệu này! Hiện tại có danh mục cấp thấp hơn còn tồn tại.');
                    window.location = '";
                        echo route('admin.product-group.index');
            echo "'</script>";
        }
    }

    public function getUpdate($id){
        $data = ProductGroup::find($id);
        $parent = ProductGroup::select('id','name','parent_id')->get()->toArray();
        return view('admin.product-group.update',compact('parent','data'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            ['name_product_group' => 'required'],
            ['name_product_group.required' => "Vui lòng nhập tên nhóm sản phẩm!"]
        );
        $product_group = ProductGroup::find($id);
        $product_group->parent_id = $request->slc_product_group;;
        $product_group->name = $request->name_product_group;
        $product_group->description = $request->des_product_group;

        if($request->hasFile('icon')) {
            $resultUpload = $this->imageUploader->upload('icon');
            $product_group->icon = $resultUpload['filename'];
        }

        $product_group->save();
        return redirect()->route('admin.product-group.index')->with(['flash_message' => 'Cập nhật nhóm sản phẩm thành công!']);
    }

    public function getCateList(){
        $data = ProductGroup::select('id','name','parent_id')->get()->toArray();
        return view('admin.product-group.index',['data'=> $data]);
    }


    public function ajaxSearchProductGroup(Request $request)
    {
        $q = clean($request->get('q'));

        $groups = ProductGroup::where('name', 'LIKE', '%'. $q .'%')->take(20)->orderBy('updated_at', 'DESC')->get();

        $json = [];

        foreach($groups as $item) {
            $json[] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        }

        return response()->json($json);
    }

}
