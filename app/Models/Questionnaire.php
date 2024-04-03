<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;

class Questionnaire extends Model
{
    use SoftDeletes;

    protected $table = "questionnaires";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name','questions','slug','status','created_by','imported_from',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    public function questionnarieGroup()
    {
        return $this->hasOne(QuestionnaireGroup::class,'id','group_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'id','questions');
    }
    public function questionsname($questions)
    {
        $myArray = explode(',', $questions);
        $data = Question::whereIn('id',$myArray)->get();
        return $data;
    }
    public function paginateQuestionData($questions,$no)
    {
        $myArray = explode(',', $questions);
        $data = Question::whereIn('id',$myArray)->paginate($no);
        return $data;
    }
    public function assignedClient()
	{
		return $this->HasOne(ClientTicket::class,'questionnaire_id','id');
	}

    public function answer()
    {
        return $this->hasOne(Answer::class,'questionnaire_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function quePermission()
   {
      return $this->hasOne(QuestionnairePermission::class,'questionnaire_id','id');
   }
}
