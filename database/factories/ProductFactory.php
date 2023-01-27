<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_image' => '/images/img.png',
            'product_name' => $this->faker->name(),
            'product_description' =>  $this->faker->text(),
            'product_status' => 1,
        ];
    }
}
