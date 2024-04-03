<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Supplier;
use App\Models\SupplierLocation;
use App\Models\Questionnaire;
use Auth;
Use Hash;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }
    public function index()
    {
        $client = User::get();
        $supplier = Supplier::get();
        $location = SupplierLocation::get();
        $questionnarie = Questionnaire::get();
        return view('admin.dashboard',compact('client','supplier','location','questionnarie'));
    }

    // method for the change Password of the admin
    public function changePassword()
    {
        return view('admin.changepassword');
    }
    // methods for the store the change password in to the database by admin
    public function storeChangePassword(Request $request)
    {
        // dd($request);
        $admin = Admin::find(Auth::user()->id);
        // dd($admin);
        if(Hash::check($request->current_password,Auth::user()->password) == true)
        {
            if($request->new_password == $request->confirm_password)
            {
                $admin->password = Hash::make($request->new_password);
                $admin->update();
                return redirect()->route('admin.change.password')->with('success','Password reset successfully.');
            }else{
                return redirect()->route('admin.change.password')->with('error','The new password and confirm password do not match');
            }
        }else{
            return redirect()->route('admin.change.password')->with('error','The current password is not correct. Please try again.');
        }
    }

}
