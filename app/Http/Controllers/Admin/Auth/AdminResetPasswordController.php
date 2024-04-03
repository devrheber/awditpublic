<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;

class AdminResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    public function __construct()
    {
        $this->middleware('guest:admin');
    } 

    protected function guard(){
        return Auth::guard('admin');
    } 

    public function resetPasswordForm($token = null ,$email)
    {
        // dd($email);
        return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]);
    }  

    public function broker()
    {
        return Password::broker('admins');
    }       
}
