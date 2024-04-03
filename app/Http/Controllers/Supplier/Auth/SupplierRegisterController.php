<?php

namespace App\Http\Controllers\Supplier\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Supplier;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\SupplierRegisterRequest;
use App\Http\Requests\Client\VerifyMailRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\VerifySupplier;
use Mail;
use Auth;
use App\Mail\ConfirmSupplierRegisterMail;


class SupplierRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::SUPPLIERHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // protected function guard()
    // {
    //     return Auth::guard('supplier');
    // } 

    // show register method
    public function supplierRegisterForm()
    {
        return view('supplier.auth.register');      
    }

    public function acceptInvitation($token)
    {
        // dd($token);
        $inviteduser = Invitation::where('invitation_token',$token)->get()->first();
        // dd($inviteduser);
        return view('supplier.auth.register',compact('inviteduser'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function supplierRegister(SupplierRegisterRequest $request)
    {
        // dd($request);
        $supplier = Supplier::create([
            'username' =>$request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'invited_by'=>Auth::user()->id,
            'verified'=>1,
            'status'=>0, 
            'blocked'=>0,
            'first_time_login'=>0,
        ]);
        Mail::to($supplier->email)->send(new ConfirmSupplierRegisterMail($request->password,$request->email));
        return redirect()->route('client.supplier.list')->with('success', 'Supplier register successfully and login link mail has been sendedto supplier registerd eamil address.');
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('error', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }  
}
