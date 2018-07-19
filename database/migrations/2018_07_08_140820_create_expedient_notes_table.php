<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedient_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_edit')->nullable();
            $table->integer('expedient_id')->unsigned()->nullable();
            $table->foreign('expedient_id')->references('id')->on('expedients');
            $table->integer('note_id')->unsigned()->nullable();
            $table->foreign('note_id')->references('id')->on('notes');

            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->string('show')->default('si');
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
        Schema::dropIfExists('expedient_notes');
    }
}
