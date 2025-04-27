<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sender_type',
        'receiver_type',
        'message',
        'is_read',
    ];

    /**
     * Get the sender (user or mechanic)
     */
    public function sender()
    {
        return $this->morphTo(null, 'sender_type', 'sender_id');
    }

    /**
     * Get the receiver (user or mechanic)
     */
    public function receiver()
    {
        return $this->morphTo(null, 'receiver_type', 'receiver_id');
    }
}
