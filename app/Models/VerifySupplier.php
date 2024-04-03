<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifySupplier extends Model
{
    protected $table = "verify_suppliers";

    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_id','token',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    
}
