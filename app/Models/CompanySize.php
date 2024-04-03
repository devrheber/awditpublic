<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanySize extends Model
{
    use SoftDeletes;
    protected $table = "company_size";

    protected $primaryKey = 'id';

    protected $fillable = [
        'value','created_by','deleted_at','description'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function creator()
    {
        return $this->hasOne(Admin::class,'id','created_by');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_size_id','id');
    }
    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'size_id','id');
    }
}
