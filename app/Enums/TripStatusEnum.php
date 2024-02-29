<?php

namespace App\Enums;

enum TripStatusEnum: int
{
    case delivered = 1;
    case picked = 2;
    case at_vendor = 3;
    case assigned = 4;
}
