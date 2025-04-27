<?php

namespace App\Mail;

use App\Models\Service;
use App\Models\Booking;
use App\Models\Mechanic;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MechanicBookingReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $mechanic;
    public $service;
    public $booking;

    public function __construct(Mechanic $mechanic, Service $service, Booking $booking)
    {
        $this->mechanic = $mechanic;
        $this->service = $service;
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Upcoming Booking Alert')
            ->view('emails.mechanic-booking-reminder');
    }
}
