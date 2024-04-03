<?php

namespace App\Http\Controllers\Supplier\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class SupplierForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:supplier');
    }
    
    protected function guard()
    {
        return Auth::guard('supplier');
    }

    public function forgotPassWordForm()
    {
        return view('supplier.auth.passwords.email');
    }

    public function broker(){
        return Password::broker('suppliers');
    }

}
