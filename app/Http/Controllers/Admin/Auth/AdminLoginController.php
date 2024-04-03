<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminLoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    // use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    //Show the admin login form
    public function adminLoginForm()
    {
        //return the view of the form
        return view('admin.auth.login');
    }

    //take the login credential and transfer to the home page if cresential is correct
    public function adminLogin(AdminLoginRequest $request)
    {

        if(Auth::guard('admin')->attempt(['email' => $request->email,'password' =>$request->password],$request->get('remember')))
        {
            // if sucessfull the redirec to intended location
            return redirect($this->redirectTo);
        }
        // if fail to login the redirect to vack with form data.
        return back()->withInput($request->only('email', 'remember'))->with('error','Sorry, your credentials do not match.');

    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login.form');
    }
}
