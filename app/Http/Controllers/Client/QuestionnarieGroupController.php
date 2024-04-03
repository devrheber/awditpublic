<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\QuestionnaireGroupRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionnaireGroup;
use Auth;

class QuestionnarieGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $questionnaries  = QuestionnaireGroup::get();
        return view('client.questionnariegroup.list',compact('questionnaries'));
    }

    public function create()
    {
        return view('client.questionnariegroup.create');
    }

    public function store(QuestionnaireGroupRequest $request)
    {
        // dd($request);
        $questionnarie =QuestionnaireGroup::create([
            'group_name'=>$request->group_name,
            'group_slug'=>str_replace(' ','_',$request->group_name),
            'status'=>1,
            'created_by'=>Auth::user()->id,
        ]);
        return response()->json([
            'success'=>1,
            'message'=>'data updated successfully',
            'data'=>$questionnarie,
        ]); 
        // return back()->with('success','data updated successfully');
    }

    public function edit($id)
    {
        $questionnaries  = QuestionnaireGroup::find($id);
        return view('client.questionnariegroup.edit',compact('questionnaries'));
    }

    public function update(QuestionnaireGroupRequest $request,$id)
    {
        $questionnarie =QuestionnaireGroup::find($id);
        $questionnarie->group_name=$request->group_name;
        $questionnarie->group_slug=str_replace(' ','_',$request->group_name);
        $questionnarie->status=1;
        $questionnarie->update();
        return  back()->with('success','data updated successfully');
    }
    public function destroy($id)
    {
        // dd($id);
        $questionnries = QuestionnaireGroup::find($id);
        $questionnries->delete();
        return  back()->with('error','data deleted successfully');
    }

}