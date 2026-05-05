<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Change ENUM to VARCHAR(80) — keeps existing values intact
        DB::statement("ALTER TABLE products MODIFY COLUMN category VARCHAR(80) NULL DEFAULT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE products MODIFY COLUMN category ENUM('panel','karniz','ustun','dekor') NOT NULL DEFAULT 'panel'");
    }
};
