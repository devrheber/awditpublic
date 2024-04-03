<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";

    protected $primaryKey = 'id';

    protected $fillable = [
        'sortname','name','phonecode','status'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'country_id','id');
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }
}
