<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\EstimateSystem\Estimator;

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
    public function newEstimate()
    {
        $estimator = new Estimator();
        $newTime = $estimator->getNewEstimate();
        dd($newTime);
        if($newTime['status']){

        }else{

        }
    }




    public function moveOrderToDelay(){}

}
