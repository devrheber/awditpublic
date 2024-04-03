<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanySector;
use Auth;

class AdminCompanySectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listSector()
    {
        $sectorlists = CompanySector::get();
        return view('admin.company.sector.list',compact('sectorlists'));
    }
    public function createSector()
    {
        return view('admin.company.sector.create');   
    }
    public function storeSector(Request $request)
    {
        // dd($request);
        $comsector = CompanySector::create([
            'title'=>$request->company_sector,
            'created_by'=>Auth::user()->id,
        ]);
        return redirect()->route('admin.sector.list')->with('success',trans('message.data saved successfully'));
    }
    public function showSector($id)
    {
        return view('admin.company.sector.show');
    }
    public function editSector($id)
    {
        $sectorlists = CompanySector::find($id);
        return view('admin.company.sector.edit',compact('sectorlists'));
    }
    public function updateSector(Request $request,$id)
    {
        $comsector = CompanySector::find($id);
        $comsector->title=$request->company_sector;
        $comsector->created_by=Auth::user()->id;
        $comsector->update();
        return redirect()->route('admin.sector.list')->with('success','data updated successfully');
    }
    public function deleteSector($id)
    {
        return redirect()->route()->wuth('success','data deleted successfully');
    }
}