<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{
  protected $fillable = [
    'title',
    'type',
    'patient_id',
    'medico_id',
    'Signos_vitales',
    'Motivo_de_atencion',
    'Exploracion_fisica',
    'Pruebas_de_laboratorio',
    'Diagnostico',
    'Afeccion_principal_o_motivo_de_consulta',
    'Afeccion_secundaria',
    'Pronostico',
    'Tratamiento_y_o_recetas',
    'Indicaciones_terapeuticas',
    'Estado_mental',
    'Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico',
    'Manejo_durante_la_estancia_hospitalaria',
    'Recomendaciones_para_vigilancia_ambulatoira',
    'Otros_datos',
    'Motivo_de_envio',
    'Evolucion_y_actualizacion_del_cuadro_clinico',
    'Motivo_del_egreso',
    'Diagnosticos_finales',
    'Resumen_de_evolucion_y_estado_actual',
    'Problemas_clinicos_pendientes',
    'Plan_de_manejo_y_tratamiento',
    'Establecimiento_que_envia',
    'Establecimiento_receptor',
    'Sugerencias_y_tratamiento',
    'fecha_egreso',
    'fecha_ingreso',

    'Signos_vitales_show',
    'Motivo_de_atencion_show',
    'Exploracion_fisica_show',
    'Pruebas_de_laboratorio_show',
    'Diagnostico_show',
    'Afeccion_principal_o_motivo_de_consulta_show',
    'Afeccion_secundaria_show',
    'Pronostico_show',
    'Tratamiento_y_o_recetas_show',
    'Indicaciones_terapeuticas_show',
    'Estado_mental_show',
    'Resultados_relevantes_show',
    'Manejo_durante_la_estancia_hospitalaria_show',
    'Recomendaciones_para_vigilancia_ambulatoira_show',
    'Otros_datos_show',
    'Motivo_de_envio_show',
    'Evolucion_y_actualizacion_del_cuadro_clinico_show',
    'Motivo_del_egreso_show',
    'Diagnosticos_finales_show',
    'Resumen_de_evolucion_y_estado_actual_show',
    'Problemas_clinicos_pendientes_show',
    'Plan_de_manejo_y_tratamiento_show',
    'Sugerencias_y_tratamiento_show',
    
  ];





  public function element_note(){
    return $this->hasMany('App\element_note');
     //return $this->belongsTo('App\section_note');
  }
}
