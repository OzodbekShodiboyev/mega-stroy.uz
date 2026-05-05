<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Contact
            ['key' => 'phone_1',       'value' => '+998 97 411 11 51',                                                  'label' => 'Asosiy telefon',        'type' => 'phone'],
            ['key' => 'phone_2',       'value' => '+998 99 433 00 47',                                                  'label' => 'Qo\'shimcha telefon',    'type' => 'phone'],
            // Showroom
            ['key' => 'address',       'value' => 'Toshkent viloyati, Yuqori-Chirchiq tumani, Iyk ota MFY, R/Z uy',    'label' => 'Showroom manzili',      'type' => 'textarea'],
            ['key' => 'work_hours',    'value' => 'Du-Sha: 09:00 — 18:00',                                              'label' => 'Ish vaqti',             'type' => 'text'],
            // Factory
            ['key' => 'factory_address','value'=> 'Toshkent viloyati, Yuqori-Chirchiq tumani, Sanoat zonasi',           'label' => 'Zavod manzili',         'type' => 'textarea'],
            ['key' => 'factory_note',  'value' => 'Zavodga tashrif uchun avval telefon orqali bog\'laning.',            'label' => 'Zavod izohi',           'type' => 'text'],
            ['key' => 'factory_hours', 'value' => '',                                                                   'label' => 'Zavod ish vaqti',       'type' => 'text'],
            // Social
            ['key' => 'social_telegram',  'value' => 'https://t.me/megastroyuz', 'label' => 'Telegram',  'type' => 'url'],
            ['key' => 'social_instagram', 'value' => '',                          'label' => 'Instagram', 'type' => 'url'],
            ['key' => 'social_youtube',   'value' => '',                          'label' => 'YouTube',   'type' => 'url'],
            ['key' => 'social_facebook',  'value' => '',                          'label' => 'Facebook',  'type' => 'url'],
        ];

        foreach ($settings as $s) {
            SiteSetting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
