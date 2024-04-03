<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class QuestionRequest extends FormRequest
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
            'question'=>'required|max:100',
            'observation'=>'required|max:100',
            'based_on'=>'required|max:100',
            'objective'=>'required|max:100',
            'requirements'=>'required|max:100',
            'question_value'=>'required|max:100',
            'question_group'=>'required|numeric',
        ];

    }

//    public function messages()
//    {
//        return [
//            'question.required'=>'Question is required',
//            'observation.required'=>'Question Objective is required.',
//            'based_on.required'=>'Question based on is required.',
//            'objective.required'=>'Question objective is required.',
//            'requirements.required'=>'Question requirements is required.',
//            'question_value.required'=>'Question Value is required.',
//            'question_group.required'=>'question Group is required',
//            'question_group.numeric'=>'Please select the proper group name(add new group is not group name)'
//        ];
//    }
}
