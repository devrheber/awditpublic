<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TicketRequest extends FormRequest
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

            'location'=>'required',
            'ticket_type'=>'required',
            'name'=>'required',
            'questionnaire'=>"required_if:ticket_type,==,2",
			'description'=>'required',
			'attach_doc'=>'nullable|mimes:pdf,docx,jpeg,png,jpg,mp4,mkv,mp3|max:1024'
        ];

    }

//    public function messages()
//    {
//        return [
//
//            'location.required'=>'Supplier location is required.',
//            'ticket_type.required'=>'Ticket type on is required.',
//            'name.required'=>'Ticket name is required.',
//            'questionnaire.required_if'=>'Questionnaire field is required.',
//			'description.required'=>'Description is required.',
//			'attach_doc.mimes'=>'File must be a pdf,docx,jpeg,png,jpg,mp4,mkv,mp3 format only...',
//			'attach_doc.max'=>'Document size  maximum is 2 mb size',
//        ];
//    }
}
