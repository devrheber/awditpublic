<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientObservationRequest extends FormRequest
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
            //
            'observation'=>'required|max:100',
            'location' => 'required',
        ];
    }
//    public function messages()
//    {
//        return [
//            //
//            'observation.required'=>'Observation text is required',
//            'observation.max'=>'observation text allow maximum 100 character',
//        ];
//    }
}
