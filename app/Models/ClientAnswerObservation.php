<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAnswerObservation extends Model
{
    //
    protected $table = 'client_answer_observation';

    protected $fillable = ['file_name','observation','client_id','supplier_id','questionnaire_id','question_id','answer_id'];

    // relationship
    public function answer()
    {
        return $this->hasOne(Answer::class,'client_observation','id');
    }
    
    public function  client()
    {
       return $this->hasOne(User::class,'id','client_id');
    }
 
    public function  supplier()
    {
       return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function questionnaire()
    {
        return $this->hasOne(questionnaire::class,'id','questionnaire_id');
    }
    
    public function question()
    {
        return $this->hasOne(question::class,'id','question_id');
    }
}
