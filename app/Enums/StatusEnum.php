<?php

namespace App\Enums;

enum StatusEnum: int
{
    case Pending = 1;
    case InProgress = 2;
    case Completed = 3;
    case New = 4;
    case Read_pickup = 5;
    case Pickup = 6;
    case Delivered = 7;
    case Cancelled = 8;

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::InProgress => 'In Progress',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
            self::New => 'New',
            self::Read_pickup => 'Ready for Pickup',
            self::Pickup => 'Picked Up',
            self::Delivered => 'Delivered',
        };
    }

}
