<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductGroup;
use App\ProductImage;
use App\Units;
<<<<<<< HEAD
use App\ProductProperties;
use App\Properties;
use App\PropertiesValue;

=======
>>>>>>> c716c67dc84bf2257e7c9a984900bcd2e7ec3236
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

    public function getDeleteProperties($id){
        $data = ProductProperties::find($id);
        $data->delete($id);
        return redirect()->back()->with(['flash_message' => 'Xoá thuộc tính thành công!']);   
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

    public function getPropertiesAutoComplete(Request $request){
        $dataArray = array();    
        $data = Properties::select("id","name")
                ->where("name","LIKE","%{$request->get('search-properties')}%")
                ->get();
        
        foreach($data as $index=>$user ){
            $dataArray[$index] = [
                'id' => $user->id,
                'name' => $user->name,
            ];
        }
        return response()->json($dataArray);
    }

    public function getProperties($id){
        $data = Product::find($id)->toArray();
        $properties = ProductProperties::select('product_properties.id as product_properties_id','product_properties.image as product_properties_image','properties.id as properties_id','properties.name as properties_name','properties_value.id as properties_value_id','properties_value.name as properties_value_name')
                        ->leftjoin('properties', 'properties.id', '=', 'product_properties.properties_id')
                        ->leftjoin('properties_value', 'properties_value.id', '=', 'product_properties.properties_value_id')
                        ->where('product_properties.product_id',$id)
                        ->get()->toArray();

        /*
        $arr_properties = array();
        foreach($properties as $value){
            if($value['product_properties_image'] == ''){
                $product_properties_image = 'notfound';
            }else{
                $product_properties_image = $value['product_properties_image'];
            }
            if( !array_key_exists( $value['properties_id'], $arr_properties ) ){
                $arr_properties[$value['properties_id']] = array('properties_value_id' => $value['properties_value_id'], 'image' =>  $product_properties_image, 'properties_name' => $value['properties_name'], 'properties_value_name' => $value['properties_value_name']);
            }else{
                $arr_properties[$value['properties_id']]['properties_value_id']     =  $arr_properties[$value['properties_id']]['properties_value_id'].','.$value['properties_value_id'];
                $arr_properties[$value['properties_id']]['image']                   =  $arr_properties[$value['properties_id']]['image'].','.$product_properties_image;
                $arr_properties[$value['properties_id']]['properties_name']         =  $arr_properties[$value['properties_id']]['properties_name'].','.$value['properties_name'];
                $arr_properties[$value['properties_id']]['properties_value_name']   =  $arr_properties[$value['properties_id']]['properties_value_name'].','.$value['properties_value_name'];
            }
        }
        */

        return view('admin.product.properties',compact('data','properties'));
    }

    public function updateProperties(Request $request, $id){
        //  Kiểm tra xem thuốc tính có tồn tại không
        $properties = Properties::select('id')->where('name','LIKE', $request->properties_name)->get()->toArray();
        if (count($properties) <= 0){
            $properties = new Properties();
            $properties->name = $request->properties_name;
            $properties->save();
            $properties_id = $properties->id;
            // Update Value
            $properties_value_update = new PropertiesValue();
            $properties_value_update->properties_id = $properties_id;
            $properties_value_update->name = $request->properties_value;
            $properties_value_update->save();
            $properties_value_id = $properties_value_update->id;
            // Update Product_properties
            $product_properties = new ProductProperties();
            $product_properties->product_id = $id;
            $product_properties->properties_id = $properties_id;
            $product_properties->properties_value_id = $properties_value_id;
            $product_properties->save();
            return redirect()->route('admin.product.getProperties',$id)->with(['flash_message' => 'Cập nhật thuộc tính sản phẩm thành công!']);
        }else{  
            $properties_value_count = PropertiesValue::select('id')
                                    ->where('name','LIKE', $request->properties_value)
                                    ->where('properties_id',$properties[0]['id'])
                                    ->get()->toArray();
            // Nếu giá trị thuộc tính này chưa tồn tại
            if (count($properties_value_count) <= 0){
                $properties_value_update = new PropertiesValue();
                $properties_value_update->properties_id = $properties[0]['id'];
                $properties_value_update->name = $request->properties_value;
                $properties_value_update->save();
                $properties_value_id = $properties_value_update->id;
                // Update Product_properties
                $product_properties = new ProductProperties();
                $product_properties->product_id = $id;
                $product_properties->properties_id = $properties[0]['id'];
                $product_properties->properties_value_id = $properties_value_id;
                $product_properties->save();
                return redirect()->route('admin.product.getProperties',$id)->with(['flash_message' => 'Cập nhật thuộc tính sản phẩm thành công!']);
            }else{  
                $product_properties = ProductProperties::select('id')
                                    ->where('properties_id',$properties[0]['id'])
                                    ->where('properties_value_id',$properties_value_count[0]['id'])
                                    ->where('product_id',$id)
                                    ->get()->toArray();

                if (count($product_properties) <= 0){
                    $product_properties = new ProductProperties();
                    $product_properties->product_id = $id;
                    $product_properties->properties_id = $properties[0]['id'];
                    $product_properties->properties_value_id = $properties_value_count[0]['id'];
                    $product_properties->save();
                    return redirect()->route('admin.product.getProperties',$id)->with(['flash_message' => 'Cập nhật thuộc tính sản phẩm thành công!']);
                } else{
                    return redirect()->route('admin.product.getProperties',$id)->with(['flash_error' => 'Thuộc tính này đã tồn tại trên sản phẩm!']);
                }
            }
        }
    }

}
