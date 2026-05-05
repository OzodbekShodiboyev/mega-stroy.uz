<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'label', 'type'];

    private static ?array $cache = null;

    private static function loadCache(): void
    {
        if (self::$cache === null) {
            self::$cache = static::query()->pluck('value', 'key')->toArray();
        }
    }

    public static function get(string $key, string $default = ''): string
    {
        self::loadCache();
        return self::$cache[$key] ?? $default;
    }

    public static function flush(): void
    {
        self::$cache = null;
    }
}
