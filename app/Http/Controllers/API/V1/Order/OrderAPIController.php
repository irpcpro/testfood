<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Order\OrderController;
use App\Http\Helpers\Facade\APIResponse;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Models\UserAddress;
use App\Models\Vendor;

class OrderAPIController extends Controller
{

    public function create(OrderCreateRequest $request)
    {

        // get the models
        $vendor = Vendor::find($request->validated('vendor_id'));
        $user_address = UserAddress::find($request->validated('user_address_id'));

        // place order
        $order = new OrderController();
        $result = $order->create($vendor, $user_address);

        // TODO: resource collection

        APIResponse('order created.')->setData($result->toArray())->send();
    }

}
