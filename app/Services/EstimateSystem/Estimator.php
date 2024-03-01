<?php

namespace App\Services\EstimateSystem;

use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

class Estimator
{

    #[ArrayShape(['data' => "array", 'status_code' => "int", 'status' => "bool"])]
    public function getNewEstimate(): array
    {
        /*
         * the service is always returning 404 :|
         * */
//        $response = Http::get("http://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7");
//        $response = Http::get(url('') . '/api/v1/estimator');
//        $status = $response->successful();
//        $data = [
//            'data' => $status ? $response->json()['time'] : null,
//            'status_code' => $response->status(),
//            'status' => $status,
//        ];
//        return $data;



        // mock response
        return [
            'data' => [
                'time' => rand(4,7)
            ],
            'status_code' => 200,
            'status' => true,
        ];
    }

}

