<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    private const API_URL = 'https://api.frankfurter.app/latest?from=USD&to=IDR';

    private const CACHE_KEY = 'usd_idr_rate';

    private const CACHE_TTL = 3600;

    public function usdToIdr(float $amount): int
    {
        $rate = $this->getRate();

        return (int) round($amount * $rate);
    }

    public function idrToUsd(int $amount): float
    {
        $rate = $this->getRate();

        if ($rate <= 0) {
            return 0;
        }

        return round($amount / $rate, 2);
    }

    public function formatUsd(float $amount): string
    {
        return '$ '.number_format($amount, 2, '.', ',');
    }

    public function getRate(): float
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $response = Http::timeout(5)->retry(2, 100)->get(self::API_URL);

            if ($response->failed()) {
                return $this->fallbackRate();
            }

            return (float) ($response->json('rates.IDR') ?? $this->fallbackRate());
        });
    }

    public function formatIdr(int $amount): string
    {
        return 'Rp '.number_format($amount, 0, ',', '.');
    }

    private function fallbackRate(): float
    {
        return (float) Cache::get(self::CACHE_KEY, 16000);
    }
}
