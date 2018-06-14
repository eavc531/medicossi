<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type')->default('saved');
            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->longText('Signos_vitales')->nullable();
            $table->string('Motivo_de_atencion')->nullable();
            $table->string('Exploracion_fisica')->nullable();
            $table->longText('Pruebas_de_laboratorio')->nullable();
            $table->longText('Diagnostico')->nullable();
            $table->longText('Afeccion_principal_o_motivo_de_consulta')->nullable();
            $table->longText('Afeccion_secundaria')->nullable();
            $table->longText('Pronostico')->nullable();
            $table->longText('Tratamiento_y_o_recetas')->nullable();
            $table->longText('Indicaciones_terapeuticas')->nullable();
            $table->longText('Estado_mental')->nullable();
            $table->longText('Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico')->nullable();
            $table->longText('Manejo_durante_la_estancia_hospitalaria')->nullable();
            $table->longText('Recomendaciones_para_vigilancia_ambulatoira')->nullable();
            $table->longText('Otros_datos')->nullable();
            $table->longText('Motivo_de_envio')->nullable();
            $table->longText('Evolucion_y_actualizacion_del_cuadro_clinico')->nullable();
            $table->longText('Motivo_del_egreso')->nullable();
            $table->longText('Diagnosticos_finales')->nullable();
            $table->longText('Resumen_de_evolucion_y_estado_actual')->nullable();
            $table->longText('Problemas_clinicos_pendientes')->nullable();
            $table->longText('Plan_de_manejo_y_tratamiento')->nullable();
            $table->longText('Establecimiento_que_envia')->nullable();
            $table->longText('Establecimiento_receptor')->nullable();
            $table->longText('Sugerencias_y_tratamiento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_egreso')->nullable();
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
        Schema::dropIfExists('notes');
    }
}
