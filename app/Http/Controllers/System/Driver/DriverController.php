<?php

namespace App\Http\Controllers\System\Driver;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Trip\TripController;
use App\Models\Driver;
use App\Models\Order;
use App\Services\DeliverySystem\DriverCompany\DriverCompany;
use App\Services\DeliverySystem\DriverCompany\DriverSystemCompanyAdapter;

class DriverController extends Controller
{

    /**
     * @return Driver
     * */
    public function inquiryDriver(Order $order): \Illuminate\Database\Eloquent\Model
    {
        $diverCompany = new DriverCompany();
        $driverSystem = new DriverSystemCompanyAdapter($diverCompany);

        // get driver from third-party
        $getDriver = $driverSystem->getDriver();

        // insert details of driver
        $driver = Driver::create([
            'uid' => $getDriver['uid'],
            'name' => $getDriver['name'],
            'plate' => $getDriver['plate'],
        ]);

        return $driver;
    }

}
