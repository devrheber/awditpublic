<?php

namespace App\Http\Controllers\Supplier\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Supplier\SupplierLoginRequest;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Auth;

class SupplierLoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::SUPPLIERHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:supplier')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('supplier');
    }

    //Show the admin login form
    public function SupplierLoginForm()
    {
        //return the view of the form
        return view('supplier.auth.login');
    }

    //take the login credential and transfer to the home page if cresential is correct
    public function SupplierLogin(SupplierLoginRequest $request)
    {
        // dd($request);
        $user = Supplier::where('email',$request->email)->get()->first();
        if($user->blocked == 0)
        {
            if(Auth::guard('supplier')->attempt(['email' => $request->email,'password' =>$request->password],$request->get('remember')))
            {
                if($user->first_time_login == 1)
                {
                    // if sucessfull the redirec to intended location
                    return redirect($this->redirectTo);
                }
                else{

                    // if sucessfull the redirec to intended location
                    return redirect()->route('supplier.first.new.password');
                }
            }
            // if fail to login the redirect to vack with form data.
            return back()->withInput($request->only('email', 'remember'))->with('error','Sorry, your credentials do not match.');
        }
        return redirect()->route('supplier.login.form')->with('error','Your are block by admin.');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('supplier.login.form');
    }
}
