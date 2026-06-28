<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = ['game_id', 'name', 'currency_amount', 'price', 'description', 'is_active'];

    protected function casts(): array
    {
        return [
            'currency_amount' => 'integer',
            'price' => 'integer',
            'is_active' => 'boolean',
        ];
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
