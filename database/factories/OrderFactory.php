<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        $startDate = Carbon::now()->subDays(15);
        $endDate = Carbon::now();
        $created_at = $this->faker->dateTimeBetween($startDate, $endDate);

        return [
            'user_id' => $user,
            'vendor_id' => Vendor::inRandomOrder()->first(),
            'user_address_id' => $user->userAddresses->first()->id,
            'delivery_time' => randomDeliveryTime(),
            'delivery_time_update' => $created_at,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
