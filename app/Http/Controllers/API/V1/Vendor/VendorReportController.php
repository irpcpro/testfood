<?php

namespace App\Http\Controllers\API\V1\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class VendorReportController extends Controller
{

    public function weeklyDelays(Vendor $vendor)
    {
        return 'hello :)';

    }

}
