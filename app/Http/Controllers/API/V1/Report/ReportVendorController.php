<?php

namespace App\Http\Controllers\API\V1\Report;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Report\ReportController;
use Illuminate\Http\Request;

class ReportVendorController extends Controller
{

    public function weeklyDelays(Request $request)
    {
        // get the report
        $reportController = new ReportController();
        $cache = $request->input('cache', "true") == "true";
        $report = $reportController->vendorWeeklyDelays($cache);

        // return response
        APIResponse($report['message'], 200, true)->setData($report['data'])->send();
    }

}
