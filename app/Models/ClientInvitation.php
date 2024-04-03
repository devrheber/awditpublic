<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ClientInvitation extends Model
{
   
    protected $table = "client_invitations";

    protected $primaryKey = 'id';

    protected $fillable = [
        'sender_id','email','password','user_role_id','status','invitation_time',
        'send_date','expired_date'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];
 
    // relation ship methos

    //  who send the invitation
    public function invitedBy()
    {
        return $this->hasOne(User::class,'id','sender_id');
    }

    // which role
    public function userRole()
    {
        return $this->hasOne(Role::class,'id','user_role_id');
    }
}
