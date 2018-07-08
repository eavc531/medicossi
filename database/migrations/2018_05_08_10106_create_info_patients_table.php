<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification');
            $table->string('gender');
            $table->string('name');
            $table->string('lastName');
            $table->string('nameComplete');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->string('age')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('dateActivation')->nullable();
            $table->string('status')->default('disabled');
            $table->string('confirmation_code')->nullable();
            $table->string('stateConfirm')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('colony')->nullable();
            $table->string('street')->nullable();
            $table->string('number_ext')->nullable();
            $table->string('number_int')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
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
        Schema::dropIfExists('info_patients');
    }
}
