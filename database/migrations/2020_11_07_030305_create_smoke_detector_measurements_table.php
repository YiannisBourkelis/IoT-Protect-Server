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

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnDelete();

            $table->unsignedSmallInteger('photoresistor')->nullable();
            $table->unsignedSmallInteger('battery_voltage')->nullable();
            $table->string('uptime',64)->nullable();
            $table->unsignedSmallInteger('boot_count')->nullable();
            $table->unsignedTinyInteger('wakeup_reason')->nullable();
        
            $table->timestamps();

            $table->index(['created_at']);
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
