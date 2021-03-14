<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SellDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sell_id = $this->faker->numberBetween(1, 50);
        $quant = $this->faker->numberBetween(1, 5);
        $product = Product::find($this->faker->numberBetween(1, 5));
        $total = $product->price * $quant;

        return [
            'quant' => $quant,
            'total' => $total,
            'sell_id' => $sell_id,
            'product_id' => $product->id
        ];
    }
}
