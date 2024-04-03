<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientTicket extends Model
{

	use SoftDeletes;

    protected $table = "client_send_tickets";

    protected $primaryKey = 'id';

    protected $fillable = [
		'sender_id','ticket_number',
		'ticket_type','description',
		'reply_on_ticket','receiver_id','name','is_checked',
		'attach_doc_id','location_id','status','questionnaire_id','answer_status','is_deleted'
    ];
	protected $guarded = ['id', 'created_at', 'updated_at','deleted_at	'];
	
	public function ticketsender()
	{
		return $this->hasOne(User::class,'id','sender_id');
	}

	public function ticketreceiver()
	{
		return $this->hasOne(Supplier::class,'id','receiver_id');
	}

	public function attachDoc()
    {
      return $this->hasOne(TicketAttachDoc::class,'id','attach_doc_id');
	}
	
	public function location()
    {
      return $this->hasOne(SupplierLocation::class,'id','location_id');
    }
	public function questionnaire()
	{
		return $this->hasOne(Questionnaire::class,'id','questionnaire_id');
	}

	public function  questionnaireData($qdata)
	{
		$myArray = explode(',', $qdata);
        // dd($myArray);
        $data = Questionnaire::whereIn('id',$myArray)->get();
        return $data;
	}
	public function replyToSupplier()
	{
		$this->hasOne(Supplier::class,'ticket_number','ticket_number');
	}
}
