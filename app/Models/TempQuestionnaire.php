<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempQuestionnaire extends Model
{
    use SoftDeletes;

    protected $table = "temp_questionnaires";

    protected $primaryKey = 'id';

    protected $fillable = [
        'temp_code','question_id','created_by',
	];
	
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
       return  $this->hasOne(Question::class,'id','question_id');
    }
    public function requirements()
    {
        return $this->hasMany(QuestionRequirement::class,'question_id','id');
    }
}
