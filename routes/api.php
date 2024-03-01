<?php

use Illuminate\Support\Facades\Route;


Route::namespace('V1')->prefix('v1')->group(function () {

    // order
    Route::prefix('order')
        ->namespace('Order')
        ->controller('OrderAPIController')
        ->middleware('mockUser')
        ->group(function () {
            // place order
            Route::post('/', 'create');
    });


    Route::prefix('trip')
        ->namespace('Trip')
        ->controller('TripAPIController')
        ->group(function(){
            // request driver for order
            Route::post('/request', 'request');
    });


});
