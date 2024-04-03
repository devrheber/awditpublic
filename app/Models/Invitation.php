<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{

    protected $table = "invitations";
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'sender_id','email','password','description',
        'supplier_name','supplier_cif','supplier_id',
        'invitation_token','send_date','status',
        'expired_date','registered_at',
        'invitation_time','second_send_date','second_expired_date','third_send_date','third_expired_date'


    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function invitedsupplier()
    {
        return $this->hasOne(Supplier::class,'invited_id','id');
    }
    public function invitedBy()
    {
        return $this->hasOne(User::class,'id','sender_id');
    }
}
