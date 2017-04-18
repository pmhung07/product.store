<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomersRequest extends Request
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
            'customer_email' => 'required|unique:customers,email',
            'customer_phone' => 'required|unique:customers,phone',
            'customer_address' => 'required',
            'customer_gender' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Vui lòng nhập tên khách hàng!',
            'customer_email.required' => 'Vui lòng nhập địa chỉ Email khách hàng!',
            'customer_email.unique' => 'Email khách hàng này đã tồn tại trên hệ thống!',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại khách hàng!',
            'customer_phone.unique' => 'Số điện thoại này đã tồn tại trên hệ thống!',
            'customer_address.required' => 'Vui lòng nhập địa chỉ khách hàng!',
            'customer_gender.required' => 'Vui lòng chọn giới tính khách hàng!'
        ];
    }
}
