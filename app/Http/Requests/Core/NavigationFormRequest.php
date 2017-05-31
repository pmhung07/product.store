<?php

namespace App\Http\Requests\Core;

use App\Http\Requests\Request;
use App\Models\Navigation;

class NavigationFormRequest extends Request
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
        $rules = [
            'label' => 'required'
        ];

        $type = $this->get('type');

        switch ($type) {
            case Navigation::TYPE_CUSTOM:
                $rules['url'] = 'required';
                break;

            case Navigation::TYPE_POST:
            case Navigation::TYPE_POST_CATEGORY:
                $rules['object_id'] = 'required';

            default:
                # code...
                break;
        }

        return $rules;
    }
}
