<?php

namespace App\Models;
use App\Models\Message;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\MechanicVerifyEmail;
use App\Notifications\MechanicResetPasswordNotification;




class Mechanic extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $guard = 'mechanic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'ContactNo',
        'Address',
        'shopname',
        'image',
        'password',
        'verified',     // New field for verified status
        'longitude',    // New field for longitude
        'latitude',     // New field for latitude
        'otp',
        'otp_expires_at',
                'email_verified_at' // Make sure this is fillable
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'mechanic_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'mechanic_id');
    }

    // public function serviceMechanics()
    // {
    //     return $this->hasMany(ServiceMechanic::class);
    // }

    public function orders()
    {
        return $this->hasMany(Order::class);
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

public function mechanicImages()
{
    return $this->hasMany(MechanicImage::class);
}

public function sendEmailVerificationNotification()
{
    $this->notify(new MechanicVerifyEmail());
}

public function sendPasswordResetNotification($token)
{
    $this->notify(new MechanicResetPasswordNotification($token));
}

// app/Models/Mechanic.php
public function hasVerifiedEmail()
{
    return !is_null($this->email_verified_at);
}

}
