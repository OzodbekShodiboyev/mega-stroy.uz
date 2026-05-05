<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('category', ['panel', 'karniz', 'ustun', 'dekor'])->default('panel');
            $table->string('name_uz');
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->text('desc_uz')->nullable();
            $table->text('desc_ru')->nullable();
            $table->text('desc_en')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('old_price')->nullable();
            $table->string('unit', 20)->default('m²');
            $table->json('images')->nullable();
            $table->string('badge', 20)->nullable();
            $table->string('sku', 30)->nullable();
            $table->integer('rating_count')->default(0);
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->json('specs')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
