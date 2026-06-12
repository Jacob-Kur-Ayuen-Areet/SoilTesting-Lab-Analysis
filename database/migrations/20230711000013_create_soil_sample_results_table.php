<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('soil_sample_results', function (Blueprint $table) {
            $table->id('result_id');
            $table->foreignId('request_id')->nullable()->constrained('farmer_requests','request_id');
            $table->foreignId('sample_id')->nullable()->constrained('soil_samples','sample_id');
            $table->string('laboratory_number')->nullable();
            $table->foreignId('lab_user_id')->nullable()->constrained('users','id');
            $table->decimal('ph_cacl2', 4, 2)->nullable();
            $table->string('colour')->nullable();
            $table->string('texture')->nullable();
            $table->decimal('percentage_sand', 5, 2)->nullable();
            $table->decimal('percentage_silt', 5, 2)->nullable();
            $table->decimal('percentage_clay', 5, 2)->nullable();
            $table->decimal('min_initial_n', 5, 2)->nullable();
            $table->decimal('p2o5_ppm', 5, 2)->nullable();
            $table->decimal('k', 5, 2)->nullable();
            $table->decimal('mg', 5, 2)->nullable();
            $table->decimal('ca', 5, 2)->nullable();
            $table->decimal('zn', 5, 2)->nullable();
            $table->decimal('cu', 5, 2)->nullable();
            $table->enum('approved', ['Y', 'N'])->nullable();
            $table->foreignId('approved_by_user_id')->nullable()->constrained('users','id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soil_sample_results');
    }
};
