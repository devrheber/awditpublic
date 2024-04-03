<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class ProfileRequest extends FormRequest
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
        // dd($this->method());
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                // dd('hello');
                return [
                    'first_name'=>'required|max:15',
                    'last_name'=>'required|max:15',
                    'job_title'=>'required|max:15',
                    'image'=>'required|mimes:jpeg,jpg,png|max:5120',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name' => 'required|max:15',
                    'last_name' => 'required|max:15',
                    'job_title'=>'required|max:15',
                ];
            }
            default:break;
        }
    }

//    public function messages()
//    {
//        return [
//            'first_name.required'=>'First Name is required',
//            'first_name.max'=>'First name max is allowed 15 charachter.',
//            'last_name.required'=>'Last Name is required',
//            'last_name.max'=>'Last name max is allowed 15 charachter.',
//            'job_title.required'=>'Job title is required',
//            'job_title.max'=>'JOb title max is allowed 15 charachter.',
//            'image.required'=>'image is required',
//            'image.mimes'=>'image  type must be jpeg,jpg or png',
//            'image.max'=>'image size must be less then 5MB',
//        ];
//    }
}
