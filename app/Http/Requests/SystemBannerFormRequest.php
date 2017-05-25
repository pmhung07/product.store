<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SystemBannerFormRequest extends Request
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
            'link'     => 'required',
            'page'     => 'required',
            'position' => 'required'
        ];
    }


    public function messages() {
        return [
            'link.required'     => 'Vui lòng nhập link',
            'page.required'     => 'Vui lòng nhập trang đích',
            'position.required' => 'Vui lòng nhập vị trí'
        ];
    }
}
