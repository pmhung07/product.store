<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductGroup;
use App\ProductImage;
use App\Units;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->imageUploader = App::make('ImageUploader');
    }

    public function getCreate(){
    	$group_product = ProductGroup::select('id','name','parent_id')->get()->toArray();
    	$units = Units::select('id','name')->where('active','=',1)->get()->toArray();
    	return view('admin.product.create',compact('group_product','units'));
    }

    public function postCreate(ProductRequest $request){
    	$product = new Product();
    	$product->product_group_id = $request->product_group;;
    	$product->unit_id = $request->product_unit;
    	$product->name = $request->product_name;
    	$product->sku = $request->product_sku;
    	$product->barcode = $request->product_barcode;
    	$product->price = to_numberic($request->product_price);
        $product->warning_out_of_stock = $request->product_warning_low_in_stock;
        $product->weight = $request->product_weight;
        $product->volume = $request->product_volume;
        $product->promotion_price = to_numberic($request->promotion_price);

        if($request->hasFile('image')) {
            $resultUpload = $this->imageUploader->upload('image');
            if($resultUpload['status'] > 0) {
                $product->image = $resultUpload['filename'];
            }
        }

        $product->save();

        if($request->hasFile('images')) {
            $resultUpload = $this->imageUploader->uploadMulti('images');
            foreach($resultUpload['filename'] as $filename) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $filename;
                $productImage->save();
            }
        }

    	return redirect()->route('admin.product.getCreate')->with(['flash_message' => 'Thêm sản phẩm thành công!']);
    }

    public function getIndex(Request $request){

        $sort='quantity_inventory';
        $orderby='asc';

        $product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = Product::select('product.*','product_group.id as product_group_id','product_group.name as product_group_name',DB::raw('SUM(warehouse_inventory.quantity) as quantity_inventory'))
                        ->leftjoin('product_group', 'product.product_group_id', '=', 'product_group.id')
                        ->leftjoin('warehouse_inventory', 'warehouse_inventory.product_id', '=', 'product.id');

        if ($request->has('filter-product-sku') && $request->GET('filter-product-sku') != ""){
            $rows = $rows->where('product.sku','LIKE','%'.$request->GET("filter-product-sku").'%');
        }

        if ($request->has('filter-product-name') && $request->GET('filter-product-name') != ""){
            $rows = $rows->where('product.name','LIKE','%'.$request->GET("filter-product-name").'%');
        }

        if ($request->has('filter-product-groupt-id') && $request->GET('filter-product-groupt-id') != -1){
            $rows = $rows->where('product_group.id',$request->GET("filter-product-groupt-id"));
        }

        $data = $rows->groupBy('product.id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.product.index', ['rows' => $data, 'total_row' => $total_row, 'product_group' => $product_group]);

    }

    public function getDelete($id){
        $data = Product::find($id);
        $data->delete($id);
        return redirect()->route('admin.product.index')->with(['flash_message' => 'Xoá sản phẩm thành công!']);
    }

    public function getUpdate($id){

    	$group_product = ProductGroup::select('id','name','parent_id')->get()->toArray();
    	$units = Units::select('id','name')->where('active','=',1)->get()->toArray();

        $data = Product::find($id)->toArray();
        return view('admin.product.update',compact('group_product','data', 'units'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'product_name' => 'required',
				'product_sku' => 'required',
				'product_group' => 'required',
				'product_unit' => 'required',
				'product_price' => 'required'
	        ],
            [
				'product_name.required' => 'Vui lòng nhập tên sản phẩm!',
				'product_sku.required' => 'Vui lòng nhập mã sản phẩm!',
				'product_group.required' => 'Vui lòng chọn nhóm sản phẩm!',
				'product_unit.required' => 'Vui lòng chọn đơn vị đo sản phẩm!',
				'product_price.required' => 'Vui lòng nhập giá bán sản phẩm!'
             ]
        );
        $product = new Product();
        $product = Product::find($id);
    	$product->product_group_id = $request->product_group;;
    	$product->unit_id = $request->product_unit;
    	$product->name = $request->product_name;
    	$product->sku = $request->product_sku;
    	$product->barcode = $request->product_barcode;
    	$product->price = $request->product_price;
        $product->warning_out_of_stock = $request->product_warning_low_in_stock;
        $product->weight = $request->product_weight;
        $product->volume = $request->product_volume;

        if($request->hasFile('image')) {
            $resultUpload = $this->imageUploader->upload('image');
            if($resultUpload['status'] > 0) {
                $product->image = $resultUpload['filename'];
            }
        }

    	$product->save();

        if($request->hasFile('images')) {
            $resultUpload = $this->imageUploader->uploadMulti('images');
            foreach($resultUpload['filename'] as $filename) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $filename;
                $productImage->save();
            }
        }

        return redirect()->route('admin.product.index')->with(['flash_message' => 'Cập nhật sản phẩm thành công!']);
    }
}
