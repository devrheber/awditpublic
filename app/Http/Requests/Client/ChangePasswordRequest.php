<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
        ];
    }

//    public function messages()
//    {
//        return [
//            'current_password.required' => 'The Current Password field is required',
//            'password.required' => 'The Password field is required',
//            'password.min' => 'Password must contain at least 8 characters',
//            'confirm_password.required' => 'The Confirm Password field is required',
//            'confirm_password.min' => 'Confirm Password must contain at least 8 characters',
//        ];
//    }
}
