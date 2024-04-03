<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionnairePermission;
use App\Models\Questionnaire;
use Auth;

class  QuestionnairePermissionController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function questionnaireSetting($id)
   {
        $questionnaire = Questionnaire::findOrFail($id);
        $qpermission = QuestionnairePermission::where('questionnaire_id',$questionnaire->id)->where('user_id',Auth::user()->id)->get()->first(); 
        return view('client.questionnaries.setting',compact('questionnaire','qpermission'));
   }

   public function storeSetting(Request $request)
   {    
         // dd($request);
         $questionnaire = QuestionnairePermission::where('user_id',getUser()->id)->where('questionnaire_id',$request->questionary_id)->first();
         if($request->status != "on") { $status = 0; }else{$status =1;}
         if($request->q_status != "on") { $q_status = 0; }else{$q_status =1;}
         if($request->q_level != "on") { $q_level = 0; }else{$q_level =1;}
         if($request->q_apply_or_not != "on") { $q_apply_or_not = 0; }else{$q_apply_or_not =1;}
         if($request->q_results != "on") { $q_results = 0; }else{$q_results =1;}
         if($request->q_questions != "on") { $q_questions = 0; }else{$q_questions =1;}
         if($request->q_answers != "on") { $q_answers = 0; }else{$q_answers =1;}
         if($request->q_docs != "on") { $q_docs = 0; }else{$q_docs =1;}
         if($request->q_access_doc != "on") { $q_access_doc = 0; }else{$q_access_doc =1;}
         if($request->q_other_file != "on") { $q_other_file = 0; }else{$q_other_file =1;}
         if($request->q_add_edit_folder != "on") { $q_add_edit_folder = 0; }else{$q_add_edit_folder =1;}
         if($request->q_add_file != "on") { $q_add_file = 0; }else{$q_add_file =1;}
         if($request->q_download_fie != "on") { $q_download_fie = 0; }else{$q_download_fie =1;}
         if($request->q_observation != "on") { $q_observation = 0; }else{$q_observation =1;}
        
         $questionnaire->status = $status;
         $questionnaire->q_status = $q_status;
         $questionnaire->q_level = $q_level;
         $questionnaire->q_apply_or_not = $q_apply_or_not;
         $questionnaire->q_results = $q_results;
         $questionnaire->q_questions = $q_questions;
         $questionnaire->q_answers = $q_answers;
         $questionnaire->q_docs = $q_docs;
         $questionnaire->q_access_doc = $q_access_doc;
         $questionnaire->q_other_file = $q_other_file;
         $questionnaire->q_add_edit_folder = $q_add_edit_folder;
         $questionnaire->q_add_file = $q_add_file;
         $questionnaire->q_download_fie = $q_download_fie;
         $questionnaire->q_observation = $q_observation;
         $questionnaire->update();
         return back()->with('success','questionnaire setting is  updated successfully');
      }
    public function changeQuestionnaireStatus(Request $request,$id)
    {
      $qpermission =  QuestionnairePermission::where('questionnaire_id',$id)->where('user_id',Auth::user()->id)->get()->first(); 
      $value = (int)$request->value ;
      if($request->permission == "q_observation"){
         $qpermission->q_observation = $value;
      }
      if($request->permission == "status"){
         if($value == 0)
         {
            $qpermission->q_status = $value;
         }else{
            $qpermission->status = $value; 
            $qpermission->q_level = $value;
            $qpermission->q_apply_or_not = $value; 
         }
      }
      if($request->permission == "q_status"){
         $qpermission->q_status = $value;
      }
      if($request->permission == "q_level"){
         $qpermission->q_level = $value;
      }
      if($request->permission == "q_apply_or_not"){
         $qpermission->q_apply_or_not = $value; 
      }
      if($request->permission == "q_results"){
         $qpermission->q_results = $value;
      }
      if($request->permission == "q_questions"){
         $qpermission->q_questions = $value;
      }
      if($request->permission == "q_answers"){
         $qpermission->q_answers = $value; 
      }
      if($request->permission == "q_docs"){
         $qpermission->q_docs = $value;
      }
      if($request->permission == "q_access_doc"){
         $qpermission->q_access_doc = $value;
      }
      if($request->permission == "q_other_file"){
         $qpermission->q_other_file = $value;
      }
      if($request->permission == "q_add_edit_folder"){
         $qpermission->q_add_edit_folder = $value;
      }
      if($request->permission == "q_add_file"){
         $qpermission->q_add_file = $value;
      }
      if($request->permission == "q_download_fie"){
         $qpermission->q_download_fie = $value;
      }
      if($request->permission == "q_observation"){
         $qpermission->q_observation = $value;
      }
      $qpermission->update();

      return response()->json([
         'success'=>1,
         'message'=>"data has been updated successfully",
         'data'=>$qpermission,
      ]);
    }


}