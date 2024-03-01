<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\EstimateSystem\Estimator;
use JetBrains\PhpStorm\ArrayShape;

class OrderDelayController extends Controller
{

    /**
     * @param Order $order
     * */
    public function __construct(public Order $order)
    {
        //
    }


    /**
     * get new estimate (delivery time) for order
     * */
    #[ArrayShape(['status' => "bool", 'message' => "string"])]
    public function newEstimate()
    {
        $estimator = new Estimator();
        $newTime = $estimator->getNewEstimate();
        if($newTime['status']){
            // update order delivery time
            $orderController = new OrderController();
            $orderController->updateOrderDeliveryTime($this->order, $newTime['data']['time']);

            // save data to delay reports



        }else{
            return [
                'status' => false,
                'message' => 'service is down. try again later.'
            ];
        }
    }




    public function moveOrderToDelay(){}

}
