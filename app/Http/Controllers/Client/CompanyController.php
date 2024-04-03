<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\CompanyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Brand;
use App\Models\CompanySector;
use App\Models\CompanySize;
use App\Models\CompanyMaturity;
use App\MOdels\User;
use Auth;

class CompanyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //method for the show only selscted country's state
    public function getStates($id)
    {
        $states =State::where("country_id",$id)->get();
        // dd($states);
        return response()->json($states);
    }

    //method for the show only selscted state's cities
    public function getCities($id)
    {
        $cities = City::where("state_id",$id)->get();
        // dd($cities);
        return response()->json($cities);
    }
    public function edit()
    {
        $userid = Auth::user()->id;
        $brand  = Brand::where('user_id',$userid)->first();
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        $sectors= CompanySector::get();
        $sizes= CompanySize::get();
        $maturities = CompanyMaturity::get();
        $company = Company::where('created_by',$userid)->first();
        return view('client.company.edit',compact('company','brand','states','cities','countries','sectors','sizes','maturities'));
    }
    public function update(CompanyRequest $request)
    {
        $userid = Auth::user()->id;

        $company = Company::find($request->company_id);
        $company->name = $request->cname;
        $company->cif = $request->cif;
        $company->contrty_id = $request->country;
        $company->state_id = $request->state;
        $company->city_id = $request->city;
        $company->address = $request->address;
        $company->postalcode = $request->postal_code;
        $company->company_sector_id = implode(',', $request->csector);
        $company->company_size_id = $request->csize;
        $company->maturity_level_id = $request->maturity;
        $company->security_department = $request->security;
        $company->status=1;
        $company->update();

        return back()->with('success',trans('message.Data updated successfully'));
    }

    public function updateBranding(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $uploadedImage = $request->image;
            $imageName = 'IMG' . $user->id . '_' . date('Ymdhis') . '.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/client/brand');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }

        $brand = Brand::where('user_id', $user->id)->first();
        $brand->primary_color = $request->pcolor;
        $brand->secondary_color = $request->scolor;
        if ($request->hasFile('image')) {
            $brand->brand_logo = $imageName;
        }
        $brand->save();

        return back()->with('success',trans('message.Data updated successfully'));
    }
}
