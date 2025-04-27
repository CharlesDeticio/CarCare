<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    // Define the columns that can be mass-assigned
    protected $fillable = [
        // 'input_address',
        'booking_date',
        'booking_time',
        'reason',
        'service_id',
        'user_id',
        'mechanic_id',
        'service_id',
        'status', 
        'hasRated',    // if you are manually updating this in your code!

    ];

    // Casts for date and time fields (optional)

    // Relationship: Each booking belongs to one mechanic (user)
    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rating()
{
    return $this->hasOne(ServiceRating::class);
}

}