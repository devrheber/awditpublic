<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ClientNewPasswordRequest extends FormRequest
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
            'password' => ['required','min:8','max:16','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/','confirmed',],
        ];
    }

//    public function messages()
//    {
//        return [
//			'password.required'=>'Password field is required',
//            'password.regex'=>'Password  contain minimum one uppercase and one digit',
//            'password.max'=>'password contain maximum 16 character',
//            'password.min'=>'password contain minimum 8 character',
//        ];
//    }
}
