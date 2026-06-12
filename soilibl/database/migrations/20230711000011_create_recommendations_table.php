<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id('reco_id');
            $table->foreignId('sample_id')->constrained('soil_samples','sample_id');
            $table->foreignId('partner_id')->constrained('users');
            $table->string('file_path')->nullable();
            $table->enum('approved', ['Y', 'N'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('uploaded_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
          
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
};
