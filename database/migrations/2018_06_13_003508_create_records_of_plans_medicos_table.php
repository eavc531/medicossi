<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsOfPlansMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records_of_plans_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->integer('promoter_id')->unsigned()->nullable();
            $table->foreign('promoter_id')->references('id')->on('promoters');
            $table->string('name');
            $table->float('price');
            // $table->float('price_total');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('period');
            $table->float('comision');
            $table->string('state_payment')->default('no');
            $table->date('date_payment')->nullable();


            $table->string('name_banco')->nullable();
            $table->string('number_account')->nullable();
            $table->string('name_titular')->nullable();
            $table->string('identification')->nullable();
            $table->string('email')->nullable();

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
        Schema::dropIfExists('records_of_plans_medicos');
    }
}
