<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id('farm_id');
            $table->string('farm_name')->nullable();
            $table->foreignId('farmer_id')->constrained('farmers','farmer_id');
            $table->string('postal_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('size', 30)->nullable();
            $table->string('lat', 30)->nullable();
            $table->string('long', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farms');
    }
};
