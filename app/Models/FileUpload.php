<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model
{
   use SoftDeletes;
    protected $table = "file_upload";

    protected $primaryKey = 'id';

    protected $fillable = [
        'filename','observation','foldername','client_id','supplier_id','original_file_name','uploaded_by'
	];
	
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

}
