<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierProfile extends Model
{

    protected $table = "supplier_profile";

    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_id','first_name','last_name','job_title','image','status'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
