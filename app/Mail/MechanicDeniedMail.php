<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MechanicDeniedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mechanic;

    public function __construct($mechanic)
    {
        $this->mechanic = $mechanic;
    }

    public function build()
    {
        return $this->subject('Your Mechanic Account Has Been Denied')
            ->view('emails.mechanic-denied');
    }
}
