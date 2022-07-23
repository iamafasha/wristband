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
        Schema::create('patient_device_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_device_id')->constrained();
            $table->unsignedBigInteger('temperature')->nullable();
            $table->unsignedBigInteger('heart_rate')->nullable();
            $table->unsignedBigInteger('blood_pressure')->nullable();
            $table->unsignedBigInteger('oxygen_saturation')->nullable();
            $table->unsignedBigInteger('respiratory_rate')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('patient_device_readings');
    }
};
