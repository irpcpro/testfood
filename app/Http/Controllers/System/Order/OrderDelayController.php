<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\DelayReport\DelayReportController;
use App\Models\Order;
use App\Services\EstimateSystem\EstimatorProxy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    #[ArrayShape(['status' => "bool", 'message' => "string", 'data' => 'array|null'])]
    public function newEstimate(): array
    {
        // try to get new estimate time
        $estimator = new EstimatorProxy();
        $newTime = $estimator->getNewEstimate();

        // if new estimate time available
        if($newTime['status']){
            $getTime = $newTime['data']['time'];

            DB::beginTransaction();
            try {
                // update order delivery time
                $orderController = new OrderController();
                $orderController->updateOrderDeliveryTime($this->order, $getTime);

                // save data to delay reports
                $delayReportController = new DelayReportController();
                $delayReportController->reEstimateOrder($this->order, $getTime);

                DB::commit();
            }catch ( \Exception $exception){
                DB::rollBack();
                Log::error('something went wrong in ' . __METHOD__, [$exception]);
                APIResponse($exception->getMessage(), 500, false)->send();
            }

            return [
                'status' => true,
                'message' => "the new estimate has set. Sorry for delay. the new estimate is about $getTime minutes",
                'data' => [
                    'time' => $getTime
                ]
            ];
        }else{
            return [
                'status' => false,
                'message' => 'service is down. try again later.',
                'data' => null
            ];
        }
    }


    /**
     * move the order to the delay_report for assigning to the agent
     * */
    public function moveOrderToDelayQueue(){
        // move order to delay_report for assigning to the agents
        $delayReportController = new DelayReportController();
        $delayReportController->pendingOrderToCheck($this->order);
    }

}
