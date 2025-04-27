<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'ProductID';

    protected $fillable = [
        'ProductName',
        'Description',
        'Price',
        'Inventory',
    ];
}
