<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\SupplierResetPasswordLinkNotification;

class Supplier extends Authenticatable
{
    use  Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name',
        'username',
        'email','job_title','image','verified',
        'phone_number',
        'invited_by','invited_id',
        'password','status','first_time_login','blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at','deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    *|--------------------------------------------------------------
    *| nitification  mail seding function
    *|--------------------------------------------------------------
    */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SupplierResetPasswordLinkNotification($token,$this->email));
    }

    /*
    *|--------------------------------------------------------------
    *| Relational function
    *|--------------------------------------------------------------
    */
    public function location()
    {
        return $this->hasMany(SupplierLocation::class,'supplier_id','id');
    }

    public function verifysupplier()
    {
      return $this->hasOne(VerifySupplier::class);
    }

    public function suppliercreator()
    {
        return $this->hasOne(User::class,'id','invited_by');
    }

    public function userDelete()
    {
        return $this->belongsTo(User::class, 'user_delete');
    }

    public function invitation()
    {
        return $this->hasOne(Invitation::class,'id','invited_id');
    }

    public function senttickets()
    {
        return $this->hasMany(SupplierTicket::class,'sender_id','id');
    }
    public function answer()
    {
        return $this->hasOne(Answer::class,'respondent_id','id');
    }
    /*
    *|--------------------------------------------------------------
    *| Mutators
    *|--------------------------------------------------------------
    */
    public function getSupplierFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}
