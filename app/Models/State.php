<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "states";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name','country_id','status'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'state_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
