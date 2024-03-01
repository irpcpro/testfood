<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Order\OrderController;
use App\Http\Helpers\Facade\APIResponse;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Resources\V1\Order\OrderResource;
use App\Models\Order;
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
        $order = $order->create($vendor, $user_address);

        // get resource
        $out = new OrderResource($order);
        $out = $out->toArray($request);

        // return response
        APIResponse('order created.')->setData($out)->send();
    }

}
