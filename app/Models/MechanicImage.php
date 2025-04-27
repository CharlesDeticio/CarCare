<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechanicImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'mechanic_id',
        'image_path',
    ];

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
