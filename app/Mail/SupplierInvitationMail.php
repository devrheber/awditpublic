<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplierInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supplier;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($suppliers)
    {
        //
        $this->supplier = $suppliers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.supplier.invitationmail');
    }
}
