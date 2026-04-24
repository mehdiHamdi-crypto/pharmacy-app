<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount_price',
        'stock',
        'image_url',
        'sku',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query, int $threshold = 10)
    {
        return $query->where('stock', '<=', $threshold);
    }

    public function getEffectivePriceAttribute(): float
    {
        return (float) ($this->discount_price ?? $this->price);
    }

    public function getFinalPriceAttribute(): float
    {
        return $this->effective_price;
    }

    public function defaultImageUrl(): string
    {
        return 'https://commons.wikimedia.org/wiki/Special:Redirect/file/VitaminSupplementPills2.jpg';
    }

    public function imageSrc(): string
    {
        if (empty($this->image_url)) {
            return $this->defaultImageUrl();
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
            return $this->image_url;
        }

        if (str_starts_with($this->image_url, 'storage/')) {
            return asset($this->image_url);
        }

        if (str_starts_with($this->image_url, 'images/')) {
            return asset($this->image_url);
        }

        return asset('storage/' . ltrim($this->image_url, '/'));
    }
}
