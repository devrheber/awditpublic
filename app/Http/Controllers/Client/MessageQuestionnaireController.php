<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\InviteSupplierRequest;
use App\Http\Controllers\Controller;
use App\Mail\NewInvitationMail;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Models\QuestionnaireReminder;
use App\Models\AssignQuestionary;
use App\Models\ClientTicket;
use Carbon\Carbon;
use Auth;
use Mail;

class MessageQuestionnaireController extends Controller
{
	// middleware of thhis guard
    public function __construct()
    {
        $this->middleware('auth');
    }

    // reminder page method
    public function reminder()
    {
        $user = auth()->user();

        $suppliers = QuestionnaireReminder::where('client_id',$user->id)
                ->OrderBy('created_at','DESC')
                ->get();

        $questionnaire = AssignQuestionary::where(['client_id'=>$user->id,'answer_status'=>0])
                ->get();

        $sentquestionary = AssignQuestionary::where('client_id',$user->id)
                ->get();

        if($sentquestionary->count()>0) {
            $completed = AssignQuestionary::where(['client_id'=>$user->id,'answer_status'=>1])->get();
            $remain = AssignQuestionary::where(['client_id'=>$user->id,'answer_status'=>0])->get();
            if($completed->count()>0)
            {
                $done = ($completed->count()*100)/($sentquestionary->count());
            }else{
                $done = 0;
            }
            if($remain->count() >0)
            {
                $notdone = ($remain->count()*100)/($sentquestionary->count());
            }else{
                $notdone =0;
            }
        } else{
            $done = 0;
            $notdone =0;
            $completed = 0;
        }

        return view('client.message.questionnaire.reminer',compact('suppliers','questionnaire','done','notdone','completed'));
    }

    // reminder details page
    public function reminderDetails($id)
    {
        $user =Auth::user();
        $supplier  = AssignQuestionary::findOrFail($id);
        return view('client.message.questionnaire.reminderdetails',compact('supplier','user'));
    }

    // send the reminder page as ticket
    public function sendReminder(Request $request)
    {
        // dd($request);
        $questionreminder = QuestionnaireReminder::create([
                'client_id'=>$request->client_id,
                'supplier_id'=>$request->supplier_id,
                'location_id'=>$request->	location_id,
                'questionnaire_id'=>$request->questionnaire_id,
                'status'=>$request->q_status,
        ]);

        $clientticket = ClientTicket::create([
                'sender_id'=>Auth::user()->id,
                'receiver_id'=>$request->supplier_id,
                'ticket_number'=>uniqid(),
                'ticket_type'=>2,
                'location_id'=>$request->location_id,
                'description'=>"",
                'answer_status'=>0,
                'status'=>1,
        ]);
        return back()->with('success','questionnaire reminder is send successfully');
    }

    // sends the resend reminder to all selected supplier
    public function resendAllSelected(Request $request)
    {
        $user=Auth::user();
        $selected = $request->selected;
        $data = explode(',',$request->selected);
        foreach($data as $select)
        {
            $supplier  = AssignQuestionary::findOrFail($select);

            $questionreminder = QuestionnaireReminder::create([
                'client_id'=>$supplier->client_id,
                'supplier_id'=>$supplier->supplier_id,
                'location_id'=>$supplier->	location_id,
                'questionnaire_id'=>$supplier->questionnaire_id,
                'status'=>$supplier->answer_status,
            ]);

            $message="Hello {$supplier->receiver->first_name} \n".
                "We want to remind you that you have not yet completed the questionnaire {$supplier->questionnaire->name} \n".
                "Do not hesitate to contact us if you need support or help. \n"."Sincerely, ({$user->first_name}), ({$user->job_title}) \n".
                "From({$user->company->name})\n";

            $clientticket = ClientTicket::create([
                'sender_id'=>Auth::user()->id,
                'receiver_id'=>$supplier->supplier_id,
                'ticket_number'=>uniqid(),
                'ticket_type'=>2,
                'location_id'=>$supplier->location_id,
                'description'=>$message,
                'answer_status'=>0,
                'status'=>1,
            ]);
        }
        $suppliers = QuestionnaireReminder::with(['supplier','client','location'])->where('client_id',$user->id)->OrderBy('created_at','DESC')->get();
        return  back()->with('success','ticket send successfully....');
    }

}
