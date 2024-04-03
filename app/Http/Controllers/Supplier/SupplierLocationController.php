<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\LocationRequest;
use Illuminate\Http\Request;
use App\Models\SupplierLocation;
use App\Models\Supplier;
use App\Models\Country;
use App\Models\City;
Use App\Models\State;
use App\Models\CompanySector;
use App\Models\CompanySize;
USe App\Models\Company;
use App\Models\CompanyMaturity;
use App\Models\SupplierTicket;
use Auth;
use Mail;
use App\Mail\SendLocationApprovalTickets;

class SupplierLocationController extends Controller
{
    // middleware method
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    // method for the calling location list
    public function index()
    {
        $locations  = SupplierLocation::where('supplier_id',Auth::user()->id)->get();
        return view('supplier.location.list',compact('locations'));
    }

    // method for the show only selscted country's state
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

    // method for the  create the location
    public function create()
    { 
        $countries = Country::get();
        $sates = State::get();
        $cities = City::get();
        $sectors = CompanySector::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();
        $supplier = Supplier::find(Auth::user()->id);
        return view('supplier.location.create',compact('supplier','countries','sates','cities','sectors','sizes','maturities'));
    }

    // method for the store the location
    public function store(LocationRequest $request)
    {
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/supplier/location/');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
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
        // $supplier = Supplier::find($location->supplier_id);
        // $email  = $supplier->suppliercreator->email;
        // // Mail::to($email)->send(new SendLocationApprovalTickets($location));
        return redirect()->route('supplier.profile.view')->with('success','data Saved Successfully...!!');
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

    public function edit($id)
    {
    
        $sectors = CompanySector::get();
        $location = SupplierLocation::find($id);
        $countries = Country::get();
        $sates = State::where('country_id',$location->country_id)->get();
        $cities = City::where('state_id',$location->state_id)->get();
        $categories = CompanySector::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();
        $supplier = Supplier::find(Auth::user()->id);
        return view('supplier.location.edit',compact('supplier','location','countries','sates','sectors','cities','categories','sizes','maturities'));
    }

    public function update(LocationRequest $request,$id)
    {   
        $location = SupplierLocation::find($id);
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/supplier/location/');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }
        else{
            $imageName=$location->location_image;
        }
        $location->supplier_id=Auth::user()->id;
        $location->location_name=$request->lname;
        $location->location_image=$imageName;
        $location->country_id=$request->country;
        $location->state_id=$request->state;
        $location->city_id=$request->city;
        $location->address=$request->address;   
        $location->postal_code=$request->postal_code;
        $location->category_id=$request->category;
        $location->size_id=$request->lsize;
        $location->maturity=$request->maturity;
        $location->security=$request->security;
        $location->security=$request->security;
        $location->status=0;
        $location->update();
        return back()->with('success','data updated Successfully...!!');
    }

    public function destroy($id)
    {
        $location = SupplierLocation::find($id);
        // dd($location);
        $location->delete();
        return back()->with('error','data deleted Successfully...!!');
    }
}

