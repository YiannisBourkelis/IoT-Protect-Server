<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmokeDetectorMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements_smoke_detector', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices');

            $table->integer('photoresistor');
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
        Schema::dropIfExists('measurements_smoke_detector');
    }
}
