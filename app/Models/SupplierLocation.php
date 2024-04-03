<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use  App\Models\AssignQuestionary;
use Auth;

class SupplierLocation extends Model
{

    protected $table = "supplier_location";

    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_id','location_name','location_image',
        'country_id','state_id','city_id','address','postal_code',
        'category_id','size_id','maturity','security','status',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    /**
     * ----------------------------------------------------
     *  Relation ships
     * ----------------------------------------------------
     */
    public function locationcreator()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function state()
    {
        return $this->hasOne(State::class,'id','state_id');
    }
    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }
    public function category()
    {
        return $this->hasOne(CompanySector::class,'id','category_id');
    }
    public function size()
    {
        return $this->hasOne(CompanySize::class,'id','size_id');
    }
    public function locationmaturity()
    {
        return $this->hasOne(CompanyMaturity::class,'id','maturity');
    }
    public function clientTicketLocation()
    {
        return $this->hasOne(ClientTicket::class,'Location_id','id');
    }
    public function supplierTicketLocation()
    {
        return $this->hasOne(SupplierTicket::class,'Location_id','id');
    }

    public function assignquestionary()
    {
        return $this->hasMany(AssignQuestionary::class,'Location_id','id');
    }
    /**
     * ----------------------------------------------------
     *  Mutators
     * ----------------------------------------------------
     */
    public function getFullAddress()
    {
        return "{$this->address}, {$this->city->name}-{$this->postal_code}, {$this->state->name}, {$this->country->name} ";
    }

    public function  totalQuestionnaires($id,$sid)
    {
        $questionnaires = AssignQuestionary::where([
            'location_id'=>$id,
            'client_id'=>Auth::user()->id,
            'supplier_id'=>$sid,
        ])->get();
        return $questionnaires;
    }
}


        