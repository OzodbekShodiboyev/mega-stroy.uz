<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Texture;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $cats = [
            ['name_uz' => 'Panellar',  'name_ru' => 'Панели',   'name_en' => 'Panels',   'slug' => 'panel',  'sort_order' => 1],
            ['name_uz' => 'Karnizlar', 'name_ru' => 'Карнизы',  'name_en' => 'Cornices', 'slug' => 'karniz', 'sort_order' => 2],
            ['name_uz' => 'Ustunlar',  'name_ru' => 'Колонны',  'name_en' => 'Columns',  'slug' => 'ustun',  'sort_order' => 3],
            ['name_uz' => 'Dekor',     'name_ru' => 'Декор',    'name_en' => 'Decor',    'slug' => 'dekor',  'sort_order' => 4],
        ];
        $categoryMap = [];
        foreach ($cats as $c) {
            $cat = Category::updateOrCreate(['slug' => $c['slug']], $c);
            $categoryMap[$c['slug']] = $cat->id;
        }

        // Units
        $units = [
            ['name_uz' => 'Kvadrat metr', 'name_ru' => 'Квадратный метр', 'name_en' => 'Square meter',  'symbol' => 'm²'],
            ['name_uz' => 'Pogon metr',   'name_ru' => 'Погонный метр',   'name_en' => 'Linear meter',  'symbol' => 'p.m'],
            ['name_uz' => 'Dona',         'name_ru' => 'Штука',           'name_en' => 'Piece',          'symbol' => 'dona'],
        ];
        $unitMap = [];
        foreach ($units as $u) {
            $unit = Unit::updateOrCreate(['symbol' => $u['symbol']], $u);
            $unitMap[$u['symbol']] = $unit->id;
        }

        // Colors
        $colors = [
            ['name_uz' => 'Kumush Tosh',  'name_ru' => 'Серебристый Камень', 'name_en' => 'Silver Stone',  'hex_code' => '#B8B8B8', 'sort_order' => 1],
            ['name_uz' => "Qo'ng'ir Tosh",'name_ru' => 'Коричневый Камень',  'name_en' => 'Brown Stone',   'hex_code' => '#8B7355', 'sort_order' => 2],
            ['name_uz' => 'Oq Marmor',    'name_ru' => 'Белый Мрамор',       'name_en' => 'White Marble',  'hex_code' => '#F5F0E8', 'sort_order' => 3],
            ['name_uz' => 'Antrasit',     'name_ru' => 'Антрацит',           'name_en' => 'Anthracite',    'hex_code' => '#4A4A4A', 'sort_order' => 4],
            ['name_uz' => 'Oltin Qum',    'name_ru' => 'Золотой Песок',      'name_en' => 'Golden Sand',   'hex_code' => '#C9A84C', 'sort_order' => 5],
            ['name_uz' => 'Yashil Mox',   'name_ru' => 'Зелёный Мох',        'name_en' => 'Green Moss',    'hex_code' => '#6B8E6B', 'sort_order' => 6],
            ['name_uz' => 'Qizil G\'isht','name_ru' => 'Красный Кирпич',     'name_en' => 'Red Brick',     'hex_code' => '#B94040', 'sort_order' => 7],
            ['name_uz' => 'Krем',         'name_ru' => 'Кремовый',           'name_en' => 'Cream',         'hex_code' => '#EDE0C8', 'sort_order' => 8],
        ];
        $colorIds = [];
        foreach ($colors as $c) {
            $color = Color::updateOrCreate(['name_uz' => $c['name_uz']], $c);
            $colorIds[] = $color->id;
        }

        // Textures
        $textures = [
            ['name_uz' => 'Tosh',        'name_ru' => 'Камень',      'name_en' => 'Stone',    'sort_order' => 1],
            ["name_uz" => "G'isht",      'name_ru' => 'Кирпич',      'name_en' => 'Brick',    'sort_order' => 2],
            ['name_uz' => 'Yogʻoch',     'name_ru' => 'Дерево',      'name_en' => 'Wood',     'sort_order' => 3],
            ['name_uz' => 'Silliq',      'name_ru' => 'Гладкий',     'name_en' => 'Smooth',   'sort_order' => 4],
            ['name_uz' => '3D Qabartma', 'name_ru' => '3D Рельеф',   'name_en' => '3D Relief','sort_order' => 5],
            ['name_uz' => 'Marmor',      'name_ru' => 'Мрамор',      'name_en' => 'Marble',   'sort_order' => 6],
        ];
        $textureIds = [];
        foreach ($textures as $t) {
            $texture = Texture::updateOrCreate(['name_uz' => $t['name_uz']], $t);
            $textureIds[] = $texture->id;
        }

        // Link products to categories/units and attach colors/textures
        foreach (Product::all() as $product) {
            $updates = [];
            if (!$product->category_id && isset($categoryMap[$product->category])) {
                $updates['category_id'] = $categoryMap[$product->category];
            }
            if (!$product->unit_id && isset($unitMap[$product->unit])) {
                $updates['unit_id'] = $unitMap[$product->unit];
            }
            if ($updates) $product->update($updates);

            $product->colors()->syncWithoutDetaching($colorIds);
            $product->textures()->syncWithoutDetaching($textureIds);
        }
    }
}
