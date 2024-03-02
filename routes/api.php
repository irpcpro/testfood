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

    // agents
    Route::prefix('agent')->namespace('Agent')->controller('AgentAPIController')->group(function(){
        /*
         * request to assign delay_report to agent
         *
         * in here, because we don't have any authorization, for mock data we pass the agent_id through the api query param
         * */
        // Route::post('/assign_task', 'assignTask');
        Route::post('/assign_task/{agent}', 'assignTask');
    });

    // vendor
    Route::prefix('vendor/{vendor}')->namespace('Vendor')->controller('ReportAPIController')->group(function(){
        // reports
        Route::prefix('reports')->controller('VendorReportController')->group(function(){
            Route::prefix('delays')->group(function(){
                Route::get('/weekly', 'weeklyDelays');
            });

        });

    });

});
