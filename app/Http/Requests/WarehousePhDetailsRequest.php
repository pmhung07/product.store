<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WarehousePhDetailsRequest extends Request
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
        return [
            'warehouse_ph_details_product' => 'required',
            'warehouse_ph_details_quantity' => 'required',
            'warehouse_ph_details_price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'warehouse_ph_details_product.required' => 'Vui lòng chọn sản phẩm nhập kho!',
            'warehouse_ph_details_quantity.required' => 'Vui lòng điền số lượng nhập kho!',
            'warehouse_ph_details_price.required' => 'Vui lòng điền giá sản phẩm nhập kho!',
        ];
    }
}
