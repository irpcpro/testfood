<?php

namespace App\Http\Requests\Order;

use App\Rules\UserAddressBelongsToCurrentUserRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendor_id' => ['required', 'exists:vendors,id'],
            "user_address_id" => ['required', "exists:user_addresses,id", new UserAddressBelongsToCurrentUserRule],
        ];
    }

    public function messages()
    {
        return [
            'vendor_id.exists' => "vendor id doesn't exists.",
            'vendor_id.required' => 'vendor id should be entered.',
            'user_address_id.exists' => "user address id doesn't exists.",
            'user_address_id.required' => 'user address id should be entered.',
        ];
    }

}
