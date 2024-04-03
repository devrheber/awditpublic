<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\SupplierTicket;
use App\Models\ClientTicket;
use App\Models\Questionnaire;
use App\Models\AssignQuestionary;
use App\Models\Event;
use Auth;
use App\Models\Supplier;
use Carbon\Carbon;
use DB;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user()->id;
        $invitation = Invitation::where('sender_id',$user)->count();

        // total questionnaires
        $totalquestionnaire = Questionnaire::where('created_by',$user)->where('status',1)->get()->count();
        $totalquestionnaireofyear = array();
        $newquestionnaire = Questionnaire::where('created_by',$user)->where('created_at','>=',date('Y-m-d').' 00:00:00')->count();
        $newquestionnaireofyear = array();
        for($i=1;$i<=12;$i++)
        {
            $totalquestionnaireofyear[$i] = Questionnaire::where('created_by',$user)->where('status',1)->whereMonth('created_at',$i )->get()->count();
        }

        for($i=1;$i<=12;$i++)
        {
            $newquestionnaireofyear[$i] = Questionnaire::where('created_by',$user)->whereMonth('created_at',$i )->whereYear('created_at',date('Y'))->count();
        }

        // total client received tickets
        $totalclientticket = SupplierTicket::where('receiver_id',$user)->get()->count();
        $newclientticket = SupplierTicket::where('receiver_id',$user)->where('created_at','>=', date('Y-m-d').' 00:00:00')->where('is_checked',0)->count();

        // total accepted  invitation  out of the sent
        $totalaccepted = Invitation::where('sender_id',$user)->where('status',1)->count();
        $newaccepted = Invitation::where('sender_id',$user)->where('status',1)->where('updated_at','>=', date('Y-m-d').' 00:00:00')->count();
        if($totalaccepted > 0){
            $acceptedpersentage = ((100*$totalaccepted)/$invitation);
        }else{
            $acceptedpersentage = 0;
        }

        // expired invitation
        $totalexpired  = Invitation::where('sender_id',$user)->where('status',3)->count();
        $newexpired = Invitation::where('sender_id',$user)->where('status',3)->get()->where('updated_at','>=', date('Y-m-d').' 00:00:00')->count();
        if($totalexpired > 0){
            $expiredpersentage =((100*$totalexpired)/$invitation);
        }else{
            $expiredpersentage = 0;
        }

        //  total supplier
        $totalsuppliers = Supplier::where('invited_by',$user)->get()->count();
        $newsuppliersofyear = array();
        $totalsuppliersofyear = array();
        $newsuppliers = Supplier::where('invited_by',$user)->where('created_at','>=',date('Y-m-d').' 00:00:00')->get()->count();
        for($i=1;$i<=12;$i++)
        {
            $newsuppliersofyear[$i]  = Supplier::where('invited_by',$user)->whereMonth('created_at',$i )->whereYear('created_at',date('Y'))->count();
        }
        for($i=1;$i<=12;$i++)
        {
            $totalsuppliersofyear[$i]  = Supplier::where('invited_by',$user)->whereMonth('created_at',$i )->count();
        }

        // total invitation time out
        $totalsentinivtation = $invitation;
        $newsentinivitation = Invitation::where('sender_id',$user)->where('status',2)->get()->count();

        // by  month invited/ and also accepted invitation
        $dateS = Carbon::now()->subMonth(5);
        $dateE = Carbon::now();
        $totalinvitationlastsixmonth = Invitation::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                            ->where('sender_id',$user)
                            ->whereBetween('created_at',[$dateS,$dateE])
                            ->orderBy('created_at','desc')
                            ->groupBy('monthname')
                            ->get();

        $totalacceptedlastsixmonth =Invitation::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                            ->where('status',1)
                            ->where('sender_id',$user)
                            ->whereBetween('created_at',[$dateS,$dateE])
                            ->orderBy('created_at','desc')
                            ->groupBy('monthname')
                            ->get();

        $pendingQuestionnaires =  AssignQuestionary::where([
            'client_id'=>$user,
            'is_checked'=>0,
        ])->get();

        $today= date('Y-m-d');
		$current_date_time  = Carbon::now()->format('Y-m-d');
		$events = Event::where('created_by',$user)
                        ->whereDate('start_date','>=',$current_date_time)
                        ->where('status',1)->orderBy('created_at')
                        ->take(3)
                        ->get();

        return view('client.summary.index',
            compact('totalquestionnaire','newquestionnaire',
                'invitation','totalaccepted','acceptedpersentage',
                'newaccepted','totalexpired','newexpired',
                'expiredpersentage','totalclientticket','newclientticket',
                'totalsuppliers','newsuppliers' ,'totalsentinivtation','newsentinivitation',
                'newsuppliersofyear','totalsuppliersofyear','totalquestionnaireofyear','newquestionnaireofyear',
                'totalinvitationlastsixmonth','totalacceptedlastsixmonth','events'
            ));
    }

}
