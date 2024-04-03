<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answers";

    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id','respondent_id','questionnaire_id','question_id','location_id',
        'answer_type','answer_attach_doc_id','observation',
        'status','answer_value','apply','is_approved','file_upload_id'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function  answerAttachDoc()
    {
        return $this->hasOne(AnswerAttachDoc::class,'id','answer_attach_doc_id');
    }
    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class,'id','questionnaire_id'); 
    }
    public function question()
    {
        return $this->hasOne(Question::class,'id','question_id');
    }
    public function responder()
    {
        return $this->hasOne(Supplier::class,'id','respondent_id');
    }

    public function filename()
    {
        return $this->hasOne(FileUpload::class,'id','file_upload_id');
    }
    public static function countPending($qqids,$supplier_id,$loc_id)
    {
        $data = Answer::where('questionnaire_id',$qqids)->where('respondent_id',$supplier_id)->where('location_id',$loc_id)->get();
       // print_r($data); die;
        return $data;
    }

    // relation ship
    public function clientObservation()
    {
        return $this->hasOne(ClientAnswerObservation::class,'id','client_observation');
    } 
}
