<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyBookingRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'emergency_booking_id',
        'user_id',
        'mechanic_id',
        'rating',
        'comment'
    ];

    public function emergencyBooking()
    {
        return $this->belongsTo(EmergencyBooking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
