<?php

namespace App\Http\Controllers\API\V1\Report;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Report\ReportController;
use App\Http\Helpers\Facade\APIResponse;

class ReportVendorController extends Controller
{

    public function weeklyDelays()
    {
        // get the report
        $reportController = new ReportController();
        $report = $reportController->vendorWeeklyDelays();

        // return response
        APIResponse($report['message'], 200, true)->setData($report['data'])->send();
    }

}
