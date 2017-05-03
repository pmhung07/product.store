<?php

namespace App\Http\Requests\Core;

use App\Http\Requests\Request;

class CouponFormRequest extends Request
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
            'code' => 'required|unique:coupon,code,'. $this->id,
            'value' => 'required',
            'type_value' => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập mã coupon',
            'code.unique' => 'Mã đã tồn tại vui lòng nhập một mã khác',
            'value.required' => 'Vui lòng nhập giá trị',
            'type_value.required' => 'Vui lòng chọn kiểu giảm giá',
            'type.required' => 'Vui lòng chọn loại coupon'
        ];
    }
}
