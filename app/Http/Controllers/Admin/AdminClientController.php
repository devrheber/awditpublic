<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ClientRegisterRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Supplier;
use Auth;
use Hash;
Use Mail;
use App\Mail\ClientInvitationMail;

class AdminClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showClientList()
    {   
        $userlists = User::get();
        return view('admin.client.list',compact('userlists'));
    }

    // method for  create client 
    public function create()
    {
        return view('admin.client.create');
    }

    public function registerClient(ClientRegisterRequest $request)
    {
        $user= User::create([
            'username'=>$request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verified'=>1,
            'status'=>1,
            'user_role'=>1,
            'first_time_login'=>0,
        ]);
        
        $roles = Role::find($user->user_role);
        $permissions = Permission::get(); 

        $user->assignRole($roles);
        $roles->givePermissionTo($permissions);
        $user->givePermissionTo($permissions);
        
        Mail::to($user->email)->send(new ClientInvitationMail($request->email,$request->password));
        return back()->with('success', 'Client register successfully and login link mail has been sended to Client registerd eamil address.');
    }

    public function showclietstSupplierList($id)
    {
        $supplierlists = Supplier::where('invited_by' ,$id)->get();
        return view('admin.client.supplierlist',compact('supplierlists'));
    }
    public function changeStatus($status,$id)
    {
        $userlists = User::find($id);
        if($status == "block")
        {
            $userlists->status= 0 ;
            $userlists->save();
            $message = 'Client has been blocked successfully';
        }
        elseif($status=="unblock"){ 
            $userlists->status= 1;
            $userlists->save();
            $message = 'Client has been unblocked successfully';
        }
        return redirect()->route('admin.client.list')->with('success',$message);
    }
    public function changeSupplierStatus($status,$id)
    {
        $userlists = Supplier::find($id);
        if($status == "block")
        {
            $userlists->blocked= 1 ;
            $userlists->save();
            $message = 'Client has been blocked successfully';
        }
        elseif($status=="unblock"){     
            $userlists->blocked= 0;
            $userlists->save();
            $message = 'Client has been unblocked successfully';
        }
        return back()->with('success',$message);
    }

}