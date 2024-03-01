<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserAddress;
use App\Models\Vendor;

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
        ]);

        return $model;
    }


    public function hasDriver(Order $order)
    {
        if($order->trip)
            return $order->trip->on_trip;

        return false;
    }

}
