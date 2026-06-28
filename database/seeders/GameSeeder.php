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
            ['name' => 'Mobile Legends', 'icon' => 'mlbb.png', 'cover' => 'mlbb-cover.jpg', 'is_active' => true],
            ['name' => 'Free Fire', 'icon' => 'freefire.png', 'cover' => 'freefire-cover.jpg', 'is_active' => true],
            ['name' => 'PUBG Mobile', 'icon' => 'pubg.png', 'cover' => 'pubg-cover.jpg', 'is_active' => true],
            ['name' => 'Genshin Impact', 'icon' => 'genshin.png', 'cover' => 'genshin-cover.jpg', 'is_active' => true],
            ['name' => 'Valorant', 'icon' => 'valorant.png', 'cover' => 'valorant-cover.jpg', 'is_active' => true],
        ];

        foreach ($games as $game) {
            Game::create([
                'name' => $game['name'],
                'slug' => Str::slug($game['name']),
                'icon' => $game['icon'],
                'cover' => $game['cover'],
                'is_active' => $game['is_active'],
            ]);
        }
    }
}
