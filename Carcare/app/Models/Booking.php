<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'BID';

    protected $fillable = [
        'OwnerID',
        'ShopID',
        'DateTime',
    ];

    public function vehicleOwner()
    {
        return $this->belongsTo(VehicleOwner::class, 'OwnerID');
    }

    public function mechanicShop()
    {
        return $this->belongsTo(MechanicShop::class, 'ShopID');
    }
}
