<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\CompanySector;
// use Illuminate\Support\Facades\Storage;
use Auth;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showProfile()
    {
        $userid= Auth::user()->id;
        $admin = Admin::find($userid);
        $sectors= CompanySector::get();
        return view('admin.profile.viewprofile',compact('admin'));
    }

    public function editProfile()
    {
        $userid= Auth::user()->id;
        $admin = Admin::find($userid);
        return view('admin.profile.editprofile',compact('admin'));
    }

    public function UpdateProfile(Request $request)
    {
        $userid= Auth::user()->id;
        $admin = Admin::find($userid);
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/admin/profile/');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }
        else{
            $imageName = $admin->image;
        }
        $admin->first_name=$request->first_name;
        $admin->last_name=$request->last_name;
        $admin->job_title=$request->job_title;
        $admin->image =$imageName;
        $admin->update();
        return redirect()->route('admin.profile.view')->with('success','Profile data updated successfully...!!');
    }
}
