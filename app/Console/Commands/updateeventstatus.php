<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Supplier;
use App\Models\Invitation;
use Carbon\Carbon; 
use Mail;
use App\Mail\ConfirmSupplierRegisterMail;

class updateeventstatus extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * @var string
     */
    protected $signature = 'event:updatestatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is command  is used for the  update the status if time is gone then updatet hte status as expired';

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
		Mail::to('rahul.theappidea@gmail.com')->send(new ConfirmSupplierRegisterMail('rahul','mardiya'));

    }
}
