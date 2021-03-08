<?php

namespace Database\Factories;

use App\Models\Market;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Market::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'logo' => $this->faker->imageUrl(),
            'user_id' => $this->faker->numberBetween(0, 1),
            'uuid' => substr(uniqid(), 5),
            'type_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
