<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientObservation extends Model                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
{
   use SoftDeletes;
    protected $table = "client_observations";

    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id','supplier_id','observation','status'
	];       
	
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

   public function  client()
   {
      return $this->hasOne(User::class,'id','client_id');
   }

   public function  supplier()
   {
      return $this->hasOne(Supplier::class,'id','supplier_id');
   }
}
