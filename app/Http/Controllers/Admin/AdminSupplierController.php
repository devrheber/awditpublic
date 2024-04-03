<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Auth;

class AdminSupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showSupplierList()
    {   
        $userlists = Supplier::get();
        return view('admin.supplier.list',compact('userlists'));
    }
    
    public function changeStatus($status,$id)
    {
        // dd($id);
        $userlists = Supplier::find($id);
        if($status == "block")
        {
            $userlists->status= 0 ;
            $userlists->save();
            $message = 'Client has been blocked successfully';
        }
        elseif($status=="unblock"){     
            $userlists->status= 1;
            $userlists->save();
            $message = 'Client has been unblocked successfully';
        }
        return redirect()->route('admin.supplier.list')->with('success',$message);
    }
}