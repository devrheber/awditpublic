<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientAnswerObservation;
use App\Models\Answer;

class ClientObservationController extends Controller
{
    //
    public function  addFile(Request $request)
    {
        $request->validate([
            'cli_answer_file' => 'required|max:1024',
        ]);
        if (isset($request->cli_answer_file)) {
            $uploadedImage =$request->cli_answer_file;
            $imageName = 'IMG_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('client/answers/documents/'.getUser()->id);
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }
        else{
            $imageName = NULL;
        }   
        $answer = Answer::findOrFail($request->answer_id);
        $ansfile  =  ClientAnswerObservation::create([
            'file_name'=>$imageName,
            'observation'=>$request->observation,
            'client_id'=>$answer->client_id,
            'supplier_id'=>$answer->respondent_id,
            'answer_id'=>$answer->id,
            'questionnaire_id'=>$answer->questionnaire_id,
            'question_id'=>$answer->question_id,
        ]);
        $answer->client_observation = $ansfile->id;
        $answer->update();



        return back()->with('success','File is uploaded successfully...!!');
    }

    public function addObservation(Request $request)
    {
        $request->validate([
            'cli_observation' => 'required|max:500',
        ]);
        $answer = Answer::findOrFail($request->answerid);
        $isexits = ClientAnswerObservation::where('question_id',$answer->question_id)->where('client_id',getUser()->id)->where('supplier_id',$answer->respondent_id)->where('answer_id',$answer->id)->count();
        if($isexits >0)
        {
            
            return back()->with('error','Observation is already exits');
        }
        else{
            $ansfile  =  ClientAnswerObservation::create([
                'observation'=>$request->cli_observation,
                'client_id'=>$answer->client_id,
                'supplier_id'=>$answer->respondent_id,
                'answer_id'=>$answer->id,   
                'questionnaire_id'=>$answer->questionnaire_id,
                'question_id'=>$answer->question_id,
            ]);
            $answer->client_observation = $ansfile->id;
            $answer->update();
            return back()->with('success','Observation is added successfully...');
        }
        
    }

    public function deleteObservation($id)
    {
        $observation  =  ClientAnswerObservation::findOrFail($id);
        $answer= Answer::findOrFail($observation->answer_id);
        $observation->delete();
        $answer->client_observation=  NULL;
        $answer->update();
        return back()->with('success','Observation is deleted successfully...');
    }
}
