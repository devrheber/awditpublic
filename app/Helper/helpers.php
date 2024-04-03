<?php

if (! function_exists('status'))
{
    function status()
    {
        if(Session::has('status'))
        {
                echo("<div class ='alert alert-success'>".session('status')."</div>"); 
        }
        elseif(Session::has('success'))
        {
                echo("<div class ='alert alert-success'>".session('success')."</div>"); 
        }
        elseif(Session::has('positive'))
        {
                echo("<div class ='alert alert-success'>".session('positive')."</div>"); 
        }
        elseif(Session::has('warning'))
        {
                echo("<div class ='alert alert-danger'>".session('warning')."</div>"); 
        }
        elseif(Session::has('error'))
        {
                echo("<div class ='alert alert-danger'>".session('error')."</div>"); 
        }
        elseif(Session::has('negative'))
        {
                echo("<div class ='alert alert-danger'>".session('negative')."</div>"); 
        }
    }
}

if(! function_exists('randomChar'))
{
   function randomChar($len) {
        $length = (int)$len;
   	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',ceil($length/strlen($x)))),1,$length);
   }
}

if(!function_exists('getUser'))
{		
    function getUser()
    {
        return Auth::user();	
    }
}

if(!function_exists('checkAnswerExitOrNot'))
{
    function checkAnswerExitOrNot($sid,$qrid,$qid,$lid)
    {
        $ans = App\Models\Answer::where('respondent_id',$sid)
            ->where('questionnaire_id',$qrid)
            ->where('location_id',$lid)
            ->where('question_id',$qid)->get();
            if($ans->count() == 1){
                return true;
            }
        return false;
    }
}
if(!function_exists('getAnswerData'))
{
    function getAnswerData($sid,$qrid,$qid,$lid)
    {
        $ans = App\Models\Answer::where('respondent_id',$sid)
            ->where('questionnaire_id',$qrid)
            ->where('location_id',$lid)
            ->where('question_id',$qid)
            ->first();
        
        if($ans){
            return $ans;
        }return  false;
    }
}

if(!function_exists('getGroupName'))
{
    function getGroupName($key)
    {
        $name =App\Models\QuestionnaireGroup::findOrFail($key);
        return $name;
    }
}
if(!function_exists('getCountries'))
{
    function getCountries()
    {
        $countries = App\Models\Country::get();
        return $countries;
    }
}

if(!function_exists('getStates'))
{
    function getStates()
    {
        $states = App\Models\State::get();
        return $states;
    }
}

if(!function_exists('getCity'))
{
    function getCity()
    {
        $cities = App\Models\City::get();
        return $cities;
    }
}

if(!function_exists('getCategory'))
{
    function getCategory()
    {
        $category = App\Models\CompanySector::get();
        return $category;
    }
}

if(!function_exists('getSize'))
{
    function getSize()
    {
        $category = App\Models\CompanySize::get();
        return $category;
    }
}

if(!function_exists('getMaturity'))
{
    function getMaturity()
    {
        $category = App\Models\CompanyMaturity::get();
        return $category;
    }
}

if(!function_exists('getAllSuppliers'))
{
    function getAllSuppliers()
    {
        $suppliers = App\Models\Supplier::where('invited_by',getUser()->id)->where('first_time_login',1)->where('status',1)->get();
        return $suppliers;
    }
}
if(!function_exists('checkAnsStatus'))
{
    function checkAnsStatus($value)
    {
        if($value  == 1)
            return 'Yes';
        else
            return 'No';
    }	
}
if(!function_exists('ansApprovalStatus'))
{
    function ansApprovalStatus($value)
    {
        if($value == 1)
            return 'Yes';
        else
            return 'No';
    }
}

if(!function_exists('getBrandcolor'))
{
    function getBrandcolor()
    {
        $suppliers = App\Models\Brand::where('user_id',getUser()->id)->first();
        return $suppliers;
    }
}
?>		