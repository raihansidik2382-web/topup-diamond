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
            ['name' => 'Mobile Legends', 'icon' => 'mlbb.png', 'is_active' => true],
            ['name' => 'Free Fire', 'icon' => 'freefire.png', 'is_active' => true],
            ['name' => 'PUBG Mobile', 'icon' => 'pubg.png', 'is_active' => true],
            ['name' => 'Genshin Impact', 'icon' => 'genshin.png', 'is_active' => true],
            ['name' => 'Valorant', 'icon' => 'valorant.png', 'is_active' => true],
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
