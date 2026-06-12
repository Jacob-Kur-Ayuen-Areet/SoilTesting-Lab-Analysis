<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plot', function (Blueprint $table) {
            $table->id('plot_id');
            $table->foreignId('farm_id')->constrained('farms','farm_id');
            $table->string('name')->nullable();
            $table->string('size')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plot');
    }
};
