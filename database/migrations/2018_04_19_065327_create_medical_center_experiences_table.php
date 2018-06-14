<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalCenterExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_center_experiences', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('description')->nullable();
          $table->integer('medicalCenter_id')->unsigned()->nullable();
          $table->foreign('medicalCenter_id')->references('id')->on('medical_centers');
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
        Schema::dropIfExists('medical_center_experiences');
    }
}
