<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechanicReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'mechanic_id',
        'total_users_booked',
        'total_orders',
        'total_product_inventory',
        'remaining_inventory',
        'total_services',
        'total_revenue',
        'pdf_path'
    ];

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
    public function getPreviousReportDate()
{
    return static::where('mechanic_id', $this->mechanic_id)
        ->where('id', '<>', $this->id)
        ->where('created_at', '<', $this->created_at)
        ->latest()
        ->value('created_at') ?? now()->subMonth(); // Default to 1 month ago if no previous report
}
}
