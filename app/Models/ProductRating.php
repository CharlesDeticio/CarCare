<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'order_id',   // ✅ Include this if you are saving order_id
    ];

    // Relationship: Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship: User (who rated)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function notification()
{
    return $this->hasOne(\App\Models\Notification::class);
}

}
