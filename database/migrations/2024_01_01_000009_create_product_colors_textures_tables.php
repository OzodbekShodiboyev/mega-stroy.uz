<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained()->cascadeOnDelete();
            $table->primary(['product_id', 'color_id']);
        });

        Schema::create('product_textures', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('texture_id')->constrained()->cascadeOnDelete();
            $table->primary(['product_id', 'texture_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_textures');
        Schema::dropIfExists('product_colors');
    }
};
