<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaleFactory extends Factory
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
            'date' => $this->faker->date(),
            'last_change_date' => $this->faker->date(),
            'supplier_article' => Str::random(16),
            'tech_size' => Str::random(16),
            'barcode' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'total_price' => $this->faker->randomFloat(2, 1000, 5000),
            'discount_percent' => $this->faker->numberBetween(0, 30),
            'is_supply' => $this->faker->boolean,
            'is_realization' => $this->faker->boolean,
            'promo_code_discount' => null,
            'warehouse_name' => $this->faker->city,
            'country_name' => 'Россия',
            'oblast_okrug_name' => $this->faker->word,
            'region_name' => $this->faker->word,
            'income_id' => $this->faker->randomNumber(),
            'sale_id' => 'S' . $this->faker->randomNumber(),
            'odid' => null,
            'spp' => $this->faker->randomFloat(2, 5, 30),
            'for_pay' => $this->faker->randomFloat(2, 500, 3000),
            'finished_price' => $this->faker->randomFloat(2, 500, 3000),
            'price_with_disc' => $this->faker->randomFloat(2, 500, 3000),
            'nm_id' => $this->faker->randomNumber(9),
            'subject' => Str::random(16),
            'category' => Str::random(16),
            'brand' => Str::random(16),
            'is_storno' => null,
        ];
    }
}
