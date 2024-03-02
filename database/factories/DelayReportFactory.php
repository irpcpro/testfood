<?php

namespace Database\Factories;

use App\Enums\DelayReportStatusEnum;
use App\Models\Agent;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DelayReport>
 */
class DelayReportFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first();
        $rand = function(){
            return (rand(1,10) % 2 == 0);
        };

        if($rand()){
            return [
                'order_id' => $order->id,
                'status' => DelayReportStatusEnum::SOLVED->value,
                'estimate' => randomDeliveryTime(),
            ];
        }else{
            if($rand()){
                $agent = Agent::inRandomOrder()->first()->id;
                $status = ($rand())? DelayReportStatusEnum::ASSIGNED->value : DelayReportStatusEnum::SOLVED->value;
            }else{
                $agent = null;
                $status = DelayReportStatusEnum::PENDING->value;
            }

            return [
                'agent_id' => $agent,
                'order_id' => $order->id,
                'status' => $status,
            ];
        }

    }
}
