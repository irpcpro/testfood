<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Facade\APIResponse;
use App\Http\Requests\Order\OrderCreateRequest;

class OrderController extends Controller
{

    public function create(OrderCreateRequest $request)
    {
        APIResponse('ok..')->setData($request->all())->send();
    }

}
