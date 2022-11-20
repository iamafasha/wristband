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
        Schema::table('patient_device_readings', function (Blueprint $table) {
            //from blood_pressure to diastolic table
            // $table->renameColumn('blood_pressure','diastolic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_device_readings', function (Blueprint $table) {
            // $table->renameColumn('diastolic','blood_pressure');
        });
    }
};
