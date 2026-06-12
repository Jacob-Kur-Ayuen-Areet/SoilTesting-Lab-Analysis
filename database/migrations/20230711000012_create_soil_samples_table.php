<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('soil_samples', function (Blueprint $table) {
            $table->id('sample_id');
            $table->foreignId('request_id')->constrained('farmer_requests','request_id');
            $table->string('laboratory_number')->nullable()->unique();
            $table->foreignId('plot_id')->constrained('plot','plot_id');
            $table->string('sample_reference')->nullable();
            $table->string('type_of_previous_crop')->nullable();
            $table->date('date_of_ploughing')->nullable();
            $table->date('date_planted')->nullable();
            $table->string('previous_crop_yield')->nullable();
            $table->string('crop')->nullable();
            $table->enum('crop_to_be_irrigated', ['Y', 'N'])->nullable();
            $table->date('planting_date')->nullable();
            $table->integer('plant_pop_per_ha')->nullable();
            $table->string('yield_target_kg_per_ha')->nullable();
            $table->string('land_size')->nullable();
            $table->enum('manure_to_be_used', ['Y', 'N'])->nullable();
            $table->enum('fertilizer_to_be_used', ['Y', 'N'])->nullable();
            $table->string('lat', 20)->nullable();
            $table->string('long', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soil_samples');
    }
};
