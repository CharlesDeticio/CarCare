<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case IN_TRANSIT = 'in_transit';
    case COMPLETED = 'completed';
}