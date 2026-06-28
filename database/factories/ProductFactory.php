<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $amounts = [10, 20, 50, 100, 200, 500, 1000];

        $currencyAmount = $this->faker->randomElement($amounts);

        return [
            'game_id' => Game::factory(),
            'name' => $currencyAmount.' '.$this->faker->randomElement(['Diamonds', 'UC', 'Diamond', 'Crystals', 'Points']),
            'currency_amount' => $currencyAmount,
            'price' => $this->faker->randomElement([5000, 10000, 25000, 50000, 100000, 200000]),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
