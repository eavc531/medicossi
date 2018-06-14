<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('institution');
            $table->string('specialty');
            $table->datetime('from');
            $table->datetime('until');
            $table->string('state');
            $table->string('aditional')->nullable();
            $table->integer('medico_id')->unsigned();
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
        Schema::dropIfExists('info_medicos');
    }
}
