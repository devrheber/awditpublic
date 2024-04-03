<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = "questions";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name','observation','based_on','objective','questionnaires_id','group_id',
        'position','value_id','apply','status','created_by'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];
    
    public function questionrequirement()
    {
        return $this->hasMany(QuestionRequirement::class,'question_id','id');
    }   
    public function questionvalue()
    {
        return $this->hasOne(QuestionValue::class,'id','value_id');
    }

    public function questionGroup()
    {
        return $this->hasOne(QuestionnaireGroup::class,'id','group_id');
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class,'id','questions');
    }
    public static function questiondetails($id)
    {
        // dd($id);
        $myArray = explode(',', $id);
        // dd($myArray);
        $data = Question::whereIn('id',$myArray)->get();
        return $data;
    }
    public function tempquestionnaire()
    {
        return $this->hasOne(TempQuestionnaire::class,'question_id','id');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class,'question_id','id');
    }
}

