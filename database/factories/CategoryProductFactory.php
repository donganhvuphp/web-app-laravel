<?php

namespace Database\Factories;

use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class CategoryProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(8),
            'description' => $this->faker->text,
        ];
    }
}
