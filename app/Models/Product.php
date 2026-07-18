<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'material', 'weight',
        'price', 'sale_price', 'is_active', 'is_featured', 'is_new',
        'sold_count', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Accessors
    public function getDisplayPriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->sale_price || $this->sale_price >= $this->price) return 0;
        return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function getFirstImageAttribute(): string
    {
        return $this->images->first()?->path ?? 'assets/images/product-1.png';
    }

    public function getColorsAttribute(): array
    {
        return $this->variants
            ->unique('color_name')
            ->map(fn($v) => ['name' => $v->color_name, 'hex' => $v->color_hex])
            ->values()
            ->toArray();
    }

    public function getSizesAttribute(): array
    {
        return $this->variants->pluck('size')->unique()->values()->toArray();
    }

    public function getTotalStockAttribute(): int
    {
        return $this->variants->sum('stock');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeOnSale($query)
    {
        return $query->whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price');
    }

    public function scopeInCategory($query, $categorySlug)
    {
        return $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
    }
}
