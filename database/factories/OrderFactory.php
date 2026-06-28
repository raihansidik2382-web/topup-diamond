<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'game_id' => Game::factory(),
            'product_id' => Product::factory(),
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->email(),
            'player_id' => $this->faker->randomNumber(8).$this->faker->randomNumber(2),
            'server_id' => $this->faker->optional()->randomNumber(4),
            'amount' => $this->faker->randomElement([5000, 10000, 25000, 50000]),
            'status' => $this->faker->randomElement(['pending', 'success', 'failed']),
            'payment_method' => $this->faker->randomElement(['transfer', 'e-wallet', 'convenience_store']),
        ];
    }

    public function pending(): static
    {
        return $this->state(['status' => 'pending']);
    }

    public function success(): static
    {
        return $this->state(['status' => 'success']);
    }

    public function failed(): static
    {
        return $this->state(['status' => 'failed']);
    }
}
