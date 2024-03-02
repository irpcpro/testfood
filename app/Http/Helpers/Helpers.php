<?php

use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;

if(!function_exists('APIResponse')){
    /**
     * @param mixed ...$data [message, error_code, success]
     * */
    function APIResponse(...$data){
        return app('APIResponse', $data);
    }
}

function randomDeliveryTime(): int {
    return rand(4,7);
}

#[ArrayShape(['start' => "string", 'end' => "string"])]
function getLastWeekDates(): array {
    return [
        'start' => Carbon::now()->startOfWeek()->subweek()->format('Y-m-d H:i:s'),
        'end' => Carbon::now()->endOfWeek()->subWeek()->format('Y-m-d H:i:s'),
    ];
}
