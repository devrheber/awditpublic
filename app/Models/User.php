<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_role',
        'username',
        'email',
        'job_title',
        'image',
        'phone_number',
        'password','verified','first_time_login','role_assigner','status',
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

    protected $appends = ['full_name','full_address'];


    public function verifyUser()
    {
      return $this->hasOne(VerifyUser::class);
    }
    public function company()
    {
        return $this->hasOne(Company::class,'created_by','id');
    }

    public function usersupplier()
    {
        return $this->hasMany(Supplier::class,'invited_by','id');
    }
    public function clientTickets()
    {
        return $this->hasMnay(clientTicket::class,'sender_id','id');
    }

    public function toInvite()
    {
        return $this->hasOne(Invitation::class,'sendder_id','id');
    }


    public function roleAssigner()
    {
        return $this->hasOne(User::class,'id','role_assigner');
    }
    public function userRole()
    {
        return $this->hasOne(Role::class,'id','user_role');
    }
    /**
     * ---------------------------
     * Accessor
     * --------------------------
     */
    public function getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullAddressAttribute()
    {
        return null;
    }
}
