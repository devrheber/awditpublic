<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class AdminQuestionValueRequest extends FormRequest
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
            'value'=>'required|numeric',
           
        ];        
     
    }

    public function messages()
    {
        return [
            'value.required'=>'Question Value is required',
			'value.numeric'=>'Question value must br in from of numeric',
        ];
    }
}
