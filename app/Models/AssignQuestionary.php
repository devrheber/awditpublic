<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;
use App\Models\Questionnaire;

class AssignQuestionary  extends Model
    {
        use SoftDeletes;

    protected $table = "assign_questionnaires";

    protected $primaryKey = 'id';

    protected $fillable = [ 
        'client_id','supplier_id',
        'questionnaire_id','location_id',
        'answer_status','observation',
        'is_checked','is_approved',
        'is_applied','questionnaire_value','approved_date'
    ];
    
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    public function  questionnaireData($qdata)
    {
        $myArray = explode(',', $qdata);
    // dd($myArray);
        $data = Questionnaire::whereIn('id',$myArray)->get();
        return $data;
    }
    public function sender()
    {
        return $this->hasOne(User::class,'id','client_id');
    }

    public function receiver()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function location()
    {
        return $this->hasOne(SupplierLocation::class,'id','location_id');
    }
    
    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class,'id','questionnaire_id');
    }

    public static function QuestionData($qid)
    {
        $questionary =Questionnaire::findOrFaiil($qid);
        $myArray = explode(',', $questionary->question_id);
        $data = Question::whereIn('id',$myArray)->get();
        return $data;
    }
}
