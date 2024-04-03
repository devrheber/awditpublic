<?php

namespace App\Models;

use App\Models\CompanySector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $table = "companies";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name','cif','contrty_id','state_id','city_id','address','postalcode',
        'company_sector_id','company_size_id','maturity_level_id',
        'security_department','created_by','status'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    protected $appends = ['full_address'];
    /**
     * --------------------------------------------------------
     * Relation ship methods
     * --------------------------------------------------------
     */
    public function companycreator()
    {
        return $this->hasOne(User::class,'created_by','id');
    }
    public function companySector()
    {
        return $this->hasMany(CompanySector::class,'id','company_sector_id');
    }
    public function companySize()
    {
        return $this->hasOne(CompanySize::class,'id','company_size_id');
    }
    public function country()
    {
        return $this->hasOne(Country::class,'id','contrty_id');
    }
    public function state()
    {
        return $this->hasOne(State::class,'id','state_id');
    }
    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }
    public function companyMaturity()
    {
        return $this->hasOne(CompanyMaturity::class,'id','maturity_level_id');
    }


    // company sector  name
    public function sectorName($sector)
    {
        $myArray = explode(',', $sector);
        // dd($myArray);
        $data = CompanySector::whereIn('id',$myArray)->get();
        return $data;
    }
    /**
     * --------------------------------------------------------
     * mutators
     * --------------------------------------------------------
     */
    // public function getFullAddressAttribute()
    // {
    //     return "{$this->address}, {$this->state->name}, {$this->city->name}-{$this->postal_code}";
    // }
    public function sector()
{
    return $this->belongsTo(CompanySector::class, 'company_sector_id');
}

}
