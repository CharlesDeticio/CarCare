<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'mechanic_id',
        'name',
        'address',
        'contact_number',
        'image',
    ];

    // Define inverse relationship with Mechanic
    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
