<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Auth;

class QuestionnaireGroupRequest extends FormRequest
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
            'group_name'=>['required','max:15',Rule::unique('questionnaire_group')->where(function ($query) {
                return $query->where('created_by', Auth::user()->id);
              }),
            ],
        ];

    }

//    public function messages()
//    {
//        return [
//            'group_name.required'=>'Questionnaire Name is required',
//            'group_name.unique'=>'Questionnaire name is already exist',
//        ];
//
//    }
}

