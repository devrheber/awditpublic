<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\SupplierLocation;

class SupplierProfileRequest extends FormRequest
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
        	'image'=>'required|mimes:jpeg,jpg,png|max:2048',
			'first_name'=>'required',
			'last_name'=>'required',
			'job_title'=>'required',
        ];        
    }

    public function messages()
    {
        return [
            'image.required'=>'Location Logo is required',
            'image.mimes'=>'Location logo should be jpg,jpeg or png file',
            'image.max'=>'location image size must be less then 2MB',
            'first_name.required'=>'First Name is required',
            'last_name.required'=>'Last Name is required',
            'job_title.required'=>'JOb title  is required',
        ];
    }
}
