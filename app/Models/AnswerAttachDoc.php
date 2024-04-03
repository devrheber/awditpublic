<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AnswerAttachDoc extends Model
{
   
    protected $table = "answer_attach_doc";

    protected $primaryKey = 'id';

    protected $fillable = [
        'answer_id','attach_doc','status'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function answer()
    {
        return  $this->hasOne(Answer::class,'answer_attach_doc_id','id');
    }
}
