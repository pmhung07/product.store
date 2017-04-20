<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ShopPostCategories;
use App\ShopPost;

use DB;

class ShopPostController extends Controller
{
    public function getCreate(){
    	$post_categories = ShopPostCategories::select('id','name','parent_id')->get()->toArray();
    	return view('admin.post.create',compact('post_categories'));
    }

    public function postCreate(Request $request){
    	$shoppost = new ShopPost();
    	$shoppost->category_id = $request->category_id;;
    	$shoppost->title = $request->title;
    	$shoppost->content = $request->content;
    	$shoppost->teaser = $request->teaser;
    	$shoppost->meta_title = $request->meta_title;
        $shoppost->meta_keyword = $request->meta_keyword;
        $shoppost->meta_description = $request->meta_description;
    	$shoppost->save();
    	return redirect()->route('admin.post.getCreate')->with(['flash_message' => 'Thêm tin thành công!']);
    }

    public function getIndex(Request $request){

        $sort='created_at';
        $orderby='desc';

        $post_categories = ShopPostCategories::select('id','name','parent_id')->get()->toArray();

        $rows = ShopPost::select('shop_posts.*','shop_post_categories.id as shop_post_categories_id','shop_post_categories.name as shop_post_categories_name')
                        ->leftjoin('shop_post_categories', 'shop_post_categories.id', '=', 'shop_posts.category_id');

        if ($request->has('title') && $request->GET('title') != ""){
            $rows = $rows->where('shop_posts.title','LIKE','%'.$request->GET("title").'%');
        }   

        $data = $rows->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.post.index', ['rows' => $data, 'total_row' => $total_row, 'post_categories' => $post_categories]);

    }

    public function getDelete($id){
        $data = ShopPost::find($id);
        $data->delete($id);
        return redirect()->route('admin.post.index')->with(['flash_message' => 'Xoá tin thành công!']);    
    }

    public function getUpdate($id){

    	$post_categories = ShopPostCategories::select('id','name','parent_id')->get()->toArray();

        $data = ShopPost::find($id)->toArray();
        return view('admin.post.update',compact('post_categories','data'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'title' => 'required'
	        ],
            [
				'title.required' => 'Vui lòng nhập tiêu đề tin!'
             ]
        );
        $shoppost = new ShopPost();
        $shoppost = ShopPost::find($id);
    	$shoppost->category_id = $request->category_id;;
        $shoppost->title = $request->title;
        $shoppost->content = $request->content;
        $shoppost->teaser = $request->teaser;
        $shoppost->meta_title = $request->meta_title;
        $shoppost->meta_keyword = $request->meta_keyword;
        $shoppost->meta_description = $request->meta_description;
    	$shoppost->save();
        return redirect()->route('admin.post.index')->with(['flash_message' => 'Cập nhật tin thành công!']);
    }
}
