<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Service extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'mechanic_id' // Add mechanic_id to the fillable array
    ];

    public function mechanic()
     {
        return $this->belongsTo(Mechanic::class, 'mechanic_id');
     }

     public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function ratings()
{
    return $this->hasMany(ServiceRating::class);
}

public function averageRating()
{
    return $this->ratings()->avg('rating');
}


}
