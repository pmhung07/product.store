<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Requests\Core\PostFormRequest;
use App\ShopPost;
use App\ShopPostCategories;
use App\ProductGroup;
use App\ShopPostSuggest;
use DB;
use Illuminate\Http\Request;

class ShopPostSuggestController extends Controller
{
    public function __construct()
    {
        $this->imageUploader = App::make('ImageUploader');
    }

    public function getCreate(){
    	$post_categories = ProductGroup::select('id','name','parent_id')->get()->toArray();
    	return view('admin.post-suggest.create',compact('post_categories'));
    }

    public function postCreate(PostFormRequest $request){
    	$shoppost = new ShopPostSuggest();
    	$shoppost->product_group_id = $request->category_id;;
    	$shoppost->title = $request->title;
    	$shoppost->content = $request->content;
    	$shoppost->teaser = $request->teaser;
    	$shoppost->meta_title = $request->meta_title;
        $shoppost->meta_keyword = $request->meta_keyword;
        $shoppost->meta_description = $request->meta_description;
        $shoppost->tags = clean($request->get('tags'));

        if($request->hasFile('image')) {
            $result = $this->imageUploader->upload('image');
            if($result['status'] > 0) {
                $shoppost->image = $result['filename'];
            }
        }

    	$shoppost->save();
    	return redirect()->route('admin.post-suggest.getCreate')->with(['flash_message' => 'Thêm tin thành công!']);
    }

    public function getIndex(Request $request){

        $sort='created_at';
        $orderby='desc';

        $post_categories = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = ShopPostSuggest::select('shop_posts_suggest.*','product_group.id as shop_post_categories_id','product_group.name as shop_post_categories_name')
                        ->leftjoin('product_group', 'product_group.id', '=', 'shop_posts_suggest.product_group_id');

        if ($request->has('title') && $request->GET('title') != ""){
            $rows = $rows->where('shop_posts_suggest.title','LIKE','%'.$request->GET("title").'%');
        }

        $data = $rows->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.post-suggest.index', ['rows' => $data, 'total_row' => $total_row, 'post_categories' => $post_categories]);

    }

    public function getDelete($id){
        $data = ShopPostSuggest::find($id);
        $data->delete($id);
        return redirect()->route('admin.post.index')->with(['flash_message' => 'Xoá tin thành công!']);
    }

    public function getUpdate($id){

    	$post_categories = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $data = ShopPostSuggest::findOrFail($id);
        return view('admin.post-suggest.update',compact('post_categories','data'));
    }

    public function postUpdate(PostFormRequest $request,$id){
        $shoppost = new ShopPostSuggest();
        $shoppost = ShopPostSuggest::find($id);
    	$shoppost->product_group_id = $request->category_id;;
        $shoppost->title = $request->title;
        $shoppost->content = $request->content;
        $shoppost->teaser = $request->teaser;
        $shoppost->meta_title = $request->meta_title;
        $shoppost->meta_keyword = $request->meta_keyword;
        $shoppost->meta_description = $request->meta_description;
        $shoppost->tags = clean($request->get('tags'));

        if($request->hasFile('image')) {
            $result = $this->imageUploader->upload('image');
            if($result['status'] > 0) {
                $shoppost->image = $result['filename'];
            }
        }

    	$shoppost->save();
        return redirect()->route('admin.post-suggest.index')->with(['flash_message' => 'Cập nhật tin thành công!']);
    }
}
