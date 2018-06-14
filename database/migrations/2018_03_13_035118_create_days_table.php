<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('hour_ini');
            $table->string('hour_end');
            $table->integer('medical_center_id')->unsigned()->nullable();
            $table->foreign('medical_center_id')->references('id')->on('medical_centers');
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
        Schema::dropIfExists('days');
    }
}

// $table->increments('id');
// $table->string('name');
// $table->integer('month_id')->unsigned();
// $table->foreign('month_id')->references('id')->on('months');
