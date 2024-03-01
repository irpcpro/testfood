<?php

namespace App\Http\Resources\V1\Order;

use App\Http\Resources\V1\User\UserResource;
use App\Http\Resources\V1\UserAddress\UserAddressDeliveryResource;
use App\Http\Resources\V1\Vendor\VendorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'user' => new UserResource($this->user),
            "vendor" => new VendorResource($this->vendor),
            "user_delivery_address" => new UserAddressDeliveryResource($this->user->userAddresses()->find($this->user_address_id)),
            "delivery_time" => $this->delivery_time,
            "updated_at" => $this->updated_at,
        ];
    }
}
