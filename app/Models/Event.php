<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
{
   use SoftDeletes;
    protected $table = "events";

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_name','content','start_date','start_time','end_date','end_time',
		'duration','status','created_by','updated_by',
	];
	
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

}
