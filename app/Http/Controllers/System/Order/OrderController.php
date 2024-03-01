<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserAddress;
use App\Models\Vendor;
use Carbon\Carbon;

class OrderController extends Controller
{

    /**
     * @param Vendor $vendor
     * @param UserAddress $user_address
     *
     * @return Order
     * */
    public function create(Vendor $vendor, UserAddress $user_address): \Illuminate\Database\Eloquent\Model
    {
        $model = Order::query();
        $model = $model->create([
            'user_id' => auth()->user()->id,
            'vendor_id' => $vendor->id,
            'user_address_id' => $user_address->id,
            'delivery_time' => $vendor->deliveryTime(),
            'delivery_time_update' => Carbon::now()
        ]);

        return $model;
    }

    public function updateOrderDeliveryTime(Order $order, $time): bool
    {
        return $order->update([
            'delivery_time' => $time,
            'delivery_time_update' => Carbon::now()
        ]);
    }

    public function deliveryTimeHasPassed(Order $order): bool
    {
        $deliveryDateTime = $order->delivery_time_update->addMinutes($order->delivery_time);
        return Carbon::now()->isAfter($deliveryDateTime);
    }

}
