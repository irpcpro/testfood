<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderDelayReportRequest;
use App\Models\Order;

class OrderDelayReportApiController extends Controller
{

    public function create(OrderDelayReportRequest $request)
    {
        // get the order
        $order = Order::find($request->validated('order_id'));



    }

}
