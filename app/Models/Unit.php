<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name_uz', 'name_ru', 'name_en', 'symbol'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute(): string
    {
        $lang = session('lang', 'uz-lat');
        if ($lang === 'ru' && $this->name_ru) return $this->name_ru;
        if ($lang === 'en' && $this->name_en) return $this->name_en;
        return $this->name_uz;
    }
}
