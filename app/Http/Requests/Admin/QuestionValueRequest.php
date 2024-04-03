<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class QuestionValueRequest extends FormRequest
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
            
            'priority'=>'required|unique:questions_value,value',
            'value_name' => 'required',
            'score' => 'required',
            
        ];
    }

    public function messages()
    {
        return [

            'priority.required'=>'Priority field is required',
            'priority.unique'=>'Priority value are alresy exists',
        
            'score.required'=>'Score field is required',
        
            'value_name.required'=>'Value field  is required',
           
        ];
    }
}
