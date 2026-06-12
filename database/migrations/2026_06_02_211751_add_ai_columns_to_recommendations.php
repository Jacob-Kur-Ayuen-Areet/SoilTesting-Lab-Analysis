<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->longText('ai_text')->nullable()->after('notes');
            $table->enum('ai_status', ['none', 'pending', 'approved', 'rejected'])->default('none')->after('ai_text');
        });
    }

    public function down()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->dropColumn(['ai_text', 'ai_status']);
        });
    }
};
