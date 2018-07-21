<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            //pacientes
            $table->string('patient_add_create')->nullable();
            //mi agenda
            $table->increments('id');
            $table->string('options')->nullable();
            $table->string('cita_patient_create')->nullable();
            $table->string('cita_person_create')->nullable();
            $table->string('cita_edit')->nullable();
            $table->string('cita_refuse')->nullable();
            $table->string('cita_cancel')->nullable();
            $table->string('cita_change_date')->nullable();
            $table->string('cita_confirm')->nullable();
            $table->string('cita_confirm_payment')->nullable();
            $table->string('cita_confirm_completed')->nullable();
            //recordatorios
            $table->string('reminder_create')->nullable();
            $table->string('reminder_delete')->nullable();
            $table->string('reminder_edit')->nullable();
            //horario
            $table->string('edit_schedule')->nullable();
            //INGRESOS
            $table->string('see_income')->nullable();
            //notes
            $table->string('note_create')->nullable();
            $table->string('note_config')->nullable();
            $table->string('note_edit')->nullable();
            $table->string('note_delete')->nullable();
            $table->string('note_pdf')->nullable();
            $table->string('note_move')->nullable();
            //expedient
            //plansController
            $table->string('change_plan')->nullable();
            //comentarios
            $table->string('config_comment_show')->nullable();
            $table->string('config_comment')->nullable();
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
        Schema::dropIfExists('permissions');
    }
}
