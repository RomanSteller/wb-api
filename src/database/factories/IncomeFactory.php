<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'income_id' => $this->faker->unique()->randomNumber(),
            'number' => '',
            'date' => $this->faker->date(),
            'last_change_date' => $this->faker->date(),
            'supplier_article' => Str::random(16),
            'tech_size' => Str::random(16),
            'barcode' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'quantity' => $this->faker->numberBetween(1, 50),
            'total_price' => (string) $this->faker->randomFloat(2, 0, 10000),
            'date_close' => $this->faker->date(),
            'warehouse_name' => $this->faker->city,
            'nm_id' => $this->faker->randomNumber(8),
        ];
    }
}
