<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class InviteSupplierRequest extends FormRequest
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
            'nameaddnewsupplier'=>'required',
            'idaddnewsupplier'=>'required',
            'cifaddnewsupplier'=>'required',
            'emailaddnewsupplier' => 'required|string|email',
        ];
    }

//    public function messages()
//    {
//        return [
//            'emailaddnewsupplier.required' => 'The email field is required.',
//            'emailaddnewsupplier.string' => 'The email must be in string format.',
//            'emailaddnewsupplier.email' => 'The email must be in a valid email address format.',
//            'idaddnewsupplier.required' => 'The supplier ID field is required.',
//            'nameaddnewsupplier.required' => 'The supplier name field is required.',
//            'cifaddnewsupplier.required' => 'The supplier CIF field is required.',
//            'cifaddnewsupplier.size' => 'The supplier CIF field must be 11 characters in size.'
//        ];
//    }
}
