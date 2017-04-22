<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Requests\Core\PageFormRequest;
use App\ShopPage;
use DB;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    public function __construct()
    {
        $this->imageUploader = App::make('ImageUploader');
    }

    public function getCreate(){
    	return view('admin.page.create');
    }

    public function postCreate(PageFormRequest $request){
    	$page = new ShopPage();
    	$page->title = $request->title;
    	$page->content = $request->content;
    	$page->teaser = $request->teaser;
    	$page->meta_title = $request->meta_title;
        $page->meta_keyword = $request->meta_keyword;
        $page->meta_description = $request->meta_description;
    	$page->save();
    	return redirect()->route('admin.page.index')->with(['flash_message' => 'Thêm thành công!']);
    }

    public function getIndex(Request $request){

        $sort='created_at';
        $orderby='desc';

        $rows = ShopPage::whereRaw(1);

        if ($request->has('title') && $request->GET('title') != ""){
            $rows = $rows->where('title','LIKE','%'.$request->GET("title").'%');
        }

        $data = $rows->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.page.index', ['rows' => $data, 'total_row' => $total_row]);

    }

    public function getDelete($id){
        $data = ShopPage::find($id);
        $data->delete($id);
        return redirect()->route('admin.page.index')->with(['flash_message' => 'Xoá thành công!']);
    }

    public function getUpdate($id){
        $data = ShopPage::findOrFail($id);
        return view('admin.page.update',compact('data'));
    }

    public function postUpdate(PageFormRequest $request,$id){
        $page = ShopPage::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->teaser = $request->teaser;
        $page->meta_title = $request->meta_title;
        $page->meta_keyword = $request->meta_keyword;
        $page->meta_description = $request->meta_description;
    	$page->save();
        return redirect()->route('admin.page.index')->with(['flash_message' => 'Cập nhật thành công!']);
    }
}
