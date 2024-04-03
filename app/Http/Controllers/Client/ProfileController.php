<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\City;
use App\Models\ClientInvitation;
use App\Models\Company;
use App\Models\CompanyMaturity;
use App\Models\CompanySector;
use App\Models\CompanySize;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\UserRole;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addProfile()
    {
        return view('client.profile.addprofile');
    }
    public function profile()
    {
        return view('client.first_login.profile');
    }

    public function showRoles()
    {
        $userid = Auth::user()->id;
        $client = User::find($userid);
        $role = UserRole::find($client->user_role);
        $userroles = Role::where('status', 1)->get();
        $clientroles = User::where('role_assigner', $userid)->paginate(10, ['*'], 'clients');
         $pendingclients = ClientInvitation::where('sender_id', $userid)->where('status', 0)->paginate(10, ['*'], 'pendingclients');

        return view('client.profile.roles', compact(
            'client',
            'role',
            'userroles',
            'clientroles',
            'pendingclients'

        ));
    }

    // public function storeProfile(ProfileRequest $request)
    // {
    //     $userid = Auth::user()->id;
    //     $client = User::find($userid);
    //     if (isset($request->image)) {
    //         $uploadedImage = $request->image;
    //         $imageName = 'IMG' . $userid . '_' . date('Ymdhis') . '.' . $uploadedImage->getClientOriginalExtension();
    //         $destinationPath = public_path('/images/client/profile');
    //         $uploadedImage->move($destinationPath, $imageName);
    //         $uploadedImage->imagePath = $destinationPath . $imageName;
    //     } else {
    //         $imageName = $client->image;
    //     }
    //     $client->first_name = ucfirst($request->first_name);
    //     $client->last_name = ucfirst($request->last_name);
    //     $client->job_title = ucfirst($request->job_title);
    //     $client->image = $imageName;
    //     $client->update();
    //     return redirect()->route('client.brand.add')->with('success', 'Data saved successfully');
    // }

    public function showProfile()
    {
        $userid = Auth::user()->id;
        $brand  = Brand::where('user_id',$userid)->first();
        $client = User::find($userid);
        $role = UserRole::find($client->user_role);
        $company = Company::with('sector', 'companySize', 'companyMaturity')->where('created_by', $userid)->first();
        $sectors = CompanySector::get();
        $userroles = Role::where('status', 1)->get();
        $clientroles = User::where('role_assigner', $userid)->paginate(10, ['*'], 'clients');
        $pendingclients = ClientInvitation::where('sender_id', $userid)->where('status', 0)->paginate(10, ['*'], 'pendingclients');
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();
        return view('client.profile.viewprofile', compact(
            'cities',
            'client',
            'sectors',
            'company',
            'userroles',
            'clientroles',
            'pendingclients',
            'countries',
            'states',
            'sizes',
            'maturities',
            'role',
            'brand'
        ));
    }

    // public function editProfile()
    // {
    //     $userid = Auth::user()->id;
    //     $client = User::find($userid);
    //     $sectors = CompanySector::get();
    //     return view('client.profile.editprofile', compact('client'));
    // }

    // public function UpdateProfile(Request $request)
    // {
    //     // dd($request);
    //     $userid = Auth::user()->id;
    //     $client = User::find($userid);
    //     if (isset($request->image)) {
    //         $uploadedImage = $request->image;
    //         $imageName = 'IMG' . $userid . '_' . date('Ymdhis') . '.' . $uploadedImage->getClientOriginalExtension();
    //         $destinationPath = public_path('/images/client/profile');
    //         $uploadedImage->move($destinationPath, $imageName);
    //         $uploadedImage->imagePath = $destinationPath . $imageName;
    //     } else {
    //         $imageName = $client->image;
    //     }
    //     $client->first_name = ucfirst($request->first_name);
    //     $client->last_name = ucfirst($request->last_name);
    //     $client->job_title = ucfirst($request->job_title);
    //     $client->image = $imageName;
    //     $client->update();
    //     return redirect()->route('client.profile.view')->with('success', 'Data updated successfully');
    // }
}
