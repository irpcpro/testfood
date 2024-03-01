<?php

namespace App\Http\Controllers\System\DelayReport;

use App\Enums\DelayReportStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\DelayReport;
use App\Models\Order;

class DelayReportController extends Controller
{

    public function reEstimateOrder(Order $order, int $estimate)
    {
        return DelayReport::create([
            'order_id' => $order->id,
            'status' => DelayReportStatusEnum::SOLVED->value,
            'estimate' => $estimate,
        ]);
    }

    public function pendingOrderToCheck(Order $order)
    {
        return DelayReport::create([
            'order_id' => $order->id,
            'status' => DelayReportStatusEnum::PENDING->value,
        ]);
    }

}
