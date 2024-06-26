<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','primary_color','secondary_color','brand_logo',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
