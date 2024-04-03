<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionnaireGroup extends Model
{
    use SoftDeletes;

    protected $table = "questionnaire_group";

    protected $primaryKey = 'id';

    protected $fillable = [
        'group_name','status','group_slug','created_by'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    public function question()
    {
        return $this->hasMany(Question::class,'id','group_id');
    }
}
