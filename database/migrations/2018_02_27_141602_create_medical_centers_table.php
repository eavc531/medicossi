<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_medicalCenter')->nullable();
            $table->string('name');
            $table->string('activePlan')->nullable();
            $table->string('emailAdmin',60);
            $table->string('nameAdmin');
            $table->string('phone_admin')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('city')->nullable();
            $table->string('billingData')->nullable();
            $table->string('meansOfRecords')->nullable() ;
            $table->string('confirmation_code')->nullable();
            $table->string('statuss')->nullable();
            $table->integer('id_promoter')->nullable();
            $table->string('plan')->nullable();
            $table->DateTime('activationPlan')->nullable();
            $table->string('role')->default('medical_center');
            $table->string('password')->nullable();
            $table->string('country')->default('Mexíco');
            $table->string('email_institution')->nullable();
            $table->string('sanitary_license')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('colony')->nullable();
            $table->string('street')->nullable();
            $table->string('number_ext')->nullable();
            $table->string('number_int')->nullable();
            $table->string('description')->nullable();
            $table->string('longitud')->nullable();
            $table->string('latitud')->nullable();
            $table->string('stateAccount')->default('Desactivada');
            $table->integer('promoter_id')->unsigned()->nullable();
            $table->foreign('promoter_id')->references('id')->on('promoters');
            $table->string('type_patient_service')->nullable();

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
        Schema::dropIfExists('medical_centers');
    }
}
