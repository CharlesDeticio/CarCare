<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class VerifyMechanicEmail extends VerifyEmailBase
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable  (this is the mechanic model)
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Generate the verification URL for mechanics
        $verificationUrl = URL::temporarySignedRoute(
            'mechanic.verification.verify', // Make sure this matches your route name
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Verify Your Mechanic Email Address')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Please click the button below to verify your mechanic account email address.')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create an account, no further action is required.');
    }
}
