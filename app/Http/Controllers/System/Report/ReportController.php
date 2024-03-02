<?php

namespace App\Http\Controllers\System\Report;

use App\Http\Controllers\Controller;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\Vendor;

class ReportController extends Controller
{

    public function vendorWeeklyDelays()
    {
        // get the time span
        $getLastWeekDates = getLastWeekDates();

        // tables name
        $vendor_tbl = (new Vendor())->getTable();
        $order_tbl = (new Order())->getTable();
        $delayReport_tbl = (new DelayReport())->getTable();

        // get the records
        $report = Vendor::query();
        $report->leftJoin($order_tbl, "$order_tbl.vendor_id", '=', "$vendor_tbl.id");
        $report->leftJoin($delayReport_tbl, "$delayReport_tbl.order_id", '=', "$order_tbl.id");
        $report->select([
            "$vendor_tbl.id as vendor_id",
            "$vendor_tbl.name as vendor_name",
            \DB::raw("COUNT($delayReport_tbl.id) as total_reports"),
            \DB::raw("SUM($delayReport_tbl.estimate) as estimate_sum"),
            \DB::raw("COUNT(CASE WHEN $delayReport_tbl.estimate IS NOT NULL THEN 1 END) as estimate_count"),
        ]);
        $report->whereBetween("$delayReport_tbl.created_at", [$getLastWeekDates['start'], $getLastWeekDates['end']]);
        $report->groupBy([
            "$vendor_tbl.id",
            "$vendor_tbl.name"
        ]);
        $report->orderBy('estimate_sum', 'desc');

        return [
            'data' => [
                'reports' => $report->get(),
                'start_date' => $getLastWeekDates['start'],
                'end_date' => $getLastWeekDates['end']
            ],
            'status' => true,
            'message' => 'Report of between '.$getLastWeekDates['start'].' and '. $getLastWeekDates['end'],
        ];
    }

}
