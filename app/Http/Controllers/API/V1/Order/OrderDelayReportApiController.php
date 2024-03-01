<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Enums\TripStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Order\OrderController;
use App\Http\Controllers\System\Order\OrderDelayController;
use App\Http\Helpers\Facade\APIResponse;
use App\Http\Requests\Order\OrderDelayReportRequest;
use App\Models\Order;

class OrderDelayReportApiController extends Controller
{

    public function create(OrderDelayReportRequest $request)
    {
        // get the order
        $order = Order::find($request->validated('order_id'));

        // specific status
        $specificStatus = [
            TripStatusEnum::assigned->value,
            TripStatusEnum::at_vendor->value,
            TripStatusEnum::picked->value,
        ];

        // check if order delivery time hasn't passed yet
        $orderController = new OrderController();
        if(!$orderController->deliveryTimeHasPassed($order))
            APIResponse('the order has still time to be delivered.', 422, false)->send();

        $orderDelayController = new OrderDelayController($order);

        // check conditions
        if ($order->trip()->exists()) {
            if (in_array($order->trip->status->value, $specificStatus)) {
                // step 1 - get new estimate
                $orderDelayController->newEstimate();
            } else {
                // step 2 - move order delaying

            }
        } else {
            // step 2 - move order delaying

        }
    }

}
