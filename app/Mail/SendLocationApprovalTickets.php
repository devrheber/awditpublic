<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLocationApprovalTickets extends Mailable
{
    use Queueable, SerializesModels;

    public $location;   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($location)
    {
        //
        $this->location = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('supplier.mail.accept');
    }
}
