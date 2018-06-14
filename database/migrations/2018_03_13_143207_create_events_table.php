<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title')->nullable();
          $table->string('description')->nullable();
          $table->string('start');
          $table->string('end')->nullable();
          $table->string('hour_start')->nullable();
          $table->string('hour_end')->nullable();
          $table->string('eventType')->nullable();
          $table->datetime('dateStart')->nullable();
          $table->datetime('dateEnd')->nullable();
          $table->string('color')->nullable();
          $table->string('rendering')->nullable();
          $table->string('dow')->nullable();
          $table->biginteger('price')->nullable();
          $table->integer('medico_id')->unsigned()->nullable();
          $table->foreign('medico_id')->references('id')->on('medicos');
          $table->integer('patient_id')->unsigned()->nullable();
          $table->foreign('patient_id')->references('id')->on('patients');
          $table->string('namePatient')->nullable();
          $table->string('state')->default('Pendiente');
          $table->integer('score')->nullable();
          $table->string('calification')->nullable();
          $table->string('comentary')->nullable();
          $table->string('stipulated')->default('patient');
          $table->string('notification')->nullable();
          $table->string('show_comentary')->default('no');
          $table->string('status')->nullable('sin_status');
          $table->string('payment_method')->nullable();
          $table->string('confirmed_medico')->default('No');
          $table->string('confirmed_patient')->default('No');
          $table->string('payment_state')->default('No');

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
        Schema::dropIfExists('events');
    }
}
