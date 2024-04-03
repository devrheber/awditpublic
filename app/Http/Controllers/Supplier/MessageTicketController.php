<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\TicketRequest;
use App\Http\Requests\Supplier\ReplyTicketRequest;
use App\Models\Supplier;
use App\Models\SupplierLocation;
use App\Models\ClientTicket;
use App\Models\SupplierTicket;
use App\Models\TicketAttachDoc;
use App\Models\User;
use Auth;

class MessageTicketController extends Controller
{
	// middleware of thhis guard
	public function __construct()
    {
        $this->middleware('auth:supplier');
	}

	// message index page
	public function ticketInbox()
	{
		$user = Auth::user()->id;
		$ticketinbox = ClientTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('is_deleted','!=',1)->orderBy('created_at','desc')->get();
		if($ticketinbox->count()>0)
		{

			$support = ClientTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',1)->orderBy('created_at','desc')->get();
			$questionnaires = ClientTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',2)->orderBy('created_at','desc')->get();
			$verification = ClientTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',3)->orderBy('created_at','desc')->get();

			$openticket = ClientTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',1)->get();
			$closeticket = ClientTicket::where('receiver_id',$user)->whereNull('reply_on_ticket')->where('status',0)->get();
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
		return view('supplier.message.ticket.inboxlist',compact('ticketinbox','per_support','per_questionnaires','per_verification','per_open','per_close'));
	}

	// message inbox details
	public function ticketInboxDetails($id)
	{
		$user = Auth::user();
		$ticket = ClientTicket::find($id);
        $replymessages = SupplierTicket::where('reply_on_ticket',$ticket->ticket_number)->orderBy('created_at')->get();
        $replymessagesClient = ClientTicket::where('reply_on_ticket',$ticket->ticket_number)->orderBy('created_at')->get();

        $replies = $replymessages->merge($replymessagesClient)->sortBy('created_at');

		return view('supplier.message.ticket.inboxdetails',compact('user','ticket', 'replies'));
	}

	// reply on the received ticket in the inbox
	public function ticketReplyOnInboxMessage(ReplyTicketRequest $request)
	{
		// dd($request);
		$user = Auth::user();
		$location = SupplierLocation::find($request->location);
		$client = User::find($user->invited_by);
		if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$user->id.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
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
		$clientticket = SupplierTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$client->id,
			'ticket_number'=>uniqid(),
			'ticket_type'=>$request->ticket_type,
			'location_id'=>$request->location,
			'description'=>$request->description,
			'attach_doc_id'=>$docid,
			'reply_on_ticket'=>$request->ticekt_number,
			'status'=>1,
		]);
		return back()->with('success',trans('Ticket sent successfully..!!'));
	}



	// message sent list
	public function sentTicketList()
	{
		$user = Auth::user()->id;
		$tickets = SupplierTicket::where('sender_id',$user)->whereNull('reply_on_ticket')->orderBy('created_at','desc')->get();
		if($tickets->count()>0)
		{

			$support = SupplierTicket::where('sender_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',1)->orderBy('created_at','desc')->get();
			$questionnaires = SupplierTicket::where('sender_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',2)->orderBy('created_at','desc')->get();
			$verification = SupplierTicket::where('sender_id',$user)->whereNull('reply_on_ticket')->where('status',1)->where('ticket_type',3)->orderBy('created_at','desc')->get();

			$openticket = SupplierTicket::where('sender_id',$user)->whereNull('reply_on_ticket')->where('status',1)->get();
			$closeticket = SupplierTicket::where('sender_id',$user)->whereNull('reply_on_ticket')->where('status',0)->get();
			if($support->count()>0){
				$per_support  =  (($support->count())*100)/$tickets->count();
			}else{ $per_support=0; }
			if($questionnaires->count()>0){
				$per_questionnaires  =  (($questionnaires->count())*100)/$tickets->count();
			}else{ $per_questionnaires=0; }
			if($verification->count()>0){
				$per_verification  =  (($verification->count())*100)/$tickets->count();
			}else{ $per_verification=0; }
			if($openticket->count()){
				$per_open = (($openticket->count())*100)/$tickets->count();
			}else{ $per_open =0; }
			if($closeticket->count()){
				$per_close = (($closeticket->count())*100)/$tickets->count();
			}else{ $per_close =0; }

		}
		else{
			$per_verification=0;
			$per_questionnaires=0;
			$per_support=0;
			$per_close =0;
			$per_open =0;
		}
		return view('supplier.message.ticket.sentlist',compact('tickets','per_support','per_questionnaires','per_verification','per_open','per_close'));
	}

	// message sent details
	public function ticketSentDeatils($id)
	{
		$user = Auth::user();
		$ticket = SupplierTicket::find($id);
		return view('supplier.message.ticket.sentdetail',compact('user','ticket'));
	}

	// reply ticket on the sent message
	public function ticketReplyOnSentMessage(ReplyTicketRequest $request)
	{
		// dd($request);
		$user = Auth::user();
		$location = SupplierLocation::find($request->location);
		$client = User::find($user->invited_by);
		if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$user->id.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
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
		$clientticket = SupplierTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$client->id,
			'ticket_number'=>uniqid(),
			'ticket_type'=>$request->ticket_type,
			'location_id'=>$request->location,
			'description'=>$request->description,
			'attach_doc_id'=>$docid,
			'reply_on_ticket'=>$request->ticekt_number,
			'status'=>1,
		]);
		return back()->with('success',trans('Ticket sent successfully..!!'));
	}

	// 	change  the status  of the sent message
	public function changeTicketStatus($id)
	{
		$tickets = SupplierTicket::find($id);
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

	// message new tickees send to supplier
	public function newTicket()
	{
		$user = Supplier::find(Auth::user()->id);
		$locations = SupplierLocation::where('supplier_id',$user->id)->where('status',1)->get();

		return view('supplier.message.ticket.new',compact('user','locations'));
	}

	// message new tickets store into the database
	public function storeTicket(TicketRequest $request)
	{
		// dd($request);
		$userid = Auth::user()->id;
		$location = SupplierLocation::find($request->location);
		$supplier = Supplier::find($location->supplier_id);
		if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/document/supplier/tickets');
			$uploadedImage->move($destinationPath, $imageName);

			$attachdoc = TicketAttachDoc::create([
				'attach_doc_name'=>$imageName,
				'uploaded_by'=>2,
				'status'=>1,
			]);
			$docid = $attachdoc->id;
		}
		else{ $docid = null;}
		$clientticket = SupplierTicket::create([
			'sender_id'=>Auth::user()->id,
			'receiver_id'=>$supplier->invited_by,
			'ticket_number'=>uniqid(),
			'ticket_type'=>$request->ticket_type,
			'location_id'=>$request->location,
			'name'=>$request->name,
			'description'=>$request->description,
			'attach_doc_id'=>$docid,
			'status'=>1,
		]);
		return redirect()->route('supplier.ticket.sentlist')->with('success',trans('message.Ticket sent successfully..!!'));
	}
	public function deleteSentTicket(Request $request)
	{
		$strTicket = explode(',',$request->ticket_id);
		$tickets = SupplierTicket::whereIn('id',$strTicket)->delete();
		return back()->with('success','data has been deleted...!!');
	}

	public function deleteInboxTicket(Request $request)
	{
		$strTickets = explode(',',$request->ticket_id);
		$tickets = ClientTicket::whereIn('id',$strTickets)->update(['is_deleted'=>1]);
		return back()->with('success','data has been deleted');
	}



}
