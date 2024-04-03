<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanySize;
use Auth;

class AdminCompanySizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listSize()
    {
        $sizelist = CompanySize::get();
        return view('admin.company.size.list',compact('sizelist'));
    }

    public function createSize()
    {
        return view('admin.company.size.create');   
    }

    public function storeSize(Request $request)
    {
        // dd($request);
        $comsize = CompanySize::create([
            'value'=>$request->company_size,
            'description'=>$request->description,
            'created_by'=>Auth::user()->id,
        ]);
        return redirect()->route('admin.size.list')->with('success','data saved successfully');
    }
    
    public function showSize($id)
    {
        return view('admin.company.size.show');
    }

    public function editSize($id)
    {
        $sizelist = CompanySize::find($id);
        return view('admin.company.size.edit',compact('sizelist'));
    }

    public function updateSize(Request $request,$id)
    {
        $comsize = CompanySize::find($id);
        $comsize->value=$request->company_size;
        $comsize->description = $request->description;
        $comsize->created_by=Auth::user()->id;
        $comsize->update();
        return redirect()->route('admin.size.list')->with('success','data updated successfully');
    }

    public function deleteSize($id)
    {
        return redirect()->route()->wuth('success','data deleted successfully');
    }
}