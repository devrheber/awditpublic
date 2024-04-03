<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class VerifyMailRequest extends FormRequest
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
            'email' => 'required|string|email|exists:users',
        ];
    }

//    public function messages()
//    {
//        return [
//            'email.required'=>'Email field is required.',
//            'email.string'=>'Email must be in the string format.',
//            'email.email'=>'Email must be format of mail address',
//            'email.exists'=>'Email  data is not exists in our records.',
//        ];
//    }
}
