<?php

namespace App\Services\EstimateSystem;

use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

class Estimator
{

    #[ArrayShape(['data' => "int|null", 'status_code' => "int", 'status' => "bool"])]
    public function getNewEstimate(): array
    {
        /*
         * the service is always returning 404 :|
         * */
//        $response = Http::get("http://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7");
        $response = Http::get('http://localhost:8000/api/v1/estimator');
        dd($response);
        $status = $response->successful();
        $data = [
            'data' => $status ? $response->json()['time'] : null,
            'status_code' => $response->status(),
            'status' => $status,
        ];

        // mock response
        return $data;
    }

}

