<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'mechanic_id', 'product_id', 'status', 'total_amount', 'cancellation_reason', 'status_msg', 'payment_method' // Add payment_method here
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

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
