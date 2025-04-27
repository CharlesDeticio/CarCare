<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $service;
    public $booking;

    public function __construct($user, $service, $booking)
    {
        $this->user = $user;
        $this->service = $service;
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Carcare Booking Reminder')
                    ->view('emails.booking_reminder');
    }
}