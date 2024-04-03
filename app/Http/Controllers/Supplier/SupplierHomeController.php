<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientNewPasswordRequest;
use App\Http\Requests\Supplier\LocationRequest;
use App\Http\Requests\Supplier\SupplierProfileRequest;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\SupplierLocation;
use App\Models\CompanySector;
use App\Models\CompanySize;
use App\Models\CompanyMaturity;
use App\Models\SupplierTickets;
use App\Models\SupplierTicket;
use Auth;
use Hash;

class SupplierHomeController extends Controller
{
    // method for  middleware
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    // method for the show the home page after the lgin
    public function index()
    {
        return view('supplier.home');
    }

    // show the change password form
    public function changePassword()
    {
        return view('supplier.changepassword');
    }
    // store the changed password
    public function storeChangePassword(Request $request)
    {
        // dd($request);
        $supplier = Supplier::find(Auth::user()->id);
        // dd($supplier);
        if(Hash::check($request->current_password,Auth::user()->password) == true)
        {
            if($request->new_password == $request->confirm_password)
            {
                $supplier->password = Hash::make($request->new_password);
                $supplier->update();
                return redirect()->route('supplier.change.password')->with('success','Password reset successfully.');
            }else{
                return redirect()->route('supplier.change.password')->with('error','The new password and confirm password do not match');
            }
        }else{
            return redirect()->route('supplier.change.password')->with('error','The current password is not correct. Please try again.');
        }
    }

    public function showNewPasswordForm()
    {
        return view('supplier.first_login.newpassword');
    }

    public function storeNewPassword(ClientNewPasswordRequest $request)
    {
        // dd($request);
        $client = Supplier::find(Auth::user()->id);
        // dd($client);
        if($request->password == $request->password_confirmation)
        {
            $client->password =Hash::make($request->password);
            $client->save();
            return redirect()->route('supplier.first.location')->with('success',trans('message.Password reset successfully.'));
        }else{
            return back()->with('error',trans('message.The new password and confirm password do not match'));
        }
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
    // location form
    public function locationForm()
    {
        $countries = Country::get();
        $sates = State::get();
        $cities = City::get();
        $sectors = CompanySector::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();
        $supplier = Supplier::find(Auth::user()->id);
        return view('supplier.first_login.location',compact('supplier','countries','sates','cities','sectors','sizes','maturities'));
    }

    // store location data
    public function storeLocation(LocationRequest $request)
    {
        // dd($request);
        $supplier = Supplier::find(Auth::user()->id);
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/supplier/location/');
            $uploadedImage->move($destinationPath, $imageName);
        }
        $location = SupplierLocation::create([
            'supplier_id'=>Auth::user()->id,
            'location_name'=>$request->lname,
            'location_image'=>$imageName,
            'country_id'=>$request->country,
            'state_id'=>$request->state,
            'city_id'=>$request->city,
            'address'=>$request->address,
            'postal_code'=>$request->postal_code,
            'category_id'=>$request->category,
            'size_id'=>$request->lsize,
            'maturity'=>$request->maturity,
            'security'=>$request->security,
            'status'=>0,
        ]);
        $this->sendLocationApprovalTickets($location->id);
        if($supplier->first_time_login == 0)
        {
            return redirect()->route('supplier.first.profile')->with('success',trans('message.data Saved Successfully'));
        }
        else{
            return redirect()->route('supplier.home')->with('success',trans('message.data Saved Successfully'));
        }
    }
    public function sendLocationApprovalTickets($lid)
    {
        // dd($lid);
        $userid = Auth::user()->id;
		$location = SupplierLocation::find($lid);
		$supplier = Supplier::find($location->supplier_id);
		$docid = null;
		$clientticket = SupplierTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$supplier->invited_by,
			'ticket_number'=>uniqid(),
			'ticket_type'=>3,
			'location_id'=>$location->id,
			'name'=>$supplier->username,
			'attach_doc_id'=>$docid,
			'status'=>1,
		]);
    }
    public function profileForm()
    {
        return view('supplier.first_login.profile');
    }
    public function storeProfile(SupplierProfileRequest $request)
    {
        // dd($request);
        $userid= Auth::user()->id;
        $supplier = Supplier::find($userid);
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/supplier/profile/');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }
        else{
            $imageName = $supplier->image;
        }
        $supplier->first_name=$request->first_name;
        $supplier->last_name=$request->last_name;
        $supplier->job_title=$request->job_title;
        $supplier->image =$imageName;
        $supplier->status=1;
        $supplier->first_time_login=1;
        $supplier->save();
        return redirect()->route('supplier.home')->with('success','Profile data updated successfully...!!');
    }
}
