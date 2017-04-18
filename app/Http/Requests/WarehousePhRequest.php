<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WarehousePhRequest extends Request
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
            'warehouse_ph_name' => 'required|unique:warehouse_ph,name',
            'warehouse_ph_warehouse_id' => 'required',
            'warehouse_ph_supplier_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'warehouse_ph_name.required' => 'Vui lòng nhập tên phiếu!',
            'warehouse_ph_name.unique' => 'Tên phiếu này đã tồn tại!',
            'warehouse_ph_warehouse_id.required' => 'Vui lòng chọn kho nhập!',
            'warehouse_ph_supplier_id.required' => 'Vui lòng chọn đơn vị cung cấp!',
        ];
    }
}
