<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ReplyTicketRequest extends FormRequest
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
            'description'=>'required',
            'attach_doc'=>'nullable|mimes:pdf,docx|max:1024'
        ];
    }
//    public function messages()
//    {
//        return [
//            'description.required'=>'Description is required.',
//            'attach_doc.mimes'=>'Document must be a pdf or docx format',
//            'attach_doc.max'=>'Document size  maximum is 2 mb size',
//        ];
//    }
}
