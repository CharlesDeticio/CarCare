<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'OrderID';

    protected $fillable = [
        'OwnerID',
        'ShopID',
        'PID',
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

    public function shopInventory()
    {
        return $this->belongsTo(ShopInventory::class, 'PID');
    }
}
