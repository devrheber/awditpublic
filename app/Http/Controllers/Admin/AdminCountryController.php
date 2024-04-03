<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class AdminCountryController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }
   public function index()
   {
      $countries = Country::get();
      return view('admin.country.list',compact('countries'));
   }
}