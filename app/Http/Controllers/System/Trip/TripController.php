<?php

namespace App\Http\Controllers\System\Trip;

use App\Enums\TripStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Driver\DriverController;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Trip;

class TripController extends Controller
{

    public function create(Order $order)
    {
        // need to get a driver
        $driverController = new DriverController();
        $driver = $driverController->inquiryDriver($order);

        $trip = Trip::create([
            'driver_id' => $driver->id,
            'order_id' => $order->id,
            'status' => TripStatusEnum::assigned,
        ]);

        return $trip;
    }

}
