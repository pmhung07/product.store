<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SystemTestimonialFormRequest extends Request
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

    public function rules()
    {
        return [
            'name'       => 'required',
            'profession' => 'required',
            'comment'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'Vui lòng nhập tên',
            'profession.required' => 'Vui lòng nhập nghề nghiệp',
            'comment.required'    => 'Vui lòng nhập bình luận'
        ];
    }
}
