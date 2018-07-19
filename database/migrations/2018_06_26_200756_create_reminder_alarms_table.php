<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_alarms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('start');
            $table->string('end');
            $table->date('hour_start')->nullable();
            $table->date('hour_end')->nullable();
            $table->string('state')->nullable();
            $table->string('eventType')->nullable();
            $table->string('dow')->nullable();
            $table->string('rendering')->nullable();
            $table->string('color')->nullable();
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events');
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
        Schema::dropIfExists('reminder_alarms');
    }
}
