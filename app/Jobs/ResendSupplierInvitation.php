<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewSupplierInvitationMail;
use App\Models\Invitation;
use Mail;

class ResendSupplierInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $suppliers;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($suppliers)
    {
        //
        $this->suppliers = $suppliers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $users = $this->suppliers;
        
        foreach($users as $supplier)
		{
			$invitation = Invitation::find($supplier);
            Mail::to($invitation->email)->send(new NewSupplierInvitationMail($invitation));
        }
    }
}
