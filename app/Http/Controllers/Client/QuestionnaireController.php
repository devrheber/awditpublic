<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\QuestionnaireRequest;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\Supplier;
use App\Models\QuestionValue;
use App\Models\TempQuestionnaire;
use App\Models\QuestionnaireGroup;
use App\Models\Answer;
use App\Models\ClientTicket;
use App\Models\AssignQuestionary;
use App\Models\QuestionnairePermission;
use App\Models\QuestionRequirement;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\CompanySector;
use App\Models\CompanySize;
use App\Models\CompanyMaturity;
use Auth;
use PDF;
use DB;

class questionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userid = Auth::user()->id;
        $totalmosmif = Questionnaire::where('created_by',$userid)->get();

        $checkToPending = AssignQuestionary::where(['client_id'=>$userid,'is_checked'=>0,'is_approved'=>0,'answer_status'=>0])
                ->orderBy('updated_at','DESC')
                ->get();

        $ansQuestionnaires = AssignQuestionary::where(['client_id'=>$userid,'is_checked'=>1,'answer_status'=>1])
                ->orderBy('updated_at','DESC')
                ->get();

        $totalanswers = Answer::where(['client_id'=>$userid,'status'=>1])->get();

        $totalcorrectanswers= Answer::where(['client_id'=>$userid,'status'=>1,'is_approved'=>1])->get();
        $totalattachdoc = Answer::where(['client_id'=>$userid,'status'=>1])->where('answer_attach_doc_id','!=',NULL)->get();
        $totalcorrectattachdoc = Answer::where(['client_id'=>$userid,'status'=>1,'is_approved'=>1])->where('answer_attach_doc_id','!=',NULL)->get();
        $totalobservation = Answer::where(['client_id'=>$userid,'status'=>1])->where('observation','!=',NULL)->get();

        $answers = array();
        $attachdoc = array();
        $correctattachdoc = array();
        $observation = array();
        for($i=1;$i<=12;$i++)
        {
            $answers[$i] = Answer::where(['client_id'=>$userid,'status'=>1,'is_approved'=>1])->whereMonth('created_at',$i )->whereYear('created_at',date('Y'))->count();
        }

        for($i=1;$i<=12;$i++)
        {
            $attachdoc[$i] = Answer::where(['client_id'=>$userid,'status'=>1])->where('answer_attach_doc_id','!=',NULL)->whereMonth('created_at',$i )->whereYear('created_at',date('Y'))->count();
        }

        for($i=1;$i<=12;$i++)
        {
            $correctattachdoc[$i] = Answer::where(['client_id'=>$userid,'status'=>1,'is_approved'=>1])->where('answer_attach_doc_id','!=',NULL)->whereMonth('created_at',$i )->whereYear('created_at',date('Y'))->count();
        }

        for($i=1;$i<=12;$i++)
        {
            $observation[$i] = Answer::where(['client_id'=>$userid,'status'=>1])->where('observation','!=',NULL)->whereMonth('created_at',$i )->whereYear('created_at',date('Y'))->count();
        }

        $high   = Answer::with('question')->where(['client_id'=>$userid,'status'=>1,'is_approved'=>1,'answer_value'=>3])->get();
        $mid    = Answer::with('question')->where(['client_id'=>$userid,'status'=>1,'is_approved'=>1,'answer_value'=>2])->get();
        $low    = Answer::with('question')->where(['client_id'=>$userid,'status'=>1,'is_approved'=>1,'answer_value'=>1])->get();// $low =
        $not    = Answer::with('question')->where(['client_id'=>$userid,'status'=>1,'is_approved'=>1,'answer_value'=>0])->get();

        if($totalanswers->count() > 0)
        {
            $per_correct_ans = ($totalcorrectanswers->count() *100)/($totalanswers->count());
            $per_attach_doc = ($totalattachdoc->count() *100)/($totalanswers->count());
            $per_correct_attach_doc = ($totalcorrectattachdoc->count() *100)/($totalanswers->count());
            $per_observation = ($totalobservation->count() *100)/($totalanswers->count());
        }
        else
        {
            $per_correct_ans = 0;
            $per_attach_doc =0;
            $per_correct_attach_doc = 0;
            $per_observation =0;
        }

        $totalassignquestionniares = AssignQuestionary::where(['client_id'=>$userid])->orderBy('updated_at','DESC')->get();
        $totalAssignQuestionnaireby =AssignQuestionary::select('supplier_id',DB::raw('COUNT(*) AS total'))->where(['client_id'=>$userid])->groupBy('supplier_id')->orderBy('updated_at','DESC')->get();
        $totalsupplier = $totalAssignQuestionnaireby->count();
        $totalquestionnnarire = $totalassignquestionniares->count();
        if($totalquestionnnarire != 0)
        {
            $totalpersentage = 0;
            foreach($totalAssignQuestionnaireby as $assignQuesdata)
            {
                // dump($assignQuesdata);
                $totalSupplierQuestionnaire  = AssignQuestionary::select('supplier_id',DB::raw('COUNT(*) AS total'))->where(['client_id'=>$userid])->groupBy('supplier_id')->orderBy('updated_at','DESC')->get();
                $total = $totalSupplierQuestionnaire->count();
                $completed = AssignQuestionary::where(['client_id'=>$userid,'answer_status'=>1,'supplier_id'=>$assignQuesdata->supplier_id])->get()->count();
                // dump($completed);
                $totalpersentage +=  (($completed*100)/$total);
            }
            $totalCompletedMosmif = (($totalpersentage*100)/($totalsupplier*100));

            $totalnoapply = AssignQuestionary::where(['client_id'=>$userid,'is_applied'=>1])->orderBy('updated_at','DESC')->get()->count();
            $totalpernoapply = ($totalnoapply*100)/($totalquestionnnarire);
        }
        else{
            $totalCompletedMosmif =0;
            $totalpernoapply = 0;
        }

        $categories = CompanySector::get();
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();

        $suppliers = Supplier::where('invited_by',Auth::user()->id)->orderBy('first_name')->get();
        return view('client.questionnaries.index',compact(
            'totalmosmif','checkToPending','ansQuestionnaires',
            'answers','attachdoc','correctattachdoc','observation',
            'high','low','mid','not',
            'per_correct_ans','per_attach_doc','per_correct_attach_doc','per_observation',
            'countries','cities','categories','sizes','maturities','states','suppliers','totalCompletedMosmif','totalpernoapply'));
    }

    public function listQuestionnaire()
    {
        $questionnaires  = Questionnaire::where('created_by',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('client.questionnaries.list',compact('questionnaires'));
    }

    public function create(Request $request)
    {
        if($request->hasCookie('tempcode'))
        {
            $cookie = $request->cookie('tempcode');
            $tempcode = $cookie;
        }else{
            $tempcode =uniqid();
            $cookie = Cookie::queue('tempcode',$tempcode, 300);
        }
        $questions = TempQuestionnaire::where('temp_code',$tempcode)->where('created_by',Auth::user()->id)->get();
        $questionvalue = QuestionValue::where('status',1)->get(   );
        $questiongroup =QuestionnaireGroup::where('created_by',Auth::user()->id)->get();
        return view('client.questionnaries.create',compact('questions','questionvalue','questiongroup','tempcode'));
    }

    public function cancelBtn()
    {
        Cookie::queue(Cookie::forget('tempcode'));
        Cookie::queue(Cookie::forget('questionary_name'));

        return redirect()->route('home');
    }

    public function store(QuestionnaireRequest $request)
    {
        if($request->questions == null){
            $array = null;
        }else{
        $array = implode(",",$request->questions);
        }
        $questionnaires =Questionnaire::create([
            'name'=>$request->name,
            'slug'=>str_replace(' ','_',$request->name),
            'questions'=>$array,
            'status'=> 1,
            'is_checked' => 1,
            'created_by'=>Auth::user()->id,
        ]);
        //    return $questionnaires;
       if ($request->expectsJson()) {
            return $questionnaires;
        }
        // return back()->with('success','New Questionnaire has been imported successfully...!!');
        return redirect()->route('home')->with('success',trans('message.Data saved successfully'));
    }

    public function show($id)
    {
        $questionnary = Questionnaire::with('questions')->find($id);
        $questions =$questionnary->questions;
        $qdetails = Question::where('questionnaires_id',$id)->get()->groupBy('group_id');
        return view('client.questionnaries.view',compact('questionnary','qdetails'));

    }

    public function edit($qid)
    {
        $questionnaire = Questionnaire::findOrFail($qid);
        $qdetails = Question::where('questionnaires_id',$qid)->get()->groupBy('group_id');
        $questionvalue = QuestionValue::where('status',1)->get();
        $questiongroup =QuestionnaireGroup::where('created_by',Auth::user()->id)->get();
        return view('client.questionnaries.edit',compact('questionnaire','qdetails','questionvalue','questiongroup'));
    }

    public function update(Request $request,$id)
    {
        $questions = $request->questions;
        $questionvalue = $request->question_value;
        if($questions != NULL)
        {
            foreach($questions as $qkey=>$question)
            {
                $ques = Question::findOrFail($question);
                foreach($questionvalue as $vkey=>$value)
                {
                    if($qkey == $vkey)
                    {
                        $ques->value_id = $value;
                        $ques->update();
                    }
                }
            }
        }
        $questionnaire =Questionnaire::find($id);
        $questionnaire->name=$request->name;
        $questionnaire->questions=implode(",",$request->questions);
        $questionnaire->slug =str_replace(' ','_',$request->name) ;
        $questionnaire->status=1;
        $questionnaire->update();

        return redirect()->route('client.questionnarie.index')->with('success',trans('message.Questionnaire saved successfully'));
    }
    public function destroy($id)
    {
        $questionnries = Questionnaire::find($id);
        $questionnries->delete();
        return  redirect()->route('home')->with('error',trans('message.Data deleted successfully'));
    }

    public function changeStatus($id)
    {
        $questionnaries = Questionnaire::find($id);
        $type = $message = "";
        if($questionnaries->status == "1")
        {
            $questionnaries->status = 0;
            $questionnaries->update();
            $type ="error";
            $message = trans('message.Data updated successfully');
        }
        elseif($questionnaries->status == "0")
        {
            $questionnaries->status = 1;
            $questionnaries->update();
            $type ="success";
            $message = trans('message.Data updated successfully');
        }
        return back()->with($type,$message);
    }

    public  function showPendingQuestionary($id)
    {
        $checkToPending = AssignQuestionary::findOrFail($id);
        $checkToPending->is_checked =1;
        $checkToPending->update();
        return redirect()->route('client.supplier.details',$checkToPending->supplier_id);
    }

    public function importQuestionnaire($id)
    {
        $questionnaire  = Questionnaire::findOrFail($id);
        $qdetails = Question::where('questionnaires_id',$questionnaire->id)->orderBy('group_id')->get()->groupBy('group_id');
        $questionvalue = QuestionValue::where('status',1)->get();
        $questiongroup =QuestionnaireGroup::where('created_by',Auth::user()->id)->get();
        return view('client.questionnaries.import',compact('questionnaire','qdetails','questionvalue','questiongroup'));
    }

    public function storeImport(QuestionnaireRequest $request)
    {
        $old_questionary = Questionnaire::findOrFail($request->old_qid);
        if($old_questionary->questions != NUll)
        {
            $questions  = explode(',',$old_questionary->questions);
        }else{
            $questions = NULL;
        }
        $questionnaire = Questionnaire::create([
            'name'=>$request->name,
            'slug'=>str_replace(' ','_',$request->name),
            'status'=>1,
            'created_by'=>Auth::user()->id,
            'imported_from'=>$request->old_qid,
        ]);

        $new_questionary = Questionnaire::findOrFail($questionnaire->id);
        $questionvalue =array();
        if($questions!=NULL){
            foreach($questions as $question)
            {
                $old_question = Question::findOrFail($question);
                $new_question = Question::create([
                    'name'=>$old_question->name,
                    'observation'=>$old_question->observation,
                    'based_on'=>$old_question->based_on,
                    'objective'=>$old_question->objective,
                    'questionnaires_id'=>$new_questionary->id,
                    'apply'=>$old_question->apply,
                    'value_id'=>$old_question->value_id,
                    'group_id'=>$old_question->group_id,
                    'status'=>1,
                    'created_by'=>Auth::user()->id,
                ]);
                $old_que_req = QuestionRequirement::where('question_id',$question)->get();
                foreach($old_que_req as $que_req)
                {
                    $qrequirement =QuestionRequirement::create([
                        'question_id'=>$new_question->id,
                        'requirements'=>$que_req->requirements,
                        'status'=>1,
                    ]);
                }
                array_push($questionvalue,$new_question->id);
            }
        }
        $imported_question = implode(',',$questionvalue);
        $new_questionary->questions = $imported_question;
        $new_questionary->update();


        if ($request->expectsJson()) {
            return $new_questionary;
        }
        return redirect()->route('home')->with('success','New Questionnaire has been imported successfully...!!');
    }

    // download the questionnaires
    public function downloadQuestionnaires($sid,$lid,$qid)
    {
        $questionnaire = Questionnaire::findOrFail($qid);
        $location = $lid;
        $supplier = $sid;
        // return view('client.questionnaries.downloadquestionnaire', compact('questionnaire','location','supplier'));
        $pdf = PDF::loadView('client.questionnaries.downloadquestionnaire',['questionnaire'=>$questionnaire,'location'=>$location,'supplier'=>$supplier]);
        return $pdf->download($questionnaire->name.'.pdf');
    }
}
