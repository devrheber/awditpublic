<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionValue extends Model
{

    protected $table = "questions_value";

    protected $primaryKey = 'id';

    protected $fillable = [
        'value','status','description',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->hasOne(Question::class,'value_id','id');
    }
}
