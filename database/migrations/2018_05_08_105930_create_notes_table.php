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

            $table->string('Signos_vitales_show')->default('si');
            $table->string('Motivo_de_atencion_show')->default('si');
            $table->string('Exploracion_fisica_show')->default('si');
            $table->string('Pruebas_de_laboratorio_show')->default('si');
            $table->string('Diagnostico_show')->default('si');
            $table->string('Afeccion_principal_o_motivo_de_consulta_show')->default('si');
            $table->string('Afeccion_secundaria_show')->default('si');
            $table->string('Pronostico_show')->default('si');
            $table->string('Tratamiento_y_o_recetas_show')->default('si');
            $table->string('Indicaciones_terapeuticas_show')->default('si');
            $table->string('Estado_mental_show')->default('si');
            $table->string('Resultados_relevantes_show')->default('si');
            $table->string('Manejo_durante_la_estancia_hospitalaria_show')->default('si');
            $table->string('Recomendaciones_para_vigilancia_ambulatoira_show')->default('si');
            $table->string('Otros_datos_show')->default('si');
            $table->string('Motivo_de_envio_show')->default('si');
            $table->string('Evolucion_y_actualizacion_del_cuadro_clinico_show')->default('si');
            $table->string('Motivo_del_egreso_show')->default('si');
            $table->string('Diagnosticos_finales_show')->default('si');
            $table->string('Resumen_de_evolucion_y_estado_actual_show')->default('si');
            $table->string('Problemas_clinicos_pendientes_show')->default('si');
            $table->string('Plan_de_manejo_y_tratamiento_show')->default('si');
            $table->string('Establecimiento_que_envia_show')->default('si');
            $table->string('Establecimiento_receptor_show')->default('si');
            $table->string('Sugerencias_y_tratamiento_show')->default('si');

            $table->integer('expedient_id')->unsigned()->nullable();
            $table->foreign('expedient_id')->references('id')->on('expedients');

            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_egreso')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_edit')->nullable();
            $table->string('deleted')->nullable();
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
