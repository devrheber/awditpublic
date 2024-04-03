<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\QuestionnaireGroupRequest;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Client\QuestionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionValue;
use App\Models\QuestionnaireGroup;
use App\Models\QuestionRequirement;
use App\Models\TempQuestionnaire;
use App\Models\Questionnaire;
use Auth;
use URL;

class QuestionController extends Controller
{
    public function __construct()   
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $questionnaries  = Question::get();
        return view('client.question.list',compact('questionnaries'));
    }

    public function create($tempcode)
    {
        // dd($tempcode);
        $questionvalue = QuestionValue::where('status',1)->get();
        $questiongroup =QuestionnaireGroup::where('created_by',Auth::user()->id)->get();
        $qid =$tempcode;
        // dd($qid);
        return view('client.question.create',compact('questionvalue','questiongroup','qid'));
    }

    public function store(QuestionRequest $request)
    {
        $apply=0;
        if($request->apply == "on")
        { 
            $apply = 1;
        }
        // store the question
        $questionData =Question::create([  
            'name'=>$request->question,
            'observation'=>$request->observation,
            'based_on'=>$request->based_on,
            'objective'=>$request->objective,
            'questionnaires_id'=>$request->qid,
            'apply'=>$apply,
            'value_id'=>$request->question_value,
            'group_id'=>$request->question_group,
            'status'=>1,
            'created_by'=>Auth::user()->id,
        ]);
        // store the question requirements
        foreach($request->requirements as $requirements)
        {   
            $qrequirement =QuestionRequirement::create([
                'question_id'=>$questionData->id,
                'requirements'=>$requirements,
                'status'=>1,
            ]);
        }
        // update the question in questionnaires
        $questionnaire= Questionnaire::findOrFail($request->qid);
        // $questions =  explode(',',$questionnaire->questions);
        // $questions[] = $questionData->id;
        // $questionnaire->questions = implode(',',$questions);
        // $questionnaire->update();
        // return back()->with('success','Question created successfully');
        return redirect()->route('client.questionnarie.edit',$questionnaire->id);
    }
    public function storeEdit(QuestionRequest $request)
    {
        // dd($request);
        $apply=0;
        if($request->apply == "on")
        {   
            $apply = 1;
        }
        $question =Question::create([
            'name'=>$request->question,
            'observation'=>$request->observation,
            'based_on'=>$request->based_on,
            'objective'=>$request->objective,
            'apply'=>$apply,
            'value_id'=>$request->question_value,
            'group_id'=>$request->question_group,
            'status'=>1,
            'created_by'=>Auth::user()->id,
        ]);
        // dd($request->requirements);
        foreach($request->requirements as $requirements)
        {   
            $qrequirement =QuestionRequirement::create([
                'question_id'=>$question->id,
                'requirements'=>$requirements,
                'status'=>1,
            ]);
        }
        // dd($question->id);
        $questionnaire= Questionnaire::findOrFail($request->temp_code);
        // dd($questionnaire->questions);
        $questions =  explode(',',$questionnaire->questions);
        
        // dd($questions);
        $questions[] = $question->id;
        $questionnaire->questions = implode(',',$questions);
        $questionnaire->update();
        // dd($questionnaire);
        return redirect()->route('client.questionnarie.edit',$request->temp_code)->with('success','Question created  successfully');    
    }

    public function edit($id)
    {
        $questionnaries  = Question::find($id);
        return view('client.question.edit',compact('questionnaries'));
    }

    public function update(QuestionRequest $request,$id)    
    {
        $questionnarie =Question::find($id);
        $questionnarie->name=$request->question;
        $questionnarie->observation=$request->observation;
        $questionnarie->based_on=$request->based_on;
        $questionnarie->objective=$request->objective;
        $questionnarie->apply=$apply;
        $questionnarie->value_id=$request->question_value;
        $questionnarie->status=1;
        $questionnarie->update();
        return  back()->with('success','Data updated successfully');
    }
    public function destroy($id)
    {
        $questionnries = Question::findOrFail($id);
        $questionnries->delete();
        $tempquestion = TempQuestionnaire::where('question_id',$id)->delete();
        return  back()->with('error','Data deleted successfully');
    }

}