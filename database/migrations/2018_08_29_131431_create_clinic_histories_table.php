<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('options')->nullable();

            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');

            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
        });

        Schema::create('history_notes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('note_id')->unsigned()->nullable();
            $table->foreign('note_id')->references('id')->on('notes');

            $table->integer('clinic_history_id')->unsigned()->nullable();
            $table->foreign('clinic_history_id')->references('id')->on('clinic_histories');

            $table->string('options')->nullable();
            $table->string('options2')->nullable();

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
        Schema::dropIfExists('clinic_histories');
        Schema::dropIfExists('history_notes');

    }
}
