<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\ResetPasswordLinkNotification;
use App\Notifications\AdminVerifyEmail;

class Admin extends Authenticatable 
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name',
        'username',
        'email','job_title','image',
        // 'mobile_number',
        'password', 'verified','status',
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

    public function sendPasswordResetNotification($token)
    {
       
        $this->notify(new ResetPasswordLinkNotification($token,$this->email));
    }


    public function companysector()
    {
        return $this->hsOne(CompanySector::class,'created_by','id');
    }
}

