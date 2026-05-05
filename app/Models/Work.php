<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Work extends Model
{
    protected $fillable = ['image', 'caption_uz', 'caption_ru', 'caption_en', 'sort_order'];

    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }
}
