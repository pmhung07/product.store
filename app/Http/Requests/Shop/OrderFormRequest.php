<?php

namespace App\Http\Requests\Shop;

use App\Http\Requests\Request;

class OrderFormRequest extends Request
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
            'customer_name' => 'required',
            'customer_phone' => 'required',
            // 'customer_address' => 'required',
            'customer_email' => 'email',
            // 'city_id' => 'required',
            // 'district_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Vui lòng nhập tên',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            // 'customer_address.required' => 'Vui lòng nhập địa chỉ',
            // 'city_id.required' => 'Vui lòng chọn tỉnh/thành phố',
            // 'district_id.required' => 'Vui lòng chọn quận/huyện'
        ];
    }
}
