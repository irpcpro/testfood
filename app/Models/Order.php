<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',
        'user_address_id',
        'delivery_time',
        'delivery_time_update'
    ];

    protected $appends = [
        'is_on_trip'
    ];

    protected $casts = [
        'delivery_time_update' => 'datetime'
    ];

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function trip(): HasOne
    {
        return $this->hasOne(Trip::class, 'order_id', 'id');
    }

    public function delayReports(): HasMany
    {
        return $this->hasMany(DelayReport::class, 'order_id', 'id');
    }

    public function getIsOnTripAttribute(): bool
    {
        if($this->trip)
            return $this->trip->on_trip;

        return false;
    }

}
