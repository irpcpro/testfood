<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
            ->has(UserAddress::factory()->count(1))
            ->create();

        Agent::factory(10)->create();

        Vendor::factory(10)->create();
    }

}
