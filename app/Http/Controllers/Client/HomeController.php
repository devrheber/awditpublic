<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\BrandRequest;
use App\Http\Requests\Client\ChangePasswordRequest;
use App\Http\Requests\Client\ClientNewPasswordRequest;
use App\Http\Requests\Client\CompanyRequest;
use App\Http\Requests\Client\ProfileRequest;
use App\Http\Requests\Client\QuestionnaireRequest;
use App\Models\Brand;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyMaturity;
use App\Models\CompanySector;
use App\Models\CompanySize;
use App\Models\Country;
use App\Models\Questionnaire;
use App\Models\QuestionnaireGroup;
use App\Models\QuestionValue;
use App\Models\State;
use App\Models\Supplier;
use App\Models\SupplierLocation;
use App\Models\TempQuestionnaire;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $suppliers = Supplier::where('invited_by', $userid)->get();
        $questionnaire =  Questionnaire::where('created_by', $userid)->get();
        $location = SupplierLocation::join('suppliers', 'suppliers.id', '=', 'supplier_location.supplier_id')->where('suppliers.invited_by', Auth::user()->id)->get();
        return view('client.home', compact('suppliers', 'questionnaire', 'location'));
    }

    // method for the change password of the client
    public function changePassword()
    {
        return  view('client.changepassword');
    }

    // method for the store the changed password
    public function storeChangePassword(ChangePasswordRequest $request)
    {

        $client = User::find(Auth::user()->id);
        if (Hash::check($request->current_password, Auth::user()->password)) {
            if ($request->new_password == $request->confirm_password) {
                $client->password = Hash::make($request->new_password);
                $client->update();

                // Agregar un mensaje de éxito a la sesión
                session()->flash('success', trans('message.Password reset successfully.'));

                // Retornar una respuesta de éxito al cliente
                return redirect()->route('home')->with('success', trans('message.Password reset successfully.'));
            } else {
                // Agregar un mensaje de error a la sesión
                session()->flash('error', trans('message.The new password and confirm password do not match'));

                // Retornar una respuesta de error al cliente
                return redirect()->route('home')->with('error', trans('message.The new password and confirm password do not match'));
            }
        } else {
            // Agregar un mensaje de error a la sesión
            session()->flash('error', trans('message.The current password is not correct. Please try again.'));

            // Retornar una respuesta de error al cliente

            return redirect()->route('home')->with('error', trans('message.The current password is not correct. Please try again.'));
        }
    }

    //method of the add new password at first login
    public function newPassword()
    {
        return view('client.first_login.newpassword');
    }

    //method of the store new password at first login
    public function storeNewPassword(ClientNewPasswordRequest $request)
    {
        // dd($request);
        $client = User::find(Auth::user()->id);
        // dd($client);
        if ($request->password == $request->password_confirmation) {
            $client->password = Hash::make($request->password);
            $client->save();
            if ($client->can('create company')) {
                return redirect()->route('client.first.company.create')->with('success', trans('message.Password reset successfully.'));
            } else {
                return redirect()->route('client.first.create.profile')->with('success', trans('message.Password reset successfully.'));
            }
        } else {
            return redirect()->route('client.change.password')->with('error', trans('message.The new password and confirm password do not match'));
        }
    }

    //method for the show only selscted country's state
    public function getStates($id)
    {
        $states = State::where("country_id", $id)->get();
        // dd($states);
        return response()->json($states);
    }

    //method for the show only selscted state's cities
    public function getCities($id)
    {
        $cities = City::where("state_id", $id)->get();
        // dd($cities);
        return response()->json($cities);
    }
    // method for the create the company at the first login
    public function createCompany()
    {
        $countries = Country::get();
        $sectors = CompanySector::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();
        return view('client.first_login.company', compact('countries', 'sectors', 'sizes', 'maturities'));
    }
    // method for the store the company data at the first login
    public function storeCompany(CompanyRequest $request)
    {
        // dd($request);
        $company = Company::create([
            'name' => $request->cname,
            'cif' => $request->cif,
            'contrty_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'address' => $request->address,
            'postalcode' => $request->postal_code,
            'company_sector_id' => implode(',', $request->csector),
            'company_size_id' => $request->csize,
            'maturity_level_id' => $request->maturity,
            'security_department' => $request->security,
            'created_by' => Auth::user()->id,
            'status' => 1,
        ]);
        return redirect()->route('client.first.create.profile')->with('success', trans('message.Data saved successfuly'));
    }


    public function createProfile()
    {
        return view('client.first_login.profile');
    }

    public function storeProfile(ProfileRequest $request)
    {
        $userid = Auth::user()->id;
        $client = User::findOrFail($userid);
        if (isset($request->image)) {
            $uploadedImage = $request->image;
            $imageName = 'IMG' . $userid . '_' . date('Ymdhis') . '.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/client/profile');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        } else {
            $imageName = public_path('/images/client/profile') . 'home' . 'profile_pic.png';
        }

        $client->first_name = ucfirst($request->first_name);
        $client->last_name = ucfirst($request->last_name);
        $client->job_title = ucfirst($request->job_title);
        $client->image = $imageName;
        $client->first_time_login = 1;
        $client->update();
        return redirect()->route('client.first.create.brand')->with('success', trans('message.Data updated successfully'));
    }

    public function addBrand()
    {
        return view('client.first_login.addbrand');
    }

    public function storeBrand(BrandRequest $request)
    {
        // dd($request);
        $user = Auth::user();
        if (isset($request->image)) {
            $uploadedImage = $request->image;
            $imageName = 'IMG' . $user->id . '_' . date('Ymdhis') . '.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/client/brand');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        } else {
            $imageName = $client->image;
        }

        $brand = Brand::create([
            'user_id' => $user->id,
            'primary_color' => $request->pcolor,
            'secondary_color' => $request->scolor,
            'brand_logo' => $imageName,
        ]);

        if ($user->can('create questionnaire')) {
            return redirect()->route('client.first.create.questionnaire')->with('success', trans('message.Data saved successfully'));
        }
        return redirect()->route('home')->with('status', trans('message.Data updated successfully'));
    }

    public function createQuestionnaire(Request $request)
    {
        if ($request->hasCookie('tempcode')) {
            $cookie = $request->cookie('tempcode');
            $tempcode = $cookie;
        } else {
            $tempcode = uniqid();
            $cookie = Cookie::queue('tempcode', $tempcode, 300);
        }
        $questions = TempQuestionnaire::where('temp_code', $tempcode)->where('created_by', Auth::user()->id)->get();
        $questionvalue = QuestionValue::where('status', 1)->get();
        $questiongroup = QuestionnaireGroup::where('created_by', Auth::user()->id)->get();
        return view('client.first_login.questionnarie', compact('questions', 'questionvalue', 'questiongroup', 'tempcode'));
    }

    public function storeQuestionnaire(QuestionnaireRequest $request)
    {
        // dd($request);
        if ($request->questions == null) {
            $array = null;
        } else {
            $array = implode(",", $request->questions);
        }
        // dd($array);
        $questionnarie = Questionnaire::create([
            'name' => $request->name,
            'questions' => $array,
            'status' => 1,
            'created_by' => Auth::user()->id,
        ]);

        if ($request->hasCookie('tempcode')) {
            Cookie::queue(Cookie::forget('tempcode'));
        }

        return redirect()->route('home')->with('success', trans('message.Data saved successfully'));
    }
}
