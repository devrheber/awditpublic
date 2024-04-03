<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionRequirement extends Model
{

    protected $table = "questions_requirements";

    protected $primaryKey = 'id';

    protected $fillable = [
        'question_id','requirements','status'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(Question::class,'id','question_id');
    }
    public function  tempquestion()
    {
        return $this->belongsTo(TempQuestionnaire::class,'id','question_id');
    }

}

