<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\Client\ClientLoginRequest;
use App\Models\User;
use Auth;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // login method
    public function login(ClientLoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user!=NUll)
        {
            if($user->verified == 1)
            {
                if(Auth::attempt(['email' => $request->email,'password' =>$request->password],$request->get('remember')))
                {
                    if($user->first_time_login==1)
                    {
                        // if sucessfull the redirec to intended location
                        return redirect($this->redirectTo);
                    }
                    elseif($user->first_time_login==0)
                    {
                        return redirect()->route('client.first.new.password');
                    }
                }
                // if fail to login the redirect to vack with form data.
                return back()->withInput($request->only('email', 'remember'))->with('warning',trans('auth.credentials_not_matched'));
            }
            return back()->withInput($request->only('email', 'remember'))->with('warning',trans('auth.verify_account'));
        }
        return back()->with('warning',trans('Your Account is not Exist'));
    }
    protected function authenticated(Request $request, $user)
    {
        if($user->first_time_login == 0)
        {
            $user->first_time_login = 1;
            $user->save();
            return redirect()->route('client.profile.add');
        }
        return redirect($this->redirectTo);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
