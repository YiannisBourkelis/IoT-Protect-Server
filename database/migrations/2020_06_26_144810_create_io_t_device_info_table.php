<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIoTDeviceInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iot_device_info', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //
            $table->string('place', 30);
            $table->string('spot', 30);
            $table->unsignedTinyInteger('model');
            $table->unsignedTinyInteger('revision');
            
            //foreign keys
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iot_device_info');
    }
}
