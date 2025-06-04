<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => Carbon::now()->format('Y-m-d'),
            'last_change_date' => null,
            'supplier_article' => Str::random(16),
            'tech_size' => Str::random(16),
            'barcode' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'quantity' => $this->faker->numberBetween(1, 20),
            'is_supply' => null,
            'is_realization' => null,
            'quantity_full' => null,
            'warehouse_name' => $this->faker->city,
            'in_way_to_client' => null,
            'in_way_from_client' => null,
            'nm_id' => $this->faker->randomNumber(9),
            'subject' => Str::random(16),
            'category' => Str::random(16),
            'brand' => Str::random(16),
            'sc_code' => $this->faker->randomNumber(8),
            'price' => (string) $this->faker->randomFloat(2, 1000, 6000),
            'discount' => (string) $this->faker->numberBetween(0, 30),
        ];
    }
}
