<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateMedicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_medics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question1')->nullable();
            $table->string('answer1')->nullable();
            $table->string('question2')->nullable();
            $table->string('answer2')->nullable();
            $table->string('question3')->nullable();
            $table->string('answer3')->nullable();
            $table->string('question4')->nullable();
            $table->string('answer4')->nullable();
            $table->string('question5')->nullable();
            $table->string('answer5')->nullable();
            $table->string('question6')->nullable();
            $table->string('answer6')->nullable();
            $table->string('question7')->nullable();
            $table->string('answer7')->nullable();
            $table->string('rate')->nullable();
            $table->string('votes')->nullable();
            $table->string('show')->nullable();
            $table->string('views')->nullable();
            $table->string('renews')->nullable();


            $table->string('options')->nullable();
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
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
        Schema::dropIfExists('rate_medics');
    }
}
