<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_question')->nullable();
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->string('show')->nullable();
            $table->string('options')->nullable();

            $table->integer('note_id')->unsigned()->nullable();
            $table->foreign('note_id')->references('id')->on('notes');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
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
        Schema::dropIfExists('test_labs');
    }
}
