<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Authenticatable
{
    use HasFactory;
    

    protected $fillable = [
        'ProductName',
        'Description',
        'Price',
        'Inventory',
        'mechanic_id', // Add mechanic_id to the fillable array
        'user_id',
        'image',
        'color',
        'width',
        'weight',
        'height',
        'category'
    ];

     // A product belongs to a user
     public function mechanic()
     {
        return $this->belongsTo(Mechanic::class, 'mechanic_id');
     }
     public function user()
     {
        return $this->belongsTo(User::class, 'user_id');
     }

     public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function ratings()
{
    return $this->hasMany(ProductRating::class);
}

public function averageRating()
{
    return $this->ratings()->avg('rating');
}

}
