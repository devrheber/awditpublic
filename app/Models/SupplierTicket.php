<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierTicket extends Model
{
	use SoftDeletes;

    protected $table = "supplier_send_tickets";

    protected $primaryKey = 'id';

    protected $fillable = [
    'sender_id','ticket_number','name',
    'description','uploaded_by',
		'ticket_type','reply_on_ticket','is_checked',
		'attach_doc_id','location_id','receiver_id','status','is_deleted'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at	'];

    public function ticketsender()
    {
      return $this->hasOne(Supplier::class,'id','sender_id');
    }
    public function ticketreceiver()
    {
      return $this->hasOne(User::class,'id','receiver_id');
    }

    public function attachDoc()
    {
      return $this->hasOne(TicketAttachDoc::class,'id','attach_doc_id');
    }

    public function location()
    {
      return $this->hasOne(SupplierLocation::class,'id','location_id');
    }
    public function replyToClient()
    {
        $this->hasOne(Supplier::class,'ticket_number','ticket_number');
  	}
}
