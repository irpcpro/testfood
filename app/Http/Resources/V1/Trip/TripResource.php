<?php

namespace App\Http\Resources\V1\Trip;

use App\Http\Resources\V1\Driver\DriverResource;
use App\Http\Resources\V1\Order\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'driver' => new DriverResource($this->driver),
            'order' => new OrderResource($this->order),
            'status' => $this->status->value,
            'created_at' => $this->created_at
        ];
    }
}
