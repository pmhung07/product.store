<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductGroupRequest extends Request
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
            'name_product_group' => 'required|unique:product_group,name'
        ];
    }

    public function messages()
    {
        return [
            'name_product_group.required' => 'Vui lòng nhập tên nhóm sản phẩm!',
            'name_product_group.unique' => 'Nhóm sản phẩm này đã tồn tại'
        ];
    }
}
