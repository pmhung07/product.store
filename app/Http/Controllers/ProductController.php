<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Models\VariantCombination;
use App\Models\VariantValue;
use App\Product;
use App\ProductGroup;
use App\ProductImage;
use App\ProductProperties;
use App\Properties;
use App\PropertiesValue;
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

    public function postCreate(ProductRequest $request) {
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
        $product->spec = clean($request->get('spec'), 'youtube');
        $product->content = clean($request->get('content', 'youtube'));

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

        // Tạo variant
        $properties = (array) $request->get('option');
        $values = (array) $request->get('value');

        $arrayAllValueIds = array();

        foreach($properties as $key => $property) {
            $propertyModel = new Properties;
            $propertyModel->product_id = $product->id;
            $propertyModel->admin_id = $request->user()->id;
            $propertyModel->name = clean($property);
            $propertyModel->save();
            if(isset($values[$key]) && $values[$key]) {
                $arrayValues = explode(',', $values[$key]);
                $_valueIds = [];
                foreach($arrayValues as $value) {
                    $propertyValueModel = new PropertiesValue;
                    $propertyValueModel->properties_id = $propertyModel->id;
                    $propertyValueModel->name = clean($value);
                    $propertyValueModel->save();
                    $_valueIds[] = $propertyValueModel->id;
                }

                $arrayAllValueIds[] = $_valueIds;
            }
        }

        // Tạo biến thể
        $valueCombinationArray = combinations($arrayAllValueIds);
        foreach($valueCombinationArray as &$value) {
            if(!is_array($value)) $value = [$value];
        }
        unset($value);

        foreach($valueCombinationArray as $key => $valueIdArray) {
            // Tạo sản phẩm con
            $childProduct = new Product;
            $childProduct->name = $product->name;
            $childProduct->parent_id = $product->id;
            $childProduct->save();

            // Tạo biến thể
            // Nếu có nhiều hơn 1 thuộc tính thì giá trị sẽ là mảng
            foreach($valueIdArray as $k => $valueId) {
                $variantValueModel = new VariantValue;
                $variantValueModel->product_id = $product->id;
                $variantValueModel->variant_id = $childProduct->id;
                $variantValueModel->values_str = implode(',', $valueIdArray);
                $variantValueModel->values_int = implode('', $valueIdArray);
                $variantValueModel->save();
            }

            $product->has_child = 1;
            $product->save();
        }

        return response()->json([
            'code' => 1,
            'message' => 'Thêm sản phẩm thành công!',
            'redirect' => route('admin.product.getUpdate', $product->id)
        ]);
    }

    public function getIndex(Request $request){
        $sort = 'updated_at';
        $orderby = 'desc';

        $product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = Product::select('product.*','product_group.id as product_group_id','product_group.name as product_group_name',DB::raw('SUM(warehouse_inventory.quantity) as quantity_inventory'))
                        ->where('product.parent_id', '=', 0)
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

        $data = Product::find($id);
        $product = $data;

        $hasVariant = Product::where('parent_id', $id)->count();

        $properties = Properties::where('product_id', $id)->get();
        foreach($properties as $property) {
            $values = PropertiesValue::where('properties_id', $property->id)->get();
            $property->values = $values;
        }

        $childProducts = Product::where('product.parent_id', $id)
                                ->select('product.*')
                                ->get();

        foreach($childProducts as $item) {
            // Lọc từng sp con, lấy ra value_id của nó
            $variantValue = VariantValue::where('variant_id', $item->id)->first();
            if($variantValue) {
                $valueIds = explode(',', $variantValue->values_str);
                $values = PropertiesValue::whereIn('id', $valueIds)->get();

                $_properties = [];
                foreach($values as $vItem) {
                    $_properties[$vItem->properties_id][] = $vItem->name;
                }

                $item->property = $_properties;
            }
        }

        return view('admin.product.update',compact('group_product','data', 'product', 'units', 'hasVariant', 'properties', 'childProducts'));
    }

    public function postUpdate(Request $request,$id) {
        $product = Product::find($id);
        $rules = [
            'product_name' => 'required',
            'product_sku' => 'required',
            'product_group' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required'
        ];

        $messages = [
            'product_name.required' => 'Vui lòng nhập tên sản phẩm!',
            'product_sku.required' => 'Vui lòng nhập mã sản phẩm!',
            'product_group.required' => 'Vui lòng chọn nhóm sản phẩm!',
            'product_unit.required' => 'Vui lòng chọn đơn vị đo sản phẩm!',
            'product_price.required' => 'Vui lòng nhập giá bán sản phẩm!'
        ];

        if($product->hasChild()) unset($rules['product_sku']);

        $this->validate($request,$rules,$messages);

    	$product->product_group_id = (int) $request->get('product_group');
    	$product->unit_id = $request->product_unit;
    	$product->name = $request->product_name;
    	$product->sku = $request->product_sku;
    	$product->barcode = $request->product_barcode;
    	$product->price = $request->product_price;
        $product->warning_out_of_stock = $request->product_warning_low_in_stock;
        $product->weight = $request->product_weight;
        $product->volume = $request->product_volume;
        $product->spec = clean($request->get('spec'), 'youtube');
        $product->content = clean($request->get('content'), 'youtube');

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

        // Tạo, chỉnh sửa biến thể
        $childProductDataFormRequest = (array) $request->get('child_product');

        // Validate sku của sản phẩm con, tránh trùng lặp
        foreach($childProductDataFormRequest as $k => $arrayData) {
            $sku = array_get($arrayData, 'sku');
            $pid = (int) array_get($arrayData, 'id');
            if($sku) {
                $skuExist = Product::where('sku', $sku)->whereNotIn('id', [$pid])->first();
                if($skuExist) {
                    return response()->json([
                        'code' => 422,
                        'child_product['.$k.'][sku]' => ['Sku: ' . $sku . ' đã tồn tại, vui lòng chọn một mã khác']
                    ], 422);
                }
            } else {
                return response()->json([
                    'code' => 422,
                    'child_product['.$k.'][sku]' => ['Vui lòng nhập mã sản phẩm']
                ], 422);
            }

            $childProductExist = Product::where('id', $pid)->first();
            if(!$childProductExist) {
                $childProduct = new Product;
            } else {
                $childProduct = $childProductExist;
            }

            $childProduct->name = $product->name;
            $childProduct->parent_id = $product->id;

            $childProduct->sku = clean(array_get($arrayData, 'sku'));
            $childProduct->barcode = clean(array_get($arrayData, 'barcode'));
            $childProduct->price = (int) array_get($arrayData, 'price');
            $childProduct->image = clean(array_get($arrayData, 'image'));
            $childProduct->save();

            $product->has_child = 1;
            $product->save();
        }

        return response()->json([
            'code' => 1,
            'message' => 'Cập nhật thành công!',
            'redirect' => route('admin.product.getUpdate', $id)
        ]);
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

    /**
     * Delete variant
     * @param  integer $id
     * @return json
     */
    public function getDeleteVariant($id)
    {
        // Xóa variant
        $product = Product::findOrFail($id);
        $product->delete();

        // Cập nhật bảng variant_values
        VariantValue::where('variant_id', $id)->update(['status' => 0]);

        return response()->json(['id' => $id, 'code' => 1, 'type' => 'success', 'message' => 'Xóa thành công']);
    }


    /**
     * Tạo option
     * @param  Request $request
     * @return json
     */
    public function postUpdateOption(Request $request)
    {
        $product = Product::findOrFail($request->get('product_id'));
        $oldChilds = Product::where('parent_id', $product->id)->get();

        $properties = (array) $request->get('option');
        $values = (array) $request->get('value');

        // Tạo option và value
        foreach($properties as $key => $property) {
            $propertyExist = Properties::where('product_id', $product->id)->where('name', $property)->first();
            if(!$propertyExist) {
                $propertyModel = new Properties;
            } else {
                $propertyModel = $propertyExist;
            }

            $propertyModel->product_id = $product->id;
            $propertyModel->admin_id = $request->user()->id;
            $propertyModel->name = clean($property);
            $propertyModel->save();
            if(isset($values[$key]) && $values[$key]) {
                $arrayValues = explode(',', $values[$key]);
                $_valueIds = [];
                foreach($arrayValues as $value) {
                    $value = clean(trim($value));
                    $propertyValueModelExits = PropertiesValue::where('properties_id', $propertyModel->id)->where('name', $value)->first();
                    if(!$propertyValueModelExits) {
                        $propertyValueModel = new PropertiesValue;
                    } else {
                        $propertyValueModel = $propertyValueModelExits;
                    }

                    $propertyValueModel->properties_id = $propertyModel->id;
                    $propertyValueModel->name = $value;
                    $propertyValueModel->save();
                    $_valueIds[] = $propertyValueModel->id;
                }

                $arrayAllValueIds[] = $_valueIds;
            }
        }

        // Tạo, chỉnh sửa biến thể
        $valueCombinationArray = combinations($arrayAllValueIds);

        // Đưa về cùng 1 định dạng
        foreach($valueCombinationArray as &$value) {
            if(!is_array($value)) $value = [$value];
        }
        unset($value);

        $childProductsArray = [];
        foreach($oldChilds as $item) {
            $childProductsArray[] = $item->toArray();
        }

        foreach($valueCombinationArray as $key => $valueIdArray) {
            asort($valueIdArray);

            // Tạo sản phẩm con
            $childProductData = isset($childProductsArray[$key]) ? $childProductsArray[$key] : array();
            $childProductId = (int) array_get($childProductData, 'id');

            // Nếu chưa có thì mới tạo, có rồi mà đã xóa thì kệ nó
            $variantExist = VariantValue::where('product_id', $product->id)->where('values_int', implode('', $valueIdArray))->first();
            if(!$variantExist) {
                $childProduct = new Product;
                $childProduct->name = $product->name;
                $childProduct->parent_id = $product->id;

                $childProduct->sku = clean(array_get($childProductData, 'sku'));
                $childProduct->barcode = clean(array_get($childProductData, 'barcode'));
                $childProduct->price = (int) array_get($childProductData, 'price');
                $childProduct->image = clean(array_get($childProductData, 'image'));
                $childProduct->save();

                // Tạo biến thể
                $variantValueModel = new VariantValue;
                $variantValueModel->product_id = $product->id;
                $variantValueModel->variant_id = $childProduct->id;
                $variantValueModel->values_str = implode(',', $valueIdArray);
                $variantValueModel->values_int = implode('', $valueIdArray);
                $variantValueModel->save();
            }
        }

        // _debug($valueCombinationArray);die;

        // Cập nhật has_child
        if(count($valueCombinationArray)) {
            $product->has_child = 1;
            $product->save();
        } else {
            $product->has_child = 0;
            $product->save();
        }

        return response()->json(['code' => 1, 'type' => 'success', 'message' => 'Cập nhật thành công', 'redirect' => route('admin.product.getUpdate', $product->id)]);
    }


    /**
     * Delete option
     * @param  integer $id
     * @return json
     */
    public function getDeleteOption($id)
    {
        $option = Properties::findOrFail($id);
        $option->values()->delete();
        if($option->delete()) {
            return response()->json(['id' => $id, 'code' => 1, 'type' => 'success', 'message' => 'Xóa thành công']);
        }

        return response()->json(['id' => $id, 'code' => 0, 'type' => 'error', 'message' => 'Xóa không thành công']);
    }

    /**
     * Delete option value
     * @param  integer $id
     * @return json
     */
    public function getDeleteOptionValue(Request $request)
    {
        $id = $request->get('id');
        $value = PropertiesValue::findOrFail($id);
        $value->delete();

        // Xóa tất cả variant liên quan đến cái giá trị này
        $variantValues = VariantValue::where('values_str', 'LIKE', '%'. $id .'%')->get();
        foreach($variantValues as $item) {
            Product::where('id', $item->variant_id)->delete();
            $item->delete();
        }

        return response()->json(['id' => $id, 'code' => 1, 'type' => 'success', 'message' => 'Xóa không thành công']);
    }

}
