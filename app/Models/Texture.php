<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Texture extends Model
{
    protected $fillable = ['name_uz', 'name_ru', 'name_en', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_textures');
    }

    public function getNameAttribute(): string
    {
        $lang = session('lang', 'uz-lat');
        if ($lang === 'ru' && $this->name_ru) return $this->name_ru;
        if ($lang === 'en' && $this->name_en) return $this->name_en;
        return $this->name_uz;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
