<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyMaturity extends Model
{
    use SoftDeletes;    
    protected $table = "maturity_levels";

    protected $primaryKey = 'id';

    protected $fillable = [
        'level_name','description','created_by','status',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class,'maturity_level_id','id');
    }   
    
    public function creator()
    {
        return $this->hasOne(Admin::class,'id','created_by');
    }

    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'maturity','id');
    }
}
