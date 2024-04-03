<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = "user_profile";

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','first_name','last_name','job_title','image','status'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
