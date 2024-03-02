<?php

namespace App\Http\Controllers\API\V1\Agent;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\DelayReport\DelayReportController;
use App\Http\Resources\V1\DelayReport\DelayReportResource;
use App\Models\Agent;
use Illuminate\Http\Request;


class AgentAPIController extends Controller
{

    /*
     * in here, because we don't have any authorization, for mock data we pass the agent_id through the api query param
     * */
    // public function assignTask()
    public function assignTask(Agent $agent, Request $request)
    {
        // make object from delay report controller
        $delayReportController = new DelayReportController();

        // check if agent has open task
        if($delayReportController->checkAgentHasOpenTask($agent))
            APIResponse('You have already a task opened.', 422, false)->send();

        // try to assign task
        $result = $delayReportController->assignTask($agent);

        // set the data to pass to resource if it has any
        $data = $result['data']
            ? (new DelayReportResource($result['data']))->toArray($request)
            : null;

        // return response
        APIResponse($result['message'], 200, $result['status'])->setData($data)->send();
    }

}
