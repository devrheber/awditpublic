<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyRequest extends FormRequest
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
        $company = Company::find($this->id);
        // dd($company);
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
                    'cname' => 'required|max:100',
                    'cif' => 'required|unique:companies|max:100',
                    'country' => 'required',
                    'state'=>'required',
                    'city'=>'required',
                    'address'=>'required|max:150',
                    'postal_code'=>'required',
                    'csector'=>'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                   'company_id' => 'required',
                    'cname' => 'required|max:100',
                    'cif' => 'required|max:100',
                    'address'=>'required|max:150',
                    'postal_code'=>'required',
                    'csector'=>'required'
                ];
            }
            default:break;
        }
    }

//    public function messages()
//    {
//        return [
//
//            'cname.required'=>'Company Name is required',
//            'cname.max'=>'Company Name allow maximum 100 character',
//            'cif.required'=>'CIF Number field is required',
//            'cif.unique'=>"CIF number is already exist",
//            'cif.max'=>'CIF allow maximum 100 character',
//            'country.required'=>'Country field is required',
//            'state.required'=>'State field is required',
//            'city.required'=>'City field is required',
//            'address.required'=>'Address field is required',
//            'postal_code.required'=>'Postal code field is required',
//            'csector.required'=>'Company Sector field is required'
//        ];
//    }
}
