<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL: ALTER COLUMN to expand the enum to include 'processing' and 'failed'
        DB::statement("ALTER TABLE recommendations MODIFY COLUMN ai_status ENUM('none','pending','approved','rejected','processing','failed') NOT NULL DEFAULT 'none'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE recommendations MODIFY COLUMN ai_status ENUM('none','pending','approved','rejected') NOT NULL DEFAULT 'none'");
    }
};
