<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalHasPermissions extends Model
{
    //
    protected $table = "model_has_permissions";
    protected $fillable = ['permission_id','model_type','model_id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','model_id');
    }

    public function permission()
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }
}

