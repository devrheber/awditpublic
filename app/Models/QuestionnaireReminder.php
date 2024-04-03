<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AssignQuestionary;

class QuestionnaireReminder extends Model
{
    use SoftDeletes;

    protected $table = "questionnaire_reminder";

    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id','supplier_id','location_id','status','questionnaire_id'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

   // public function ($sid,$lid,$qid)
   // {
   //    $questionnaire =AssignQuestionary::where([
   //       'client_id',
   //       'supplier_id',
   //       'location_id',
   //       'questionnaire_id',
   //    ])->get();
   //    return $questionnaire;
   // }
    
    public function client()
    {
       return $this->hasOne(User::class,'id','client_id');
    }
    public function supplier()
    {
       return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public function location()
    {
       return $this->hasOne(SupplierLocation::class,'id','location_id');
    }
    public function questionary()
    {
       return $this->hasOne(Questionnaire::class,'id','questionnaire_id');
    }
}
