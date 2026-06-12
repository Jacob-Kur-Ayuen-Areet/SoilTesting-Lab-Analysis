<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soil_sample_results', function (Blueprint $table) {
            $table->longText('ai_analysis')->nullable()->after('approved_by_user_id');
            $table->enum('ai_analysis_status', ['none', 'pending', 'approved', 'rejected'])->default('none')->after('ai_analysis');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soil_sample_results', function (Blueprint $table) {
            $table->dropColumn(['ai_analysis', 'ai_analysis_status']);
        });
    }
};
