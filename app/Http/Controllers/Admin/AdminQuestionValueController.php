<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionValue;
use App\Http\Requests\Admin\AdminQuestionValueRequest;
use Auth;

class AdminQuestionValueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
     
    public function index()
    {
        $questionvalues = QuestionValue::get();
        return view('admin.question.value.list',compact('questionvalues'));
    }
    public function create()
    {
        return view('admin.question.value.create');
    }
    public function store(AdminQuestionValueRequest $request)
    {   
        $status=0;
        if($request->status == "on")
        { 
            $status = 1;
        }
        $questionvalue = QuestionValue::create([
            'value'=>$request->value,
            'description'=>$request->description,
            'status'=>$status,
        ]);  
        return back()->with('success',trans('message.Data saved successfully'));
    }
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        $questionvalue = QuestionValue::find($id);
        return view('admin.question.value.edit',compact('questionvalue'));
    }
    public function update(Request $request,$id)
    {
        $status=0;
        if($request->status == "on")
        { 
            $status = 1;
        }
        $questionvalue = QuestionValue::find($id);
        $questionvalue->value =$request->value;
        $questionvalue->description = $request->description;
        $questionvalue->status=$status;
        $questionvalue->update();
        return back()->with('success',trans('message.Data updated successfully'));
    }
    public function destroy($id)
    {
        $questionvalue = QuestionValue::find($id);
        dd($questionvalue);
    }
    public function changStatus($id)
    {
        $changestatus= QuestionValue::find($id);
        dd($changestatus);
    }
}