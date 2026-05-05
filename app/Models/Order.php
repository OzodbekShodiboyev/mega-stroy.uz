<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id', 'name', 'phone',
        'color', 'texture', 'qty', 'unit_price', 'total_price',
        'notes', 'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'new'        => 'Yangi',
            'processing' => 'Jarayonda',
            'completed'  => 'Bajarildi',
            'cancelled'  => 'Bekor qilindi',
            default      => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'new'        => '#C9A84C',
            'processing' => '#3498db',
            'completed'  => '#2ecc71',
            'cancelled'  => '#e74c3c',
            default      => '#888',
        };
    }
}
