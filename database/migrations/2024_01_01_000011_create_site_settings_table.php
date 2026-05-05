<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('label');
            $table->string('type')->default('text'); // text, url, phone, textarea
            $table->timestamps();
        });

        // Seed default values
        DB::table('site_settings')->insert([
            ['key' => 'phone_1',           'value' => '+998 97 411 11 51', 'label' => 'Asosiy telefon',        'type' => 'phone',    'created_at' => now(), 'updated_at' => now()],
            ['key' => 'phone_2',           'value' => '+998 99 433 00 47', 'label' => 'Qo\'shimcha telefon',   'type' => 'phone',    'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address',           'value' => 'Toshkent viloyati, Yuqori-Chirchiq tumani, Iyk ota MFY. R/Z uy', 'label' => 'Manzil', 'type' => 'textarea', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_telegram',   'value' => 'https://t.me/megastroyuz', 'label' => 'Telegram',      'type' => 'url',      'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_instagram',  'value' => '',                  'label' => 'Instagram',             'type' => 'url',      'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_youtube',    'value' => '',                  'label' => 'YouTube',               'type' => 'url',      'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_facebook',   'value' => '',                  'label' => 'Facebook',              'type' => 'url',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
