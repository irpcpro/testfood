<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

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

    }




    public function moveOrderToDelay(){}

}
