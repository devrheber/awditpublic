<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class QuestionnairePermission extends Model
{

   protected $table = "questionnaire_permissions";

   protected $primaryKey = 'id';

   protected $fillable = [
      'user_id','questionnaire_id','status','q_status','q_level','q_apply_or_not','q_results',
      'q_questions','q_answers','q_docs','q_access_doc','q_other_file','q_add_edit_folder',
      'q_add_file','q_download_fie','q_observation',
   ];
   
   protected $guarded = ['id', 'created_at', 'updated_at'];

   public function questionnaire()
   {
      return $this->hasOne(Questionnaire::class,'id','questionnaire_id');
   }
   
   public function user()
   {
      return $this->hasOne(User::class,'id','user_id');
   }

   
}
