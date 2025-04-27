<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'rating',
        'comment',
        'booking_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
{
    return $this->belongsTo(Booking::class);
}

}
