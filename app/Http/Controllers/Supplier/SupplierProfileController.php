<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\SupplierLocation;
// use Illuminate\Support\Facades\Storage;
use Auth;

class SupplierProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    public function showProfile()
    {   
        $userid= Auth::user()->id;
        $supplier = Supplier::find($userid);
        $locations =SupplierLocation::where('supplier_id',$supplier->id)->orderBy('created_at','desc')->get();
        return view('supplier.profile.viewprofile',compact('supplier','locations'));
    }

    public function editProfile()
    {
        $userid= Auth::user()->id;
        $supplier = Supplier::find($userid);
        return view('supplier.profile.editprofile',compact('supplier'));
    }

    public function UpdateProfile(Request $request)
    {
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
        $supplier->update();
        return redirect()->route('supplier.profile.view')->with('success','Profile data updated successfully...!!');
    }
}