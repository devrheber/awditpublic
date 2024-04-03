<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\SupplierLocation;

class LocationRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'image'=>'required|mimes:jpeg,jpg,png|max:2048',
                    'lname' =>'required|max:100',
                    'country' =>'required',
                    'state'=>'required',
                    'city'=>'required',
                    'address'=>'required|max:150',
                    'postal_code'=>'required',
                    'category'=>'required',
                    'lsize'=>'required',
                    'maturity'=>'required',
                    'security'=>'required',

                ];        
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'lname' => 'required|max:100',
                    'country' => 'required',
                    'state'=>'required',
                    'city'=>'required',
                    'address'=>'required|max:150',
                    'postal_code'=>'required',
                    'category'=>'required',
                    'lsize'=>'required',
                    'maturity'=>'required',
                    'security'=>'required',
                ];  
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'image.required'=>'Location Logo is required',
            'image.mimes'=>'Location logo should be jpg,jpeg or png file',
            'image.max'=>'location image size must be less then 2MB',
            'lname.required'=>'Location Name is required',
            'country.required'=>'Country field is required',
            'state.required'=>'State field is required',
            'city.required'=>'City feild is required',
            'address.required'=>'Address field is required',
            'postal_code.required'=>'Postal code feild is required',
            'category.required'=>'Location category feild is required',
            'lsize.required'=>'Location size feild is required',
            'maturity.required'=>'Location maturity feild is required',
            'security.required'=>'Location security feild is required ',

        ];
    }
}
