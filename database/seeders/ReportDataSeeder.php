<?php

namespace Database\Seeders;

use App\Models\DelayReport;
use App\Models\Order;
use Illuminate\Database\Seeder;

class ReportDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Order::factory(100)->create();
        DelayReport::factory(100)->create();

    }
}
