<?php

namespace App\Services\DeliverySystem\DriverCompany;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

// third-party system
class DriverCompany {

    /**
     * @return array
     * */
    #[ArrayShape(['uid' => "string", 'name' => "string", 'plate' => "int"])]
    public function GetDriverFromThirdPartyService(): array
    {
        // get driver from third-party service and return data
        return [
            'uid' => Str::uuid()->toString(),
            'name' => fake()->name(),
            'plate' => 2415354,
        ];
    }

}
