<?php

namespace App\Services\DeliverySystem;

use JetBrains\PhpStorm\ArrayShape;

interface DriverSystem
{

    #[ArrayShape([
        'uid' => "string",
        'name' => "string",
        'plate' => "int"
    ])]
    public function getDriver();

}
