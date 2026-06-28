<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['name' => 'Mobile Legends', 'icon' => '🎮', 'is_active' => true],
            ['name' => 'Free Fire', 'icon' => '🔥', 'is_active' => true],
            ['name' => 'PUBG Mobile', 'icon' => '🔫', 'is_active' => true],
            ['name' => 'Genshin Impact', 'icon' => '⭐', 'is_active' => true],
            ['name' => 'Valorant', 'icon' => '🔫', 'is_active' => true],
        ];

        foreach ($games as $game) {
            Game::create([
                'name' => $game['name'],
                'slug' => Str::slug($game['name']),
                'icon' => $game['icon'],
                'is_active' => $game['is_active'],
            ]);
        }
    }
}
