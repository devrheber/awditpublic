<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Invitation;
use App\Models\SuppliersClient;
use Carbon\Carbon;
use App\Jobs\ResendSupplierInvitation;
use App\Http\Requests\Client\InviteSupplierRequest;
use Auth;
use Mail;
use Hash;
use App\Mail\NewSupplierInvitationMail;
use File;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use App\Models\FileUpload;
class MessageInvitationController extends Controller
{

    public function allDownload(){
        return response()->download('C:\xampp\htdocs\projects\SEAT\public\11 diec.zip');
//        $zip = new ZipArchive;
//
//        $fileName = 'my-images.zip';
//
//        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
//
//            $files = File::files(public_path('images'));
//
//            foreach ($files as $key => $value) {
//                $relativeNameInZipFile = basename($value);
//                $zip->addFile($value, $relativeNameInZipFile);
//            }
//
//            $zip->close();
//        }
//
//        return response()->download(public_path($fileName));
    }


    // middleware of thhis guard
    public function __construct()
    {
      //   $this->middleware('auth')->except('acceptInvitation');
    }

    // message index page
    public function invitationInbox()
    {
        $suppliers = Invitation::where('sender_id',Auth::user()->id)->orderby('created_at','desc')->get();
        $first_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->where('invitation_time',1)->get();
        $second_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->where('invitation_time',2)->get();
        $third_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->where('invitation_time',3)->get();
        $accepted_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->get();
        $expired_invitation =  Invitation::where('sender_id',Auth::user()->id)->where('status',3)->get();
        if($suppliers->count()>0)
        {
            $accepted = (($accepted_invitation->count()*100)/($suppliers->count()));
            $first = (($first_invitation->count()*100))/($suppliers->count());
            $second = (($second_invitation->count()*100))/($suppliers->count());
            $third = (($third_invitation->count()*100))/($suppliers->count());
            $expired = (($expired_invitation->count()*100)/($suppliers->count()));
        }
        else{

            $accepted =0;
            $first = 0;
            $second = 0;
            $third =0;
            $expired=0;

        }
        return view('client.message.invitation.sentlist',compact('suppliers','first','second','third','accepted','expired'));
    }

    public function invitationSentDetail($id)
    {
        $suppliers = Invitation::find($id);
        return view('client.message.invitation.sentdetails',compact('suppliers'));
    }

    public function newInvitation()
    {
        $user =  User::find(Auth::user()->id);
        $suppliers = Supplier::where('invited_by',$user->id)->get();
        return view('client.message.invitation.sent',compact('user', 'suppliers'));
    }

    public function  invitation(InviteSupplierRequest $request)
    {
        $supplier = Supplier::where('email',$request->emailaddnewsupplier)->get()->first();
        if(!$supplier) {
            $name =  substr(str_replace(' ', '_', $request->name), 0, 5);
            $password = randomChar(8);
            $invitation = Invitation::create([
                    'sender_id'=>Auth::user()->id,
                    'email'=>$request->emailaddnewsupplier,
                    'password'=> $password,
                    'supplier_id'=>$request->idaddnewsupplier,
                    'supplier_name'=>$request->nameaddnewsupplier,
                    'supplier_cif'=>$request->cifaddnewsupplier,
                    'description'=>$request->description,
                    'status'=>0,
                    'invitation_time'=>1,
                    'send_date'=> Carbon::now(),
                    'expired_date'=> Carbon::now()->addWeekdays(15),
            ]);

            Mail::to($invitation->email)->send(new NewSupplierInvitationMail($invitation));
            return redirect()->route('client.invitation.sent')->with('success',trans('message.Invitation mail has been sent successfully'));
        } else {
            $suppliersclient =  SuppliersClient::where('client_id',Auth::user()->id)->where('supplier_id',$supplier->id)->get();
            if($suppliersclient->count()>0) {
                return back()->with('error','This supplier is already existing in your suppler list');
            } else {
                $suppliersclient =  SuppliersClient::create([
                        'client_id'=>Auth::user()->id,
                        'supplier_id'=>$supplier->id,
                ]);
                return redirect()->route('client.invitation.sent')->with('success','Invitation mail has been sent successfully');
            }
        }
    }

    public function reInvitation($id)
    {
        $invitation = Invitation::find($id);
        // dd($invitation);
        $invitation->invitation_time += 1;
        $invitation->second_send_date= Carbon::now();
        $invitation->second_expired_date=Carbon::now()->addWeekdays(15);
        $invitation->update();
        Mail::to($invitation->email)->send(new NewSupplierInvitationMail($invitation));
    }

    public function inviteToExpired(Request $request)
    {
        $suppliers = explode(',',$request->supp_id);
        foreach($suppliers as $supplier)
        {
                $invitation = Invitation::find($supplier);
                $invitation->invitation_time += 1;
                $invitation->second_send_date= Carbon::now();
                $invitation->second_expired_date=Carbon::now()->addWeekdays(15);
                $invitation->update();
                // Mail::to($invitation->email)->send(new NewSupplierInvitationMail($invitation));
                // $this->dispatch($emailJobs);
        }
        $job = ResendSupplierInvitation::dispatch($suppliers);
        return back()->with('success','Your email has been sent successfully');
    }
    public function acceptInvitation($id)
    {
        $invitation = Invitation::find($id);
        $exitsupplier = Supplier::where('email',$invitation->email)->first();
        if($exitsupplier)
        {
                $this->supplierclient($exitsupplier->id,$invitation->sender_id);
        }
        else{
                $supplier = Supplier::create([
                        'username'=>$invitation->supplier_name,
                        'email'=>$invitation->email,
                        'password'=>Hash::make($invitation->password),
                        'invited_by'=>$invitation->sender_id,
                        'invited_id'=>$invitation->id,
                        'status'=>1,
                        'blocked'=>0,
                        'verified'=>0,
                        'first_time_login'=>0,
                ]);
                $this->supplierclient($supplier->id,$invitation->sender_id);
        }

        $today = Carbon::now();
        if ($invitation->status == 0 || $invitation->status == 2){
                if($invitation->invitation_time ==1)
                {
                        if($today<=$invitation->expired_date)
                        {
                                $invitation->status =1;
                                $invitation->save();
                        }
                }
                elseif($invitation->invitation_time == 2)
                {
                        if($today<=$invitation->second_expired_date)
                        {
                                $invitation->status =1;
                                $invitation->save();
                        }
                }
                elseif($invitation->invitation_time == 3)
                {
                        if($today<=$invitation->third_expired_date)
                        {
                                $invitation->status =1;
                                $invitation->save();
                        }
                }
        }

        return redirect()->route('supplier.login.form');
    }

    public function supplierclient($supplier_id,$client_id)
    {
        $supplierclient = SuppliersClient::create([
                'supplier_id'=>$supplier_id,
                'client_id'=>$client_id,
        ]);
    }

    public function invitationExpired()
    {
        $suppliers = Invitation::where('sender_id',Auth::user()->id)->where('status',3)->orderby('created_at','desc')->get();
        $timeoutSuppliers = Invitation::where('sender_id',Auth::user()->id)->where('status',2)->orderby('created_at','desc')->get();
        $mainSupplier =Invitation::where('sender_id',Auth::user()->id)->orderby('created_at','desc')->get();
        $first_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->where('invitation_time',1)->get();
        $second_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->where('invitation_time',2)->get();
        $third_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->where('invitation_time',3)->get();
        $accepted_invitation = Invitation::where('sender_id',Auth::user()->id)->where('status',1)->get();
        $expired_invitation =  Invitation::where('sender_id',Auth::user()->id)->where('status',3)->get();
        if($mainSupplier->count()>0)
        {
                $accepted = (($accepted_invitation->count()*100)/($mainSupplier->count()));
                $first = (($first_invitation->count()*100))/($mainSupplier->count());
                $second = (($second_invitation->count()*100))/($mainSupplier->count());
                $third = (($third_invitation->count()*100))/($mainSupplier->count());
                $expired = (($expired_invitation->count()*100)/($mainSupplier->count()));
        }
        else{
                $accepted =0;
                $first = 0;
                $second = 0;
                $third =0;
                $expired=0;
        }
        return view('client.message.invitation.expiredlist',compact('suppliers','timeoutSuppliers','accepted','first','second','third','expired'));
    }

    public function invitationExpiredDetail($id)
    {
        $supplier = Invitation::find($id);
        return view('client.message.invitation.expireddetails',compact('supplier'));

    }

    public function invitationTimeout()
    {
        $suppliers = Invitation::where('sender_id',Auth::user()->id)->where('status',2)->orderby('created_at','desc')->get();
        return $suppliers;
    }
}
