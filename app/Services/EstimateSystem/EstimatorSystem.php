<?php

namespace App\Services\EstimateSystem;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class EstimatorSystem implements Estimator
{

    private $API = 'http://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7';

    #[ArrayShape(['data' => "array", 'status_code' => "int", 'status' => "bool"])]
    public function getNewEstimate(): array
    {
        /*
         * the service is always returning 404 :|
         * */
        $response = Http::get($this->API);
        $status = $response->successful();
        return [
            'data' => $status ? $response->json()['time'] : null,
            'status_code' => $response->status(),
            'status' => $status,
        ];
    }

}

