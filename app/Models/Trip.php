<?php

namespace App\Models;

use App\Enums\TripStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'order_id',
        'status',
    ];

    protected $casts = [
        'status' => TripStatusEnum::class
    ];

}
