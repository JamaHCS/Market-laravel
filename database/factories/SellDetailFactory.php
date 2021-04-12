<?php

namespace Database\Factories;

use App\Models\Sell;
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
        $sells = Sell::all();
        $products = Product::all();

        $sell = $sells[$this->faker->numberBetween(0, 49)];

        $sell_id = $sell->id;
        $quant = $this->faker->numberBetween(0, 4);
        $product = $products[$quant];
        $total = $product->price * $quant;

        return [
            'quant' => $quant,
            'total' => $total,
            'sell_id' => $sell_id,
            'product_id' => $product->id
        ];
    }
}
