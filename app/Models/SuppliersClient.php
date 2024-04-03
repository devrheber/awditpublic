<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuppliersClient extends Model
{
   
    protected $table = "Suppliers_clients";

    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_id','client_id',
	];
	
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

}
