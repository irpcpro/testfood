<?php

namespace App\Http\Resources\V1\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressDeliveryResource extends JsonResource
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
            "title" => $this->title,
            "address" => $this->address,
            "lat" => -29.48,
            "long" => 163.08,
            "contact_phone" => $this->user->phone,
        ];
    }
}
