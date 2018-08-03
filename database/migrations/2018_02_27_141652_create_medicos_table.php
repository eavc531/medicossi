<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification')->nullable();
            $table->string('name');
            $table->string('lastName');
            $table->string('nameComplete')->nullable();
            $table->string('gender');
            $table->string('email',60);
            $table->string('password');
            $table->integer('medicalCenter_id')->unsigned()->nullable();
            $table->foreign('medicalCenter_id')->references('id')->on('medical_centers');
            $table->string('phone')->nullable();
            $table->string('id_promoter')->nullable();
            $table->string('showNumber')->default('no');
            $table->string('showNumberOffice')->default('no');
            $table->string('phoneOffice1')->nullable();
            $table->string('phoneOffice2')->nullable();
            $table->string('specialty')->nullable();
            $table->string('sub_specialty')->nullable();
            $table->string('role')->default('medico');
            $table->string('stateConfirm')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states');
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
            $table->string('name_comercial')->nullable();
            $table->string('password_unique')->nullable();
            $table->string('type_consulting_room')->nullable();
            $table->string('stateAccount')->default('Desactivada');
            $table->integer('promoter_id')->unsigned()->nullable();
            $table->foreign('promoter_id')->references('id')->on('promoters');
            $table->integer('notification_number')->default(0);
            $table->string('type_patient_service')->nullable();
            $table->string('calification')->nullable();
            $table->string('votes')->default(0);
            $table->string('show_comentary')->default('No');
            $table->string('plan')->nullable();
            $table->string('specialty_category')->nullable();
            // $table->integer('plan_active_id')->unsigned()->nullable();
            // $table->foreign('plan_active_id')->references('id')->on('plan_actives');
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
        Schema::dropIfExists('medicos');
    }
}
