<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name','state_id','status',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'city_id','id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
