<?php

namespace App\Http\Resources\V1\DelayReport;

use App\Http\Resources\V1\Agents\AgentResource;
use App\Http\Resources\V1\Order\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DelayReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'agent' => $this->agent ? new AgentResource($this->agent) : null,
            'order' => new OrderResource($this->order),
            'status' => $this->status->value,
            'estimate' => $this->estimate,
            'context' => $this->context
        ];
    }
}
