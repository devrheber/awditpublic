<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SupplierRegisterRequest extends FormRequest
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
            
            'username'=>'required|string|max:8|unique:suppliers',
            'email' => 'required|string|email|max:255|unique:suppliers',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [

            'username.required'=>'UserName field is required',
            'username.string'=>' UserName should be a in string format',
            'username.max'=>'UserName allows only 8 letters maximum ',
            'username.unique'=>'UserName is already exist',

            'email.required'=>'Email field is required',
            'email.string'=>'Email should be a in string format',
            'eamil.email'=>'Email field is must in form ogf eamil address',
            'email.max'=>'UserName allows only 10 letters maximum ',
            'email.unique'=>'Email address is already exist.',

            'password.required'=>'Password field  is required ',
            'password.string'=>'password should be a in string format',
            'password.min'=>'Password have minimum 8 charachter ',
            'password.confiram'=>'Password and confirm password are not match',
        ];
    }
}
