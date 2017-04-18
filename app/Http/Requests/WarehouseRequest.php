<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WarehouseRequest extends Request
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
            'code' => 'required|unique:warehouse,code',
            'name' => 'required|unique:warehouse,name',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập mã kho hàng!',
            'code.unique' => 'Mã kho hàng này đã tồn tại!',
            'name.required' => 'Vui lòng nhập tên kho hàng!',
            'name.unique' => 'Tên kho hàng này đã tồn tại!',
            'address.required' => 'Vui lòng nhập địa chỉ kho hàng!',
        ];
    }
}
