<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(6),
            'price' => $this->faker->numerify('######'),
            'category_id' => CategoryProduct::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ];
    }
}
