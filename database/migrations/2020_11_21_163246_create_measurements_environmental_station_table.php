<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementsEnvironmentalStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements_environmental_station', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnDelete();

            $table->decimal('temperature', 5, 2);
            $table->decimal('pressure', 5, 2);
            $table->decimal('humidity', 5, 2);
            $table->decimal('carbonMonoxide', 5, 2);
            $table->decimal('carbonDioxide', 5, 2);
            $table->decimal('nitrogenDioxide', 5, 2);
            $table->decimal('hydrogen', 5, 2);
            $table->decimal('PMS7003_MP_1', 5, 2);
            $table->decimal('PMS7003_MP_2_5', 5, 2);
            $table->decimal('PMS7003_MP_10', 5, 2);

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
        Schema::dropIfExists('measurements_environmental_station');
    }
}
