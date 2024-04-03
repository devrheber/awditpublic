<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmSupplierRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email,$password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password,$email)
    {
        //
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.mail.newinvitaion');
    }
}
