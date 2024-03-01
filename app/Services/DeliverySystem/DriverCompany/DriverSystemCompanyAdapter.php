<?php

namespace App\Services\DeliverySystem\DriverCompany;

use App\Services\DeliverySystem\DriverSystem;
use JetBrains\PhpStorm\ArrayShape;

class DriverSystemCompanyAdapter implements DriverSystem {

    public function __construct(private DriverCompany $driverCompany)
    {
        //
    }

    #[ArrayShape(['uid' => "string", 'name' => "string", 'plate' => "int"])]
    public function getDriver(): array
    {
        return $this->driverCompany->GetDriverFromThirdPartyService();
    }

}

