<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        $games = [
            'Mobile Legends' => '🎮',
            'Free Fire' => '🔥',
            'PUBG Mobile' => '🔫',
            'Genshin Impact' => '⭐',
            'Valorant' => '🔫',
        ];

        $name = $this->faker->unique()->randomElement(array_keys($games));

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => $games[$name] ?? '🎮',
            'is_active' => true,
        ];
    }
}
