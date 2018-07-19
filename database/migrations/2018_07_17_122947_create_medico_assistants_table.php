<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicoAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_assistants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->integer('assistant_id')->unsigned()->nullable();
            $table->foreign('assistant_id')->references('id')->on('assistants');
            $table->string('state')->nullable();
            $table->string('options')->nullable();
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
        Schema::dropIfExists('medico_assistants');
    }
}
