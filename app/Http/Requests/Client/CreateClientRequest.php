<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateClientRequest extends FormRequest
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
            'email' => 'required',
            'role'=>'required',
        ];
    }

//    public function messages()
//    {
//        return [
//            'email.required'=>'Email field is required.',
//            'email.email'=>'Email field is must be a form of the email address.',
//
//            'role.required'=>'User role field is required.',
//        ];
//    }
}
