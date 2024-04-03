<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;

class AdminQuestionnaireController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }
   public function questionnaireList()
   {
      $questionnaires = Questionnaire::orderBy('created_at','DESC')->get();
      return view('admin.questionnaire.list',compact('questionnaires'));
   }
}