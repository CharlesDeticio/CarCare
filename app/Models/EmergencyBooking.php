<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyBooking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'mechanic_id',
        'emergency_reason',
        'longitude',
        'latitude',
        'emergency_address',
        'status',
    ];

    /**
     * Get the user associated with the emergency booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the mechanic associated with the emergency booking.
     */
    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

//     public function ratings()
// {
//     return $this->hasMany(EmergencyBookingRating::class);
// }

public function rating()
{
    return $this->hasOne(EmergencyBookingRating::class)->latestOfMany();
}


public function averageRating()
{
    return $this->ratings()->avg('rating');
}

}