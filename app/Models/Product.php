<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'category', 'category_id', 'name_uz', 'name_ru', 'name_en',
        'desc_uz', 'desc_ru', 'desc_en',
        'price', 'old_price', 'unit', 'unit_id', 'images', 'badge', 'sku',
        'rating_count', 'rating', 'specs',
        'in_stock', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'images'   => 'array',
        'specs'    => 'array',
        'in_stock' => 'boolean',
        'is_active'=> 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function categoryRel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unitRel()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors')->orderBy('sort_order');
    }

    public function textures()
    {
        return $this->belongsToMany(Texture::class, 'product_textures')->orderBy('sort_order');
    }

    // Display helpers

    public function getCategoryLabelAttribute(): string
    {
        if ($this->categoryRel) return $this->categoryRel->name_uz;
        return match ($this->category) {
            'panel'  => 'Panellar',
            'karniz' => 'Karnizlar',
            'ustun'  => 'Ustunlar',
            'dekor'  => 'Dekor',
            default  => ucfirst($this->category ?? ''),
        };
    }

    public function getUnitLabelAttribute(): string
    {
        if ($this->unitRel) return $this->unitRel->symbol;
        return $this->unit ?? 'm²';
    }

    public function getNameAttribute(): string
    {
        $lang = session('lang', 'uz-lat');
        if ($lang === 'ru' && $this->name_ru) return $this->name_ru;
        if ($lang === 'en' && $this->name_en) return $this->name_en;
        return $this->name_uz;
    }

    public function getDescAttribute(): string
    {
        $lang = session('lang', 'uz-lat');
        if ($lang === 'ru' && $this->desc_ru) return $this->desc_ru;
        if ($lang === 'en' && $this->desc_en) return $this->desc_en;
        return $this->desc_uz ?? '';
    }

    public function getFirstImageAttribute(): string
    {
        $images = $this->images ?? [];
        return $images[0] ?? 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?q=80&w=600';
    }

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price, 0, '.', ',');
    }

    public function getOldPriceFormattedAttribute(): ?string
    {
        return $this->old_price ? number_format($this->old_price, 0, '.', ',') : null;
    }

    public function getBadgeClassAttribute(): string
    {
        return match ($this->badge) {
            'top', 'popular' => 'badge-hit',
            'new'            => 'badge-new',
            'sale'           => 'badge-sale',
            default          => '',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
