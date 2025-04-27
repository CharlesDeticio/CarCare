<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ShopInventory extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'PID';

    protected $fillable = [
        'ProductName',
        'Price',
        'Inventory',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'PID');
    }
}
