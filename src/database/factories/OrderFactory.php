<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'g_number' => $this->faker->uuid,
            'date' => $this->faker->dateTimeBetween('-10 days')->format('Y-m-d H:i:s'),
            'last_change_date' => $this->faker->date(),
            'supplier_article' => Str::random(16),
            'tech_size' => Str::random(16),
            'barcode' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'total_price' => $this->faker->randomFloat(2, 1000, 5000),
            'discount_percent' => $this->faker->numberBetween(0, 50),
            'warehouse_name' => $this->faker->city,
            'oblast' => $this->faker->city,
            'income_id' => $this->faker->randomNumber(),
            'odid' => (string) $this->faker->randomNumber(5),
            'nm_id' => $this->faker->randomNumber(8),
            'subject' => Str::random(16),
            'category' => Str::random(16),
            'brand' => Str::random(16),
            'is_cancel' => $this->faker->boolean,
            'cancel_dt' => null,
        ];
    }
}
