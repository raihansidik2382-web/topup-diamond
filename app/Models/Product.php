<?php

namespace App\Models;

use App\Services\CurrencyService;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = ['game_id', 'name', 'currency_amount', 'price', 'currency', 'description', 'is_active'];

    protected function casts(): array
    {
        return [
            'currency_amount' => 'integer',
            'price' => 'integer',
            'currency' => 'string',
            'is_active' => 'boolean',
        ];
    }

    public function priceInIdr(): Attribute
    {
        return Attribute::get(function () {
            if ($this->currency === 'USD') {
                return App::make(CurrencyService::class)->usdToIdr($this->price);
            }

            return $this->price;
        });
    }

    public function formattedPrice(): Attribute
    {
        return Attribute::get(function () {
            return App::make(CurrencyService::class)->formatIdr($this->price_in_idr);
        });
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
