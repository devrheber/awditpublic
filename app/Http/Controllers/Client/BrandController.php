<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\BrandRequest;
use App\Models\Brand;
use Auth;

class BrandController extends Controller
{
    public function addBrand()
    {
        // dd('Add Brand');
        return view('client.brand.addbrand');
    }

    public function storeBrand(BrandRequest $request)
    {
        $userid =Auth::user()->id;
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/client/brand');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }
        else{
            $imageName = $client->image;
        }
        $brand = Brand::create([
            'user_id'=>Auth::user()->id,
            'primary_color'=>$request->pcolor,
            'secondary_color'=>$request->scolor,
            'brand_logo'=>$imageName,
        ]);
        return back()->with('status','Brand data saved successfully');
    }

    public function editBrand()
    {       
        $userid =Auth::user()->id;
        $brand = Brand::where('user_id',$userid)->first();
        return view('client.brand.edit',compact('brand'));
    }
    public function updateBrand(Request $request)
    {
        $userid =Auth::user()->id;
        $brand = Brand::where('user_id',$userid)->first();
        
        if (isset($request->image)) {
            $uploadedImage =$request->image;
            $imageName = 'IMG'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/client/brand');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }
        else{
            $imageName = $brand->brand_logo;
        }
        $brand->primary_color=$request->pcolor;
        $brand->secondary_color=$request->scolor;
        $brand->brand_logo=$imageName;
        $brand->update();
        return redirect()->route('client.company.edit')->with('status','Brand data saved successfully');
    }
}