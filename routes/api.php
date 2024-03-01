<?php

use Illuminate\Support\Facades\Route;


Route::namespace('V1')->prefix('v1')->group(function () {

    // order
    Route::prefix('order')->namespace('Order')->group(function () {
            // place order
            Route::middleware('mockUser')->post('/', 'OrderAPIController@create');

            // order delay report
            Route::post('/delay_report', 'OrderDelayReportApiController@create');
    });

    // make a trip for order
    Route::prefix('trip')->namespace('Trip')->controller('TripAPIController')->group(function(){
            // request driver for order
            Route::post('/request', 'request');
    });

});
