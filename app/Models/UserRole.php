<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table = "roles";

    protected $primaryKey = 'id';

    protected $fillable = ['name','description','status'];

    protected $guarded = ['id', 'created_at', 'updated_at'];


}
