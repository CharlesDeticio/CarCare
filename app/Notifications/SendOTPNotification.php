<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOTPNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your OTP for Account Verification')
            ->line('Your OTP for account verification is:')
            ->line($this->otp)
            ->line('This OTP will expire in 5 minutes.')
            ->line('If you did not request this, please ignore this email.');
            // ->line('Your OTP is: ' . $this->otp)

    }
}