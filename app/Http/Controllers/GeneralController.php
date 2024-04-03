<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;


class GeneralController extends Controller
{
    // Change the language
    public function language($lang)
    {   
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}