<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

use App\Models\Company;

class BrandRequest extends FormRequest
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
            'image'=>'required|mimes:jpeg,jpg,png|max:5120',
        ];
    }

//    public function messages()
//    {
//        return [
//            'image.required'=>'image is required',
//            'image.mimes'=>'image  type must be jpeg,jpg or png',
//            'image.max'=>'image size must be less then 5MB',
//        ];
//    }
}
