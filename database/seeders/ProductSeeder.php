<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'slug'      => 'premium-termopanel',
                'category'  => 'panel',
                'name_uz'   => 'Premium Termopanel',
                'name_ru'   => 'Премиум Термопанель',
                'name_en'   => 'Premium Thermopanel',
                'desc_uz'   => 'Yuqori sifatli fibrosement termopanel. Issiqlikni yaxshi saqlaydi, namga va UV nurlariga chidamli. Zavoddan to\'g\'ridan-to\'g\'ri yetkaziladi.',
                'desc_ru'   => 'Высококачественная фиброцементная термопанель. Отличное теплосбережение, устойчива к влаге и УФ-излучению. Прямые поставки с завода.',
                'desc_en'   => 'High-quality fibro-cement thermopanel. Excellent heat retention, moisture and UV resistant. Direct delivery from factory.',
                'price'     => 185000,
                'old_price' => 220000,
                'unit'      => 'm²',
                'badge'     => 'top',
                'sku'       => 'TP-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800',
                    'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Qalinlik',                  'label_ru' => 'Толщина',           'value' => '100 mm'],
                    ['label_uz' => 'Og\'irlik',                 'label_ru' => 'Вес',               'value' => '18 kg/m²'],
                    ['label_uz' => 'Issiqlik o\'tkazuvchanligi','label_ru' => 'Теплопроводность',  'value' => '0.034 W/m·K'],
                    ['label_uz' => 'Temperatura bardoshligi',   'label_ru' => 'Температурная стойкость', 'value' => '-40°C ... +70°C'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 1, 'rating' => 4.8, 'rating_count' => 124,
            ],
            [
                'slug'      => 'klassik-karniz',
                'category'  => 'karniz',
                'name_uz'   => 'Klassik Karniz',
                'name_ru'   => 'Классический Карниз',
                'name_en'   => 'Classic Cornice',
                'desc_uz'   => 'Zamonaviy interyer uchun klassik karniz. Oson o\'rnatiladi, istalgan rang va o\'lchamda buyurtma qilinadi.',
                'desc_ru'   => 'Классический карниз для современного интерьера. Лёгкий монтаж, изготавливается в любом цвете и размере.',
                'desc_en'   => 'Classic cornice for modern interior. Easy installation, available in any color and size.',
                'price'     => 45000,
                'old_price' => null,
                'unit'      => 'p.m',
                'badge'     => 'new',
                'sku'       => 'KR-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1615873968403-89e068629265?w=800',
                    'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Uzunlik',  'label_ru' => 'Длина',  'value' => '2000 mm'],
                    ['label_uz' => 'Kenglik',  'label_ru' => 'Ширина', 'value' => '120 mm'],
                    ['label_uz' => 'Material', 'label_ru' => 'Материал','value' => 'Fibrosement'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 2, 'rating' => 4.5, 'rating_count' => 67,
            ],
            [
                'slug'      => 'dekorativ-ustun',
                'category'  => 'ustun',
                'name_uz'   => 'Dekorativ Ustun',
                'name_ru'   => 'Декоративная Колонна',
                'name_en'   => 'Decorative Column',
                'desc_uz'   => 'Binoni bezash uchun dekorativ ustun. Har qanday arxitektura uslubiga mos, mustahkam va uzoq muddatli.',
                'desc_ru'   => 'Декоративная колонна для украшения здания. Подходит для любого архитектурного стиля, прочная и долговечная.',
                'desc_en'   => 'Decorative column for building decoration. Suitable for any architectural style, strong and long-lasting.',
                'price'     => 320000,
                'old_price' => 380000,
                'unit'      => 'dona',
                'badge'     => 'popular',
                'sku'       => 'UT-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800',
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Balandlik', 'label_ru' => 'Высота',   'value' => '2800 mm'],
                    ['label_uz' => 'Diametr',   'label_ru' => 'Диаметр',  'value' => '200 mm'],
                    ['label_uz' => 'Material',  'label_ru' => 'Материал', 'value' => 'Fibrosement'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 3, 'rating' => 4.7, 'rating_count' => 43,
            ],
            [
                'slug'      => 'fasad-dekori',
                'category'  => 'dekor',
                'name_uz'   => 'Fasad Dekori',
                'name_ru'   => 'Фасадный Декор',
                'name_en'   => 'Facade Decor',
                'desc_uz'   => 'Tashqi fasad uchun dekorativ elementlar. UV nurlariga chidamli, ekologik toza material ishlatilgan.',
                'desc_ru'   => 'Декоративные элементы для внешнего фасада. Устойчивы к УФ-излучению, изготовлены из экологически чистого материала.',
                'desc_en'   => 'Decorative elements for exterior facade. UV resistant, made from eco-friendly materials.',
                'price'     => 95000,
                'old_price' => null,
                'unit'      => 'm²',
                'badge'     => 'sale',
                'sku'       => 'DK-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800',
                    'https://images.unsplash.com/photo-1600047509782-20d39509f26d?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Qalinlik',  'label_ru' => 'Толщина', 'value' => '25 mm'],
                    ['label_uz' => 'Og\'irlik', 'label_ru' => 'Вес',     'value' => '4.5 kg/m²'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 4, 'rating' => 4.3, 'rating_count' => 89,
            ],
            [
                'slug'      => 'slim-panel',
                'category'  => 'panel',
                'name_uz'   => 'Slim Panel',
                'name_ru'   => 'Слим Панель',
                'name_en'   => 'Slim Panel',
                'desc_uz'   => 'Ingichka va yengil fibrosement panel. Ichki va tashqi bezatish uchun ideal, montaj qilish oson.',
                'desc_ru'   => 'Тонкая и лёгкая фиброцементная панель. Идеально для внутренней и внешней отделки, лёгкий монтаж.',
                'desc_en'   => 'Thin and lightweight fibro-cement panel. Ideal for interior and exterior decoration, easy installation.',
                'price'     => 125000,
                'old_price' => 150000,
                'unit'      => 'm²',
                'badge'     => null,
                'sku'       => 'SP-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800',
                    'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Qalinlik',  'label_ru' => 'Толщина', 'value' => '50 mm'],
                    ['label_uz' => 'Og\'irlik', 'label_ru' => 'Вес',     'value' => '8 kg/m²'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 5, 'rating' => 4.6, 'rating_count' => 31,
            ],
            [
                'slug'      => 'lux-karniz',
                'category'  => 'karniz',
                'name_uz'   => 'Lux Karniz',
                'name_ru'   => 'Люкс Карниз',
                'name_en'   => 'Lux Cornice',
                'desc_uz'   => 'Premium sifatdagi lux karniz. Yuksak darajadagi bezak uchun, har qanday rangda buyurtma qilinadi.',
                'desc_ru'   => 'Карниз люкс-класса премиум качества. Для отделки высшего класса, изготавливается в любом цвете.',
                'desc_en'   => 'Premium lux-class cornice. For high-end decoration, available in any color.',
                'price'     => 78000,
                'old_price' => null,
                'unit'      => 'p.m',
                'badge'     => 'top',
                'sku'       => 'LK-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Uzunlik',         'label_ru' => 'Длина',          'value' => '2000 mm'],
                    ['label_uz' => 'Profil balandligi','label_ru' => 'Высота профиля', 'value' => '85 mm'],
                ],
                'in_stock' => false, 'is_active' => true, 'sort_order' => 6, 'rating' => 4.9, 'rating_count' => 18,
            ],
            [
                'slug'      => '3d-termopanel',
                'category'  => 'panel',
                'name_uz'   => '3D Termopanel',
                'name_ru'   => '3D Термопанель',
                'name_en'   => '3D Thermopanel',
                'desc_uz'   => 'Uch o\'lchamli dizaynga ega zamonaviy fibrosement termopanel. Originallik va issiqlik saqlash birlashdi.',
                'desc_ru'   => 'Современная фиброцементная термопанель с трёхмерным дизайном. Оригинальность и теплосбережение в одном.',
                'desc_en'   => 'Modern fibro-cement thermopanel with three-dimensional design. Originality and heat retention combined.',
                'price'     => 215000,
                'old_price' => 250000,
                'unit'      => 'm²',
                'badge'     => 'new',
                'sku'       => 'TP-3D',
                'images'    => [
                    'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=800',
                    'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Qalinlik',                'label_ru' => 'Толщина',               'value' => '120 mm'],
                    ['label_uz' => 'Og\'irlik',               'label_ru' => 'Вес',                   'value' => '22 kg/m²'],
                    ['label_uz' => 'Temperatura bardoshligi', 'label_ru' => 'Температурная стойкость','value' => '-50°C ... +80°C'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 7, 'rating' => 4.7, 'rating_count' => 56,
            ],
            [
                'slug'      => 'gips-bezak',
                'category'  => 'dekor',
                'name_uz'   => 'Gips Bezak',
                'name_ru'   => 'Гипсовый Декор',
                'name_en'   => 'Gypsum Decor',
                'desc_uz'   => 'An\'anaviy gips uslubida bezak. Ichki va tashqi bezak uchun, klassik va zamonaviy interyer uchun mos.',
                'desc_ru'   => 'Декор в традиционном гипсовом стиле. Для внутренней и внешней отделки, подходит для классического и современного интерьера.',
                'desc_en'   => 'Decoration in traditional gypsum style. For interior and exterior use, suitable for classic and modern interiors.',
                'price'     => 55000,
                'old_price' => null,
                'unit'      => 'dona',
                'badge'     => null,
                'sku'       => 'GP-001',
                'images'    => [
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                ],
                'specs' => [
                    ['label_uz' => 'Material',  'label_ru' => 'Материал', 'value' => 'Gips'],
                    ['label_uz' => 'Og\'irlik', 'label_ru' => 'Вес',      'value' => '2.1 kg'],
                ],
                'in_stock' => true, 'is_active' => true, 'sort_order' => 8, 'rating' => 4.4, 'rating_count' => 72,
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
