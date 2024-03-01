<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Order\OrderController;
use App\Http\Helpers\Facade\APIResponse;
use App\Http\Requests\Order\OrderCreateRequest;

class OrderAPIController extends Controller
{

    public function create(OrderCreateRequest $request)
    {


        $order = OrderController::class;
        $order->create();



    }

}
