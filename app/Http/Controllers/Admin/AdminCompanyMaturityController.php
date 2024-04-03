<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyMaturity;
use Auth;

class AdminCompanyMaturityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listMaturity()
    {
        $maturitylists = CompanyMaturity::get();
        return view('admin.company.maturity.list',compact('maturitylists'));
    }
    public function createMaturity()
    {
        return view('admin.company.maturity.create');   
    }
    public function storeMaturity(Request $request)
    {
        // dd($request);
        $comsector = CompanyMaturity::create([
            'level_name'=>$request->level_name,
            'description'=>$request->description,
            'status'=>1,
            'created_by'=>Auth::user()->id,
        ]);
        return redirect()->route('admin.maturity.list')->with('success','data saved successfully');
    }
    public function showMaturity($id)
    {
        return view('admin.company.maturity.show');
    }
    public function editMaturity($id)
    {
        $maturitylist = CompanyMaturity::find($id);
        return view('admin.company.maturity.edit',compact('maturitylist'));
    }
    public function updateMaturity(Request $request,$id)
    {
        $comsector = CompanyMaturity::find($id);
        $comsector->level_name=$request->level_name;
        $comsector->description= $request->description;
        $comsector->status=1;
        $comsector->created_by=Auth::user()->id;
        $comsector->update();
        return redirect()->route('admin.maturity.list')->with('success','data updated successfully');
    }
    public function deleteMaturity($id)
    {
        $comsector = CompanyMaturity::find($id);
        // dd($comsector);
        $comsector->delete();
        return redirect()->route('admin.maturity.list')->with('success','data deleted successfully');
    }
}