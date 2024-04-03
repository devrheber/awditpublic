<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Client\RegistrationRequest;
use App\Mail\VerifyMail;
use App\Models\ClientInvitation;
use App\Http\Requests\Client\VerifyMailRequest;

class RegisterController extends Controller
{

    use RegistersUsers;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide thisVerifyMail
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $rules = [
            'username' => ['required', 'string','max:12','unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required','min:8','max:16','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/','confirmed',],
        ];

        $customMessages = [
            'Username.required'=>'Username Field is required.',
            'Username.string'=>'Username must be form of the string',
            'Username.max'=>'username allow maximum 12 character',
            'Username.unique'=>'The username has already been taken.',

            'email.required'=>'Email Field is required',
            'email.email'=>'Email must be form of the email address',
            'email.max'=>'Email address contain maximum 255 character',
            'email.unique'=>'Email address has been taken',

            'password.required'=>'Password field is required',
            'password.regex'=>'Password  contain minimum one uppercase and one digit',
            'password.max'=>'password contain maximum 16 character',
            'password.min'=>'password contain minimum 8 character',
        ];

        return Validator::make($data, $rules ,$customMessages);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'username'=>$data['username'],
            'email' => $data['email'],
            'user_role'=>1,
            'password' => Hash::make($data['password']),
            'verified'=>0,
            'status'=>0,
            'first_time_login'=>0,
        ]);
        $roles = Role::find($user->user_role);
        $permissions = Permission::get();

        $user->assignRole($roles);
        $roles->givePermissionTo($permissions);
        $user->givePermissionTo($permissions);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time()),
        ]);
        Mail::to($user->email)->send(new VerifyMail($user));
        return $user;
    }
    public function reSendMail()
    {
        return view('auth.resendmail');
    }
    public function sendverifymail(VerifyMailRequest $request)
    {
        $user = User::where('email',$request->email)->get()->first();
        Mail::to($user->email)->send(new VerifyMail($user));
        return redirect()->back()->with('success','We have emailed your email verification link!');
    }
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
            $verifyUser->user->verified = 1;
            $verifyUser->user->status = 1;
            $verifyUser->user->save();
            $status = "Your e-mail is verified. You can now login.";
            } else {
            $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/login')->with('error', "Sorry your email cannot be identified.");
        }
        return redirect('/login')->with('success', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect()->route('login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

    public function authenticated(Request $request, $user)
    {
    if (!$user->verified) {
        auth()->logout();
        return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
    }
    return redirect()->intended($this->redirectPath());
    }

    public function acceptClientRequest($id)
    {
        $user = ClientInvitation::where('id',$id)->first();
        $roles = Role::find($user->user_role_id);
        $username = substr($user->email, 0, strpos($user->email,'@'));
        $client =User::where('email',$user->email)->get();
        if($client->count()==0)
        {
            $client= User::create([
                'username'=>$username,
                'email' => $user->email,
                'user_role'=>$user->user_role_id,
                'password' => Hash::make($user->password),
                'verified'=>1,
                'status'=>0,
                'first_time_login'=>0,
                'role_assigner'=>$user->sender_id,
            ]);
            $client->assignRole($roles);
            $user->status = 1;
            $user->update();
        }
        else
        {
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }
}
