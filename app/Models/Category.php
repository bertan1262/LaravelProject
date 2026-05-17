<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    // Üst kategori
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Alt kategoriler
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Ürünler
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Tam kategori yolunu döndür: "Elektronik > Telefon > Akıllı Telefon"
    public function getFullPathAttribute(): string
    {
        $parts = [$this->name];
        $current = $this;

        while ($current->parent) {
            array_unshift($parts, $current->parent->name);
            $current = $current->parent;
        }

        return implode(' > ', $parts);
    }
}
