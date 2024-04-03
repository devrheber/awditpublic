<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissions extends Model
{
    //
    protected $table = "role_has_permissions";
    protected $fillable = ['role_id','permission_id'];
    protected $with=['role','permission'];

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function permission()
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }
} 

