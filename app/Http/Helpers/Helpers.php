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

#[ArrayShape(['start' => "\Illuminate\Support\Carbon", 'end' => "\Illuminate\Support\Carbon"])]
function getLastWeekDates(): array {
    return [
        'start' => Carbon::now()->startOfWeek()->subweek(),
        'end' => Carbon::now()->endOfWeek()->subWeek(),
    ];
}
