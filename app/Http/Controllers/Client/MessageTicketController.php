<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\TicketRequest;
use App\Http\Requests\Client\ReplyTicketRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Questionnaire;
use App\Models\SupplierLocation;
use App\Models\ClientTicket;
use App\Models\SupplierTicket;
use App\Models\TicketAttachDoc;
use App\Models\AssignQuestionary;
use App\Models\QuestionnairePermission;
use Auth;

class MessageTicketController extends Controller
{
	// middleware of this guard
	public function __construct()
    {
        $this->middleware('auth');
	}

	// message index page
	public function ticketInboxList()
	{
		$user = Auth::user()->id;
		$ticketinbox = SupplierTicket::where('receiver_id',$user)
                                        ->whereNull('reply_on_ticket')
                                        ->where('status',1)
                                        ->where('is_deleted','!=',1)
                                        ->orderBy('created_at','desc')
                                        ->get();

		if($ticketinbox->count()>0)
		{

			$support = SupplierTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',1)->where('is_deleted','!=',1)->orderBy('created_at','desc')->get();
			$questionnaires = SupplierTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',2)->where('is_deleted','!=',1)->orderBy('created_at','desc')->get();
			$verification = SupplierTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',3)->where('is_deleted','!=',1)->orderBy('created_at','desc')->get();

			$openticket = SupplierTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('is_deleted','!=',1)->get();
			$closeticket = SupplierTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',0)->where('is_deleted','!=',1)->get();
			if($support->count()>0){
				$per_support  =  (($support->count())*100)/$ticketinbox->count();
			}else{ $per_support=0; }
			if($questionnaires->count()>0){
				$per_questionnaires  =  (($questionnaires->count())*100)/$ticketinbox->count();
			}else{ $per_questionnaires=0; }
			if($verification->count()>0){
				$per_verification  =  (($verification->count())*100)/$ticketinbox->count();
			}else{ $per_verification=0; }
			if($openticket->count()){
				$per_open = (($openticket->count())*100)/$ticketinbox->count();
			}else{ $per_open =0; }
			if($closeticket->count()){
				$per_close = (($closeticket->count())*100)/$ticketinbox->count();
			}else{ $per_close =0; }

		}
		else{
			$per_verification=0;
			$per_questionnaires=0;
			$per_support=0;
			$per_close =0;
			$per_open =0;
		}
		return view('client.message.tickets.inboxlist',compact('ticketinbox','per_support','per_questionnaires','per_verification','per_close','per_open'));
	}

	// message inbox details page
	public function ticketInboxDetails($id)
	{
		$user = Auth::user();
		$ticketinbox = SupplierTicket::where('is_deleted', 0)->find($id);
        if ($ticketinbox == null) {
            return redirect()->route('client.ticket.inbox')->with('success', '');
        }
		$ticketinbox->is_checked = 1;
		$ticketinbox->update();
		$replymessages = SupplierTicket::where('reply_on_ticket',$ticketinbox->ticket_number)->orderBy('created_at')->get();

		$location = SupplierLocation::findOrFail($ticketinbox->location_id);


		return view('client.message.tickets.inboxdetails',compact('ticketinbox','user','replymessages','location'));
	}

	// ticket reply on the inbox  messages
	public function ticketReplyOnInboxMessage(ReplyTicketRequest $request)
	{
		$userid = Auth::user()->id;
		$location = SupplierLocation::find($request->location);
		$supplier = Supplier::find($location->supplier_id);
		if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/document/client/tickets');
            $uploadedImage->move($destinationPath, $imageName);
			$attachdoc = TicketAttachDoc::create([
				'attach_doc_name'=>$imageName,
				'uploaded_by'=>1,
				'status'=>1,
			]);
			$docid = $attachdoc->id;
		}
		else{ $docid = null;}
		$clientticket = ClientTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$supplier->id,
			'ticket_number'=>uniqid(),
			'ticket_type'=>$request->ticket_type,
			'location_id'=>$request->location,
			'description'=>$request->description,
			'attach_doc_id'=>$docid,
			'reply_on_ticket'=>$request->ticekt_number,
			'answer_status'=>0,
			'status'=>1,
		]);
		return back()->with('success',trans('message.Ticket sent successfully..!!'));
	}

	// accept the location in inbox messages
	public function acceptLocation($lid)
   {
		$location  = SupplierLocation::find($lid);
		$location->status = 1;
		$location->update();
		$message = "Your Location Request is approved..!!";
		$accepttickets = ClientTicket::create([
				'sender_id'=>Auth::user()->id,
				'receiver_id'=>$location->supplier_id,
				'ticket_number'=>uniqid(),
				'ticket_type'=>3,
				'location_id'=>$location->id,
				'name'=>$location->locationcreator->username,
				'description'=>$message,
				'answer_status'=>0,
				'status'=>1,
			]);
			return back()->with('success','Location request Accepted Successfully');
   }


	public function ticketSentList()
	{
		$user = Auth::user()->id;
		$sentticket = ClientTicket::whereNull('reply_on_ticket')->where('sender_id',$user)->orderBy('created_at','desc')->get();
		if($sentticket->count()>0)
		{
			$support = ClientTicket::whereNull('reply_on_ticket')->where('sender_id',$user)->where('ticket_type',1)->orderBy('created_at','desc')->get();
			$questionnaires = ClientTicket::whereNull('reply_on_ticket')->where('sender_id',$user)->where('ticket_type',2)->orderBy('created_at','desc')->get();
			$verification = ClientTicket::whereNull('reply_on_ticket')->where('sender_id',$user)->where('ticket_type',3)->orderBy('created_at','desc')->get();
			$openticket = ClientTicket::whereNull('reply_on_ticket')->where('sender_id',$user)->where('status',1)->get();
			$closeticket = ClientTicket::whereNull('reply_on_ticket')->where('sender_id',$user)->where('status',0)->get();
			if($support->count()>0){
				$per_support  =  (($support->count())*100)/$sentticket->count();
			}else{ $per_support=0; }
			if($questionnaires->count()>0){
				$per_questionnaires  =  (($questionnaires->count())*100)/$sentticket->count();
			}else{ $per_questionnaires=0; }
			if($verification->count()>0){
				$per_verification  =  (($verification->count())*100)/$sentticket->count();
			}else{ $per_verification=0; }
			if($openticket->count()){
				$per_open = (($openticket->count())*100)/$sentticket->count();
			}else{ $per_open =0; }
			if($closeticket->count()){
				$per_close = (($closeticket->count())*100)/$sentticket->count();
			}else{ $per_close =0; }
		}
		else{
			$per_verification=0;
			$per_questionnaires=0;
			$per_support=0;
			$per_open =0;
			$per_close =0;
		}
		return view('client.message.tickets.sentlist',compact('sentticket','per_support','per_questionnaires','per_verification','per_open','per_close'));
	}
	public function ticketSentDeatils($id)
	{
		$user = Auth::user();
		$ticket = ClientTicket::find($id);
        $replymessages = SupplierTicket::where('reply_on_ticket',$ticket->ticket_number)->orderBy('created_at')->get();
        $replymessagesClient = ClientTicket::where('reply_on_ticket',$ticket->ticket_number)->orderBy('created_at')->get();

        $replies = $replymessages->merge($replymessagesClient)->sortBy('created_at');;

		return view('client.message.tickets.sentdetails',compact('user','ticket', 'replies'));
	}
	public function ticketReplyOnSentMessage(ReplyTicketRequest $request)
	{
		$userid = Auth::user()->id;
		$location = SupplierLocation::find($request->location);
		$supplier = Supplier::find($location->supplier_id);
		if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/document/client/tickets');
            $uploadedImage->move($destinationPath, $imageName);
			$attachdoc = TicketAttachDoc::create([
				'attach_doc_name'=>$imageName,
				'uploaded_by'=>1,
				'status'=>1,
			]);
			$docid = $attachdoc->id;
		}
		else{ $docid = null;}
		$clientticket = ClientTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$supplier->id,
			'ticket_number'=>uniqid(),
			'ticket_type'=>$request->ticket_type,
			'location_id'=>$request->location,
			'description'=>$request->description,
			'attach_doc_id'=>$docid,
			'reply_on_ticket'=>$request->ticekt_number,
			'answer_status'=>0,
			'status'=>1,
		]);
		return back()->with('success',trans('Ticket sent successfully..!!'));
	}


	// change the status of the sent mail
	public function changeTicketStatus($id)
	{
		$tickets = ClientTicket::find($id);
		if($tickets->status == 0)
		{
			$tickets->status = 1;
			$type ="success";
		}else{
			$tickets->status = 0;
			$type= "error";
		}
		$tickets->update();
		return back()->with($type,'Status updated successfully');
	}

    public function supplierChangeTicketStatus($id)
    {
        $tickets = SupplierTicket::find($id);
        if($tickets->status == 0)
        {
            $tickets->status = 1;
        }else{
            $tickets->status = 0;
        }
        $tickets->update();
        return back()->with('success', 'Status updated successfully');
    }

	public function newTicket()
	{
		$user = User::find(Auth::user()->id);
		$suppliers = Supplier::where('invited_by',$user->id)->get();
		$questionnaires = Questionnaire::where('created_by',$user->id)->where('status',1)->get();

		return view('client.message.tickets.new',compact('user','suppliers','questionnaires'));
	}
	public function storeTicket(TicketRequest $request)
	{
		$userid = Auth::user()->id;
		$location = SupplierLocation::where('id',$request->location)->first();
		if(!$location)
		{
			return back()->with('error','Please select the Location');
		}
		$supplier = Supplier::findOrFail($location->supplier_id);
		if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/document/client/tickets');
            $uploadedImage->move($destinationPath, $imageName);

			$attachdoc = TicketAttachDoc::create([
				'attach_doc_name'=>$imageName,
				'uploaded_by'=>1,
				'status'=>1,
			]);
			$docid = $attachdoc->id;
		}
		else{
			$docid = null;
		}

		$questionnaires = $request->questionnaire;
		if($questionnaires!= NUll)
		{
			foreach($questionnaires as $questionary)
			{
				$assignment = AssignQuestionary::where([
					'client_id'=>$userid,
					'supplier_id'=>$supplier->id,
					'location_id'=>$request->location,
					'questionnaire_id'=>$questionary,
				])->get()->count();
				if($assignment == 0)
				{
					$assignQuestionnaires = AssignQuestionary::create([
						'client_id'=>$userid,
						'supplier_id'=>$supplier->id,
						'location_id'=>$request->location,
						'questionnaire_id'=>$questionary,
						'answer_status'=>0,
					]);
					$permission = QuestionnairePermission::where([
						'user_id'=>$userid,
						'questionnaire_id'=>$questionary,
					])->get();
					if($permission->count() != 1)
					{
						$qpermission = QuestionnairePermission::create([
							'user_id'=>$userid,
							'questionnaire_id'=>$questionary,
						]);
					}
				}else{
					$qgroup = Questionnaire::findOrFail($questionary);
					return back()->with('error', $qgroup->name.'questionnaires are already assign.');
				}
			}
			$array = implode(",",$request->questionnaire);
        }
		else{
			$array = null;
		}
		$clientticket = ClientTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$supplier->id,
			'ticket_number'=>uniqid(),
			'ticket_type'=>$request->ticket_type,
			'location_id'=>$request->location,
			'name'=>$request->name,
			'questionnaire_id'=>$array,
			'description'=>$request->description,
			'attach_doc_id'=>$docid,
			'answer_status'=>0,
			'status'=>1,
		]);

		return back()->with('success',trans('message.Ticket sent successfully..!!'));
	}

	public function getLocationName($id)
	{
		$location =SupplierLocation::where('supplier_id',$id)->where('status',1)->get();
		if($location->count() > 0){
			$success =1;
		}else{
			$success=0;
		}
		return response()->json([
			'success'=>$success,
			'data'=>$location
		]);
	}

	public function sendTicket($id)
	{
		$sup = Supplier::findOrFail($id);
		$user = User::find(Auth::user()->id);
		$suppliers = Supplier::where('invited_by',$user->id)->get();
		$questionnaires = Questionnaire::where('created_by',$user->id)->get();
		return view('client.supplier.sendticket',compact('sup','user','suppliers','questionnaires'));
	}

	public function deleteInboxTickets(Request $request)
	{
		$strTickets = explode(',',$request->ticket_id);
		$tickets = SupplierTicket::whereIn('id',$strTickets)->update(['is_deleted'=>1]);
		return back()->with('success','data has been deleted');
	}
	public function deleteSentTickets	(Request $request)
	{
		$strTicket = explode(',',$request->ticket_id);
		$tickets = ClientTicket::whereIn('id',$strTicket)->delete();
		return back()->with('success','data has been deleted...!!');
	}
}
