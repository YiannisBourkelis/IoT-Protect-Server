<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceColumnsToTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('place',64)->nullable();
            $table->string('location',64)->nullable();
            $table->unsignedTinyInteger('type')->default(0);
            $table->unsignedTinyInteger('model')->nullable();
            $table->unsignedTinyInteger('revision')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('place', 'location', 'type', 'model', 'revision');
        });
    }
}
