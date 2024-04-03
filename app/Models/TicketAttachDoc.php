<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketAttachDoc extends Model
{

	use SoftDeletes;

    protected $table = "ticket_attach_doc";

    protected $primaryKey = 'id';

    protected $fillable = [
    'attach_doc_name','uploaded_by','status',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at	'];

    public function clientdoc()
    {
      return $this->hasOne(ClientTicket::Class,'attache_doc_id','id');
    }

    public function supplierdoc()
    {
      return $this->hasOne(SupplierTicket::Class,'attache_doc_id','id');
    }
}
