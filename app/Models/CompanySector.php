<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanySector extends Model
{
    use SoftDeletes;

    protected $table = "company_sectors";

    protected $primaryKey = 'id';

    protected $fillable = [
        'title','created_by','deleted_at','status'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function creator()
    {
        return $this->hasOne(Admin::class,'id','created_by');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_sector_id','id');
    }
    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'category_id','id');
    }

    public function locations()
    {
        return $this->hasMany(SupplierLocation::class,'category_id','id');
    }
}
