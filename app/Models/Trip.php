<?php

namespace App\Models;

use App\Enums\TripStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'order_id',
        'status',
    ];

    protected $appends = [
        'on_trip'
    ];

    protected $casts = [
        'status' => TripStatusEnum::class
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }

    public function getOnTripAttribute(): bool
    {
        /*
         * we could check if order has any trip records or not,
         * but here if there would be a specific status for example "cancel" we can handle it here
         * */
        $getEnums = array_column(TripStatusEnum::cases(),'value');
        if(in_array($this->status->value, $getEnums))
            return true;

        return false;
    }

}
