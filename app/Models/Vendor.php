<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    /*
     * this should develop on the items that user has chosen. but here we need a mock data to get the delivery time
     * we assume delivery time for each vendor is fixed between 5 and 10 minutes
     * */
    public function deliveryTime(): int
    {
        return randomDeliveryTime();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'vendor_id', 'id');
    }

}
