<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'description',
        'price', 'discount_price',
        'stock', 'image_url', 'sku', 'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'price'          => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($q)     { return $q->where('is_active', true); }
    public function scopeLowStock($q, int $t = 10) { return $q->where('stock', '<=', $t); }

    // Prix effectif (avec promo éventuelle)
    public function getEffectivePriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }
}