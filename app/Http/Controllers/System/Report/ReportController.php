<?php

namespace App\Http\Controllers\System\Report;

use App\Http\Controllers\Controller;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class ReportController extends Controller
{

    #[ArrayShape(['data' => "array", 'status' => "bool", 'message' => "string"])]
    public function vendorWeeklyDelays(): array
    {
        // firstly get data from cache
        $getCache = $this->getReportFromCache();
        if($getCache != null)
            return $getCache;

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

        Log::debug('calculate new reports ......');

        // final data
        $data = [
            'data' => [
                'reports' => $report->get(),
                'start_date' => $getLastWeekDates['start'],
                'end_date' => $getLastWeekDates['end']
            ],
            'status' => true,
            'message' => 'Report of between '.$getLastWeekDates['start'].' and '. $getLastWeekDates['end'],
        ];

        // save to cache
        $this->saveReportToCache($data);

        // return result
        return $data;
    }

    #[ArrayShape(['data' => "array", 'status' => "bool", 'message' => "string"])]
    private function getReportFromCache()
    {
        // dates from cache
        $getData = Cache::get(CACHE_REPORT_DELAYS_WEEKLY);
        if($getData != null){
            $date_start_cached = Carbon::parse($getData['data']['start_date']);
            $date_end_cached = Carbon::parse($getData['data']['end_date']);

            // get now
            $getLastWeekDates = getLastWeekDates();
            $date_start_now = Carbon::parse($getLastWeekDates['start']);
            $date_end_now = Carbon::parse($getLastWeekDates['end']);

            if($date_start_cached->equalTo($date_start_now) && $date_end_cached->equalTo($date_end_now)){
                Log::debug('read from cache.');
                return $getData;
            }else{
                Cache::delete(CACHE_REPORT_DELAYS_WEEKLY);
            }
        }

        return null;
    }

    private function saveReportToCache($data): void
    {
        Log::debug('save to cache.');
        Cache::put(CACHE_REPORT_DELAYS_WEEKLY, $data);
    }

}
