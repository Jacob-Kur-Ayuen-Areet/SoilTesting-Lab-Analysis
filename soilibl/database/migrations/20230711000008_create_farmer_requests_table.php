<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('farmer_requests', function (Blueprint $table) {
            $table->id('request_id');
            $table->foreignId('farmer_id')->constrained('farmers','farmer_id');
            $table->bigInteger('farm_id')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->integer('number_of_samples')->nullable();
            $table->date('earliest_date_of_collection')->nullable();
            $table->string('farm_name')->nullable();
            $table->date('date_received')->nullable();
            $table->date('date_sampled')->nullable();
            $table->string('ica_locality')->nullable();
            $table->string('email')->nullable();
            $table->string('advisor_name')->nullable();
            $table->enum('approved', ['Y', 'N'])->nullable();
            $table->integer('average_sub_samples_taken')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farmer_requests');
    }
};
