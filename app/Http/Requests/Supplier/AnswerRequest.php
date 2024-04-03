<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AnswerRequest extends FormRequest
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
            'answer_type' => 'required',
            'attach_doc' => 'nullable|mimes:pdf,docx|max:1024',
            'observation'=> 'required'
        ];
    }

    public function messages()
    {
        return [

            'answer_type.required'=>'choose Either Yes or No.',
            'attach_doc.mimes'=>'Attach doc is allows only jpg or png or jpeg.',
            'attach_doc.max'=>'Attach doc is  allows  upto 1MB File',
            'observation.required'=>'Password field  is required',
        ];
    }
}
