<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderDelayReportRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => ['required', 'exists:orders,id'],
        ];
    }

    public function messages()
    {
        return [
            'order_id.exists' => "order id doesn't exists.",
            'order_id.required' => 'order id should be entered.',
        ];
    }

}
