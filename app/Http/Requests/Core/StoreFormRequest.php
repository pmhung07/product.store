<?php

namespace App\Http\Requests\Core;

use App\Http\Requests\Request;

class StoreFormRequest extends Request
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
            'name'    => 'required',
            'address' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Vui lòng nhập tên cửa hàng',
            'address.required' => 'Vui lòng nhập địa chỉ cửa hàng',
            'content.required' => 'Vui lòng nhập bài viết về cửa hàng'
        ];
    }
}
