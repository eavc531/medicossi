@foreach ($expedient_notes as $expedient_n)
  <div class="text-center" style="margin-bottom:80px;margin-top:80px">
    <h4 style="text-decoration: underline;">{{$expedient_n->note->title}} {{\Carbon\Carbon::parse($expedient_n->note->date_start)->format('d-m-Y')}}</h4>
  </div>

  @if($expedient_n->note->title == 'Nota Médica Inicial')
    <div class="" style="margin-top:90px">

      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Exploracion fisica</h5>
      <p>{{$expedient_n->note->Exploracion_fisica}}</p>
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Signos_vitales_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Signos vitales</h5>
      <p>{!!$expedient_n->note->Signos_vitales!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Pruebas_de_laboratorio_show == 'si')
    <div class="form-group">
      <h5 class="font-title-blue">Pruebas de laboratorio</h5>
      <p>{!!$expedient_n->note->Pruebas_de_laboratorio!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Diagnostico_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnostico</h5>
      <p>{!!$expedient_n->note->Diagnostico!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Afección principal o motivo de consulta</h5>
      <p>{!!$expedient_n->note->Afeccion_principal_o_motivo_de_consulta!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Afeccion_secundaria_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Afeccion secundaria</h5>
      <p>{!!$expedient_n->note->Afeccion_secundaria!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Pronostico_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Pronostico</h5>
      <p>{!!$expedient_n->note->Pronostico!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Tratamiento_y_o_recetas_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Tratamiento y o receta</h5>
      <p>{!!$expedient_n->note->Tratamiento_y_o_recetas!!}</p>
    </div>
    <hr>
@endif
    @if($expedient_n->note->Indicaciones_terapeuticas_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Indicaciones terapeuticas</h5>
      <p>{!!$expedient_n->note->Indicaciones_terapeuticas!!}</p>
    </div>
    <hr>
@endif


  @elseif($expedient_n->note->title == 'Nota Médica de Evolucion')

    @if($expedient_n->note->Exploracion_fisica_show == 'si')
      <div class="form-group" style="margin-top:90px">

        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Exploracion fisica</h5>
        <p>{!!$expedient_n->note->Exploracion_fisica!!}</p>
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Signos_vitales_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Signos vitales</h5>
        <p>{!!$expedient_n->note->Signos_vitales!!}</p>
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Pruebas_de_laboratorio_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pruebas de laboratorio</h5>
        <p>{!!$expedient_n->note->Pruebas_de_laboratorio!!}</p>
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Evolucion y actualizacion del cuadro clinico</h5>
        <p>{!!$expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico!!}</p>

      </div>
      <hr>
    @endif
    @if($expedient_n->note->Diagnostico_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnostico</h5>
        <p>{!!$expedient_n->note->Diagnostico!!}</p>
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Afección principal o motivo de consulta</h5>
        <p>{!!$expedient_n->note->Afeccion_principal_o_motivo_de_consulta!!}</p>
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Afeccion_secundaria_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Afeccion secundaria</h5>
        <p>{!!$expedient_n->note->Afeccion_secundaria!!}</p>

      </div>
      <hr>
    @endif
    @if($expedient_n->note->Pronostico_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pronostico</h5>
        <p>{!!$expedient_n->note->Pronostico!!}</p>

      </div>
      <hr>
    @endif
    @if($expedient_n->note->Tratamiento_y_o_recetas_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Tratamiento y o receta</h5>
        <p>{!!$expedient_n->note->Tratamiento_y_o_recetas!!}</p>

      </div>
      <hr>
    @endif
    @if($expedient_n->note->Indicaciones_terapeuticas == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Indicaciones terapeuticas</h5>
        <p>{!!$expedient_n->note->Indicaciones_terapeuticas!!}</p>
      </div>
    @endif

  @elseif($expedient_n->note->title == 'Nota de Interconsulta')
    @if($expedient_n->note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
      <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Afección principal o motivo de consulta</h4>
      <p>{{$expedient_n->note->Afeccion_principal_o_motivo_de_consulta}}</p>
    </div>
    <hr>
  @endif
  @if($expedient_n->note->Afeccion_secundaria_show == 'si')
    <div class="form-group">
      <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Afeccion secundaria</h4>
      <p>{{$expedient_n->note->Afeccion_secundaria}}</p>

    </div>
    <hr>
  @endif
  @if($expedient_n->note->Pronostico_show == 'si')
    <div class="form-group">
      <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pronostico</h4>
      <p>{{$expedient_n->note->Pronostico}}</p>

    </div>
    <hr>
  @endif
  @if($expedient_n->note->Pruebas_de_laboratorio_show == 'si')
    <div class="form-group">
      <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pruebas de laboratorio</h4>
      <p>{!!$expedient_n->note->Pruebas_de_laboratorio!!}</p>

    </div>
    <hr>
  @endif
  @if($expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
    <div class="form-group">
      <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Evolucion y actualizacion del cuadro clinico</h4>
      <p>{{$expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico}}</p>

    </div>
    <hr>
  @endif
  @if($expedient_n->note->Sugerencias_y_tratamiento_show == 'si')
    <div class="form-group">
      <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Sugerencias y tratamiento</h4>
      <p>{{$expedient_n->note->Sugerencias_y_tratamiento}}</p>

    </div>
    <hr>
  @endif

  @elseif($expedient_n->note->title == 'Nota médica de Urgencias')
    @if($expedient_n->note->Signos_vitales_show == 'si')
        <div class="form-group" style="margin-top:90px">

          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Signos vitales</h5>
          <p>{!!$expedient_n->note->Signos_vitales!!}</p>

        </div>
        <hr>
    @endif
      @if($expedient_n->note->Motivo_de_atencion_show == 'si')
        <div class="form-group">
          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Motivo_de_atencion</h5>
          <p>{{$expedient_n->note->Motivo_de_atencion}}</p>
        </div>
    <hr>
    @endif
    @if($expedient_n->note->Estado_mental_show == 'si')
        <div class="form-group">
          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Estado mental</h5>
          <p>{{$expedient_n->note->Estado_mental}}</p>
        </div>
    <hr>
    @endif
    @if($expedient_n->note->Resultados_relevantes_show == 'si')
        <div class="form-group">
          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Resultados relevantes de los servicios auxiliares de diagnostico</h5>
          <p>{{$expedient_n->note->Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico}}</p>
        </div>
    <hr>
    @endif
    @if($expedient_n->note->Diagnostico_show == 'si')
        <div class="form-group">
          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnostico</h5>
          <p>{{$expedient_n->note->Diagnostico}}</p>
        </div>
    <hr>
    @endif
    @if($expedient_n->note->Pronostico_show == 'si')
        <div class="form-group">
          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pronostico</h5>
          <p>{{$expedient_n->note->Pronostico}}</p>
        </div>
    <hr>
    @endif


  @elseif($expedient_n->note->title == 'Nota médica de Egreso')
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-12">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Fecha de ingreso:</h5>

        <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($expedient_n->note->fecha_ingreso)->format('d-m-Y')}}">
        {{$fecha_egreso}}
      </div>
      <div class="col-lg-6 col-sm-6 col-12">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Fecha de egreso:</h5>
        <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($expedient_n->note->fecha_egreso)->format('d-m-Y')}}">
        {{$fecha_egreso}}
      </div>
    </div>
    <hr>
    @if($expedient_n->note->Motivo_del_egreso_show == 'si')

      <div class="form-group mt-3">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Motivo del egreso</h5>
        {{$expedient_n->note->Motivo_del_egreso}}
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Diagnosticos_finales_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnosticos finales</h5>
      {{$expedient_n->note->Diagnosticos_finales}}
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Resumen_de_evolucion_y_estado_actual_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Resumen de evolucion y estado actual</h5>
      {{$expedient_n->note->Resumen_de_evolucion_y_estado_actual}}
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Manejo_durante_la_estancia_hospitalaria_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Manejo durante la estancia hospitalaria</h5>
      {{$expedient_n->note->Manejo_durante_la_estancia_hospitalaria}}
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Problemas_clinicos_pendientes_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Problemas clinicos pendientes</h5>
      {{$expedient_n->note->Problemas_clinicos_pendientes}}
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Plan_de_manejo_y_tratamiento_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Plan de manejo y tratamiento</h5>
      {{$expedient_n->note->Plan_de_manejo_y_tratamiento}}
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Recomendaciones para vigilancia ambulatoira</h5>
      {{$expedient_n->note->Recomendaciones_para_vigilancia_ambulatoira}}
    </div>
    <hr>
    @endif
    @if($expedient_n->note->Otros_datos_show == 'si')
    <div class="form-group">
      <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Otros datos</h5>
      {{$expedient_n->note->Otros_datos}}
    </div>
    <hr>
    @endif

  @elseif($expedient_n->note->title == 'Nota de Referencia o traslado')
    @if($expedient_n->note->Motivo_de_envio_show == 'si')
        <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Motivo de envio</h5>
        <p>{{$expedient_n->note->Motivo_de_envio}}</p>
      </div>
      <hr>
    @endif
       @if($expedient_n->note->Establecimiento_que_envia_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Establecimiento que envia</h5>
          <p>{{$expedient_n->note->Establecimiento_que_envia}}</p>
      </div>
      <hr>
    @endif
      @if($expedient_n->note->Establecimiento_receptor_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Establecimiento receptor</h5>
          <p>{{$expedient_n->note->Establecimiento_receptor}}</p>
      </div>
      <hr>
    @endif
    @if($expedient_n->note->Diagnostico_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnostico</h5>
          <p>{{$expedient_n->note->Diagnostico}}</p>
      </div>
      <hr>
    @endif

  @endif

@endforeach
