<?php

namespace Database\Factories;

use App\Models\Sell;
use App\Models\User;
use App\Models\Market;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $market = Market::first();
        $user = User::first();

        return [
            'market_id' => $market->id,
            'user_id' => $user->id,
        ];
    }
}
