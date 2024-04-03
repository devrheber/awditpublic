<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Supplier;
use App\Models\Invitation;
use Carbon\Carbon; 
use Mail;
use App\Mail\demomail;

class resendmail extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * @var string
     */
    protected $signature = 'sendmail:reinvitation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for the  send the mail after 15 day to invite to supplier again to the platform ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to('rahul.theappideas@gmail.com')->send(new demomail());
    
        // $invitations = Invitation::get();
        // $today = Carbon::now();
        // foreach($invitations as $invitation)
        // {
        //     if ($invitation->status <3){ 
        //         if($invitation->status == 1)
        //         {
        //             break;
        //         }
        //         if($invitation->invitation_time ==1)
        //         {
        //             if($today>$invitation->expired_date)
        //             {
        //                 $invitation->status =2;
        //                 $invitation->save();
        //             }
        //         }
        //         elseif($invitation->invitation_time == 2)
        //         {
        //             if($today>$invitation->second_expired_date)
        //             {
        //                 $invitation->status =2;
        //                 $invitation->save();
        //             }
        //         }
        //         elseif($invitation->invitation_time == 3)
        //         {
        //             if($today>$invitation->third_expired_date)
        //             {
        //                 $invitation->status =3;
        //                 $invitation->save();
        //             }
        //         }
        //     }
        // }
    }
}
