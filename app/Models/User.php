<?php

namespace App\Models;
use App\Models\Message;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'province',
        'region',
        'zip_code',
        'phone_number',
        'car_type',
        'car_model',
        'password',
        'image',
        'mechanic_id',
        'product_id',
        // 'longitude',    // New field for longitude
        // 'latitude',
        // 'emergency_address',
        // 'emergency_reason'
                'otp',
        'otp_expires_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'mechanic_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function carts()
{
    return $this->hasMany(Cart::class);
}

public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function cars()
{
    return $this->hasMany(Car::class);
}

public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function emergencyBookings()
{
    return $this->hasMany(EmergencyBooking::class);
}

public function sentMessages()
{
    return $this->morphMany(Message::class, 'sender');
}

public function receivedMessages()
{
    return $this->morphMany(Message::class, 'receiver');
}

}