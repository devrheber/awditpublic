<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Auth;

class QuestionnaireRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'name'=> ['required','max:50',Rule::unique('questionnaires')->where(function ($query) {
                    return $query->where('created_by', Auth::user()->id);
                }),
            ],
        ];

    }

//    public function messages()
//    {
//        return [
//            'name.required'=>'Questionnaire name is required',
//            'name.unique'=>"Questionnaire name is already Exists.",
//        ];
//    }
}
