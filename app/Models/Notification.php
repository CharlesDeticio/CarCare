<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mechanic_id',
        'message',
        'is_read',
        'product_id',
        'booking_id',       // ✅ Add this!
        'service_id',       // Optional if you have this column
        'mechanic_message',
        'admin_id',         // ✅ Add this
        'rating',
        'comment',
        'product_rating_id', // ✅ this!
        'service_rating_id', // ✅ ADD THIS LINE


    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function booking()
{
    return $this->belongsTo(Booking::class)->with('mechanic', 'service');
}

public function service()
{
    return $this->belongsTo(Service::class);
}

public function productRating()
{
    return $this->belongsTo(\App\Models\ProductRating::class, 'product_rating_id');
}

public function serviceRating()
{
    return $this->belongsTo(\App\Models\ServiceRating::class, 'service_rating_id');
}


}

