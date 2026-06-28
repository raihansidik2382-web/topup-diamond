<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            'Mobile Legends' => [
                ['name' => '86 Diamonds', 'currency_amount' => 86, 'price' => 5000],
                ['name' => '172 Diamonds', 'currency_amount' => 172, 'price' => 10000],
                ['name' => '344 Diamonds', 'currency_amount' => 344, 'price' => 25000],
                ['name' => '706 Diamonds', 'currency_amount' => 706, 'price' => 50000],
                ['name' => '1440 Diamonds', 'currency_amount' => 1440, 'price' => 100000],
                ['name' => 'Twilight Pass', 'currency_amount' => 0, 'price' => 150000],
            ],
            'Free Fire' => [
                ['name' => '70 Diamonds', 'currency_amount' => 70, 'price' => 5000],
                ['name' => '140 Diamonds', 'currency_amount' => 140, 'price' => 10000],
                ['name' => '355 Diamonds', 'currency_amount' => 355, 'price' => 25000],
                ['name' => '720 Diamonds', 'currency_amount' => 720, 'price' => 50000],
                ['name' => '1450 Diamonds', 'currency_amount' => 1450, 'price' => 100000],
                ['name' => 'Membership Mingguan', 'currency_amount' => 0, 'price' => 15000],
            ],
            'PUBG Mobile' => [
                ['name' => '60 UC', 'currency_amount' => 60, 'price' => 5000],
                ['name' => '180 UC', 'currency_amount' => 180, 'price' => 15000],
                ['name' => '325 UC', 'currency_amount' => 325, 'price' => 25000],
                ['name' => '660 UC', 'currency_amount' => 660, 'price' => 50000],
                ['name' => '1800 UC', 'currency_amount' => 1800, 'price' => 150000],
                ['name' => 'Royal Pass', 'currency_amount' => 0, 'price' => 80000],
            ],
            'Genshin Impact' => [
                ['name' => '60 Genesis Crystals', 'currency_amount' => 60, 'price' => 15000],
                ['name' => '300 Genesis Crystals', 'currency_amount' => 300, 'price' => 75000],
                ['name' => '980 Genesis Crystals', 'currency_amount' => 980, 'price' => 150000],
                ['name' => '1980 Genesis Crystals', 'currency_amount' => 1980, 'price' => 300000],
                ['name' => 'Blessing of the Welkin Moon', 'currency_amount' => 0, 'price' => 65000],
                ['name' => 'Battle Pass Gnostic Hymn', 'currency_amount' => 0, 'price' => 120000],
            ],
            'Valorant' => [
                ['name' => '475 Valorant Points', 'currency_amount' => 475, 'price' => 50000],
                ['name' => '1000 Valorant Points', 'currency_amount' => 1000, 'price' => 100000],
                ['name' => '2050 Valorant Points', 'currency_amount' => 2050, 'price' => 200000],
                ['name' => '3650 Valorant Points', 'currency_amount' => 3650, 'price' => 350000],
                ['name' => '5350 Valorant Points', 'currency_amount' => 5350, 'price' => 500000],
                ['name' => '11000 Valorant Points', 'currency_amount' => 11000, 'price' => 1000000],
            ],
        ];

        foreach ($products as $gameName => $gameProducts) {
            $game = Game::where('name', $gameName)->first();

            if (! $game) {
                continue;
            }

            foreach ($gameProducts as $product) {
                Product::create([
                    'game_id' => $game->id,
                    'name' => $product['name'],
                    'currency_amount' => $product['currency_amount'],
                    'price' => $product['price'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
