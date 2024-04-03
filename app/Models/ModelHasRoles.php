<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ModelHasRoles extends Model
{
    //
    protected $table = "model_has_roles";
    protected $fillable = ['role_id','model_type','model_id'];


    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','model_id');
    }
}
