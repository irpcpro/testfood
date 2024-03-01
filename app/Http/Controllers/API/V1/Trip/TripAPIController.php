<?php

namespace App\Http\Controllers\API\V1\Trip;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Driver\DriverController;
use App\Http\Controllers\System\Order\OrderController;
use App\Http\Controllers\System\Trip\TripController;
use App\Http\Requests\Trip\TripRequest;
use App\Http\Resources\V1\Trip\TripResource;
use App\Models\Order;

class TripAPIController extends Controller
{

    public function request(TripRequest $request)
    {
        // check if order hasn't any active trip
        $order_id = $request->validated('order_id');
        $order = Order::find($order_id);

        // order controller
        if($order->has_trip)
            APIResponse('Order has already driver.', 200, false)->send();

        // request for trip
        $TripController = new TripController();
        $trip = $TripController->create($order);

        // get the resource
        $out = new TripResource($trip);
        $out = $out->toArray($request);

        // send response
        APIResponse('trip has created')->setData($out)->send();
    }

}
