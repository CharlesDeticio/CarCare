<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ProductRating;

class ProductRated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $rating;
    protected $for; // 'user' or 'mechanic'

    public function __construct(ProductRating $rating, $for = 'mechanic')
    {
        $this->rating = $rating;
        $this->for = $for;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'product_id' => $this->rating->product_id,
            'user_id' => $this->rating->user_id,
            'rating' => $this->rating->rating,
            'comment' => $this->rating->comment,
            'message' => $this->for === 'user' 
                ? 'Your review has been submitted successfully.' 
                : 'Your product has been reviewed by a customer.',
        ];
    }
}
