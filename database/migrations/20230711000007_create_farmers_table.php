<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id('farmer_id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('country_id')->constrained('countries', 'country_id');
            $table->foreignId('province_id')->constrained('provinces', 'province_id');
            $table->foreignId('district_id')->constrained('districts', 'district_id');
            $table->foreignId('city_id')->constrained('cities', 'city_id');
            $table->string('farmer_name')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmers');
    }
};
