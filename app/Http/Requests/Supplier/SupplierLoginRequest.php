<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:suppliers',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'email.required'=>'Email field is required',
            'eamil.email'=>'Email field is must in form ogf eamil address',
            'email.exists'=>'Email address does not exist.',

            'password.required'=>'Password field  is required ',
        ];
    }
}
