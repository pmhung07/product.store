<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // _debug($this->all());die;
        return [
            'product_name' => 'required|unique:product,name',
            'product_sku' => 'required|unique:product,sku',
            'product_barcode' => 'unique:product,barcode',
            'product_group' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Vui lòng nhập tên sản phẩm!',
            'product_name.unique' => 'Tên sản phẩm này đã tồn tại!',
            'product_sku.required' => 'Vui lòng nhập mã sản phẩm!',
            'product_sku.unique' => 'Mã sản phẩm này đã tồn tại!',
            'product_barcode.unique' => 'Barcode sản phẩm này đã tồn tại!',
            'product_group.required' => 'Vui lòng chọn nhóm sản phẩm!',
            'product_unit.required' => 'Vui lòng chọn đơn vị đo sản phẩm!',
            'product_price.required' => 'Vui lòng nhập giá bán sản phẩm!'
        ];
    }
}
