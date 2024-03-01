<?php

namespace App\Services\EstimateSystem;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\ArrayShape;

class EstimatorProxy implements Estimator
{

    #[ArrayShape(['data' => "array", 'status_code' => "int", 'status' => "bool"])]
    public function getNewEstimate(): array
    {
        // if server estimator is down, return from mock data
        if($this->checkIsEstimatorDown())
            return $this->backupEstimator(false);

        // get new estimate
        $estimatorSystem = new EstimatorSystem();
        $result = $estimatorSystem->getNewEstimate();

        return $result['status']? $result : $this->backupEstimator();
    }



    /**
     * mock response when server is down
     * */
    #[ArrayShape(['data' => "array", 'status_code' => "int", 'status' => "bool"])]
    private function backupEstimator(bool $setCache = true): array
    {
        if($setCache)
            Cache::set(CACHE_ESTIMATOR_DOWN_KEY, Carbon::now());

        return [
            'data' => [
                'time' => randomDeliveryTime()
            ],
            'status_code' => 200,
            'status' => true,
        ];
    }

    /*
     * check if server was down, and after 'CACHE_ESTIMATOR_TRY_SECONDS' should try for send request
     * */
    private function checkIsEstimatorDown(): bool
    {
        $get = Cache::get(CACHE_ESTIMATOR_DOWN_KEY);
        if($get && !Carbon::now()->isAfter(Carbon::parse($get)->addSeconds(CACHE_ESTIMATOR_TRY_SECONDS)))
            return true;

        return false;
    }

}
