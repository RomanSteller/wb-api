<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(200)->create();
        Stock::factory()->count(100)->create();
        Income::factory()->count(100)->create();
        Sale::factory()->count(200)->create();

    }
}
