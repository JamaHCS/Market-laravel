<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(null, 40, 100),
            'cost' => $this->faker->randomFloat(null, 10, 40),
            'market_id' => 1,
            'image' => $this->faker->imageUrl(),
            'brand' => $this->faker->word(),
            'type' => $this->faker->word(),
            'barcode' => 123456789,
        ];
    }
}
