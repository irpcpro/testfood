<?php

namespace App\Http\Controllers\System\DelayReport;

use App\Enums\DelayReportStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\DelayReport;
use App\Models\Order;
use JetBrains\PhpStorm\ArrayShape;

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


    public function checkAgentHasOpenTask(Agent $agent){
        return DelayReport::where('agent_id', $agent->id)->whereIn('status', [
            DelayReportStatusEnum::ASSIGNED->value,
            DelayReportStatusEnum::PENDING->value
        ])->exists();
    }

    #[ArrayShape(['status' => "bool", 'message' => "string", 'data' => 'App\Models\DelayReport|null'])]
    public function assignTask(Agent $agent): array
    {
        // get the reports records based on being pending and
        $order = DelayReport::where('status', DelayReportStatusEnum::PENDING->value)->orderBy('created_at', 'asc');

        // if there isn't any task to be assigned, return
        if(!$order->exists())
            return [
                'status' => false,
                'message' => "There isn't any delay report to be assigned. List is empty",
                'data' => null
            ];


        // assign the task to the agent
        $order = $order->first();
        $order->update([
            'status' => DelayReportStatusEnum::ASSIGNED,
            'agent_id' => $agent->id,
        ]);
        return [
            'status' => true,
            'message' => 'The task assigned',
            'data' => $order
        ];
    }

}
