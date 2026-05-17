<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'keywords',
        'description',
        'detail',
        'image',
        'price',
        'stock',
        'minstock',
        'discount',
        'status',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'stock'    => 'integer',
        'minstock' => 'integer',
        'discount' => 'integer',
        'status'   => 'integer',
    ];

    // Her ürün bir kategoriye aittir
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Her ürün bir kullanıcıya aittir
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // İndirimli fiyat hesaplama
    public function getDiscountedPriceAttribute(): float
    {
        if ($this->discount > 0) {
            return $this->price * (1 - $this->discount / 100);
        }
        return $this->price;
    }

    // Stok kritik mi?
    public function getLowStockAttribute(): bool
    {
        return $this->stock <= $this->minstock && $this->minstock > 0;
    }
}
