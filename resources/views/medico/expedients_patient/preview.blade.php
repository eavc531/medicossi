@extends('layouts.app')
@section('css')
<style media="screen">
textarea.form-control{
  height: 100px;
}
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Vista previa: "{{$expedient->name}}" {{\Carbon\Carbon::parse($expedient->created_at)->format('m-d-Y H:i')}}"</h2>



{{-- <div class="text-right">
  <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
</div> --}}

<div class="card">
 <div class="row">
  <div class="col-8">
   <img style="float:left;width: 50%;" src="http://127.0.0.1:8000/img/Medicossi-Marca original-01.png" alt="">
 </div>
 <div class="col-4">
  {{-- <p style="float:right;padding: 10px;">Fecha: {{\Carbon\Carbon::parse($expedient_n->note->date_start)->format('d-m-Y')}}</p> --}}
</div>
</div>
@include('medico.expedients_patient.include_data_consultorio_exp')
<div class="card-body">
  <div class="text-center mb-3">
    <div class="text-center font-title" style="">
      <h3 style="text-decoration: underline;">Expediente {{$expedient->name}}</h3>
    </div>
  </div>
  @include('medico.notes.include_data_patient')





  <div class="col-12">   {{-- ///////////Content --}}
    @foreach ($expedient_notes as $expedient_n)
      <div class="text-center" style="margin-bottom:80px;margin-top:80px">
        <h4 style="text-decoration: underline;">{{$expedient_n->note->title}} {{\Carbon\Carbon::parse($expedient_n->note->date_start)->format('d-m-Y')}}</h4>
      </div>

      @if($expedient_n->note->title == 'Nota Médica Inicial')


        @if($expedient_n->note->Exploracion_fisica_show == 'si')
         <div class="form-group mt-3">
          <h5 class="font-title-blue">Exploracion fisica</h5>
          <p>{{$expedient_n->note->Exploracion_fisica}}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Signos_vitales_show == 'si')
        <div class="form-group">
          <h5 class="font-title-blue">Signos vitales</h5>
          <input type="hidden" name="" value="{{$suma = 0}}">
          <table>

              @foreach ($expedient_n->note->vital_sign as $question)
                  @if($question->show == 'on')
                      <input type="hidden" name="" value="{{$suma = $suma + 1}}">
                      @if($suma%2!=0)
                      <tr>
                          <td width="500px">
                              <br>
                              <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                      @else
                          <td width="500px">
                              <br>
                              <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                      </tr>
                      @endif
                  @endif

              @endforeach

          </table>


        </div>
        <hr>
        @endif
        @if($expedient_n->note->Pruebas_de_laboratorio_show == 'si')
            <div class="form-group">
              <h5 class="font-title-blue">Pruebas de laboratorio</h5>
              <input type="hidden" name="" value="{{$suma = 0}}">
              <table>

                  @foreach ($expedient_n->note->test_lab as $question)
                      @if($question->show == 'on')
                          <input type="hidden" name="" value="{{$suma = $suma + 1}}">
                          @if($suma%2!=0)
                          <tr>
                              <td width="500px">
                                  <br>
                                  <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                          @else
                              <td width="500px">
                                  <br>
                                  <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                          </tr>
                          @endif
                      @endif

                  @endforeach

              </table>


            </div>
            <hr>
        @endif
        @if($expedient_n->note->Diagnostico_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Diagnostico:</h6>
          <p>{!!$expedient_n->note->Diagnostico!!}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Afección principal o motivo de consulta:</h6>
          <p>{!!$expedient_n->note->Afeccion_principal_o_motivo_de_consulta!!}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Afeccion_secundaria_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Afeccion secundaria:</h6>
          <p>{!!$expedient_n->note->Afeccion_secundaria!!}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Pronostico_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Pronostico:</h6>
          <p>{!!$expedient_n->note->Pronostico!!}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Tratamiento_y_o_recetas_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Tratamiento y o receta:</h6>
          <p>{!!$expedient_n->note->Tratamiento_y_o_recetas!!}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Indicaciones_terapeuticas_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Indicaciones terapeuticas:</h6>
          <p>{!!$expedient_n->note->Indicaciones_terapeuticas!!}</p>
        </div>
        <hr>
        @endif


      @elseif($expedient_n->note->title == 'Nota Médica de Evolucion')


        @if($expedient_n->note->Exploracion_fisica_show == 'si')

          <div class="form-group">
            <h6 class="font-title-blue">Exploracion fisica</h6>
            <p>{!!$expedient_n->note->Exploracion_fisica!!}</p>

          </div>
          <hr>
        @endif
          @if($expedient_n->note->Signos_vitales_show == 'si')
              <div class="form-group">
                <h5 class="font-title-blue">Signos vitales</h5>
                <input type="hidden" name="" value="{{$suma = 0}}">
                <table>

                    @foreach ($expedient_n->note->vital_sign as $question)
                        @if($question->show == 'on')
                            <input type="hidden" name="" value="{{$suma = $suma + 1}}">
                            @if($suma%2!=0)
                            <tr>
                                <td width="500px">
                                    <br>
                                    <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                            @else
                                <td width="500px">
                                    <br>
                                    <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                            </tr>
                            @endif
                        @endif

                    @endforeach

                </table>


              </div>
              <hr>
        @endif
          @if($expedient_n->note->Pruebas_de_laboratorio_show == 'si')
              <div class="form-group">
                <h5 class="font-title-blue">Pruebas de laboratorio</h5>
                <input type="hidden" name="" value="{{$suma = 0}}">
                <table>

                    @foreach ($expedient_n->note->test_lab as $question)
                        @if($question->show == 'on')
                            <input type="hidden" name="" value="{{$suma = $suma + 1}}">
                            @if($suma%2!=0)
                            <tr>
                                <td width="500px">
                                    <br>
                                    <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                            @else
                                <td width="500px">
                                    <br>
                                    <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                            </tr>
                            @endif
                        @endif

                    @endforeach

                </table>


              </div>
              <hr>
        @endif
        @if($expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Evolucion y actualizacion del cuadro clinico:</h6>
            <p>{!!$expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico!!}</p>

          </div>
          <hr>
        @endif
        @if($expedient_n->note->Diagnostico_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Diagnostico:</h6>
            <p>{!!$expedient_n->note->Diagnostico!!}</p>

          </div>

          <hr>
        @endif
        @if($expedient_n->note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Afección principal o motivo de consulta:</h6>
            <p>{!!$expedient_n->note->Afeccion_principal_o_motivo_de_consulta!!}</p>

          </div>
          <hr>
        @endif
        @if($expedient_n->note->Afeccion_secundaria_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Afeccion secundaria:</h6>
            <p>{!!$expedient_n->note->Afeccion_secundaria!!}</p>

          </div>
          <hr>
        @endif
        @if($expedient_n->note->Pronostico_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Pronostico:</h6>
            <p>{!!$expedient_n->note->Pronostico!!}</p>

          </div>
          <hr>
        @endif
        @if($expedient_n->note->Tratamiento_y_o_recetas_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Tratamiento y o receta:</h6>
            <p>{!!$expedient_n->note->Tratamiento_y_o_recetas!!}</p>

          </div>
          <hr>
        @endif
        @if($expedient_n->note->Indicaciones_terapeuticas_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Indicaciones terapeuticas:</h6>
            <p>{!!$expedient_n->note->Indicaciones_terapeuticas!!}</p>
          </div>
          <div class="mt-5">
        @endif
      @elseif($expedient_n->note->title == 'Nota de Interconsulta')

        @if($expedient_n->note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
         <div class="form-group">
          <h5 class="font-title-blue">Afección principal o motivo de consulta</h5>
          <p>{{$expedient_n->note->Afeccion_principal_o_motivo_de_consulta}}</p>

        </div>
        <hr>
        @endif
        @if($expedient_n->note->Afeccion_secundaria_show == 'si')
        <div class="form-group">
          <h5 class="font-title-blue">Afección secundaria</h5>
          <p>{{$expedient_n->note->Afeccion_secundaria}}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Pronostico_show == 'si')
        <div class="form-group">
          <h5 class="font-title-blue">Pronostico</h5>
          <p>{{$expedient_n->note->Pronostico}}</p>

        </div>
        <hr>
        @endif
        @if($expedient_n->note->Pruebas_de_laboratorio_show == 'si')
            <div class="form-group">
              <h5 class="font-title-blue">Pruebas de laboratorio</h5>
              <input type="hidden" name="" value="{{$suma = 0}}">
              <table>

                  @foreach ($expedient_n->note->test_lab as $question)
                      @if($question->show == 'on')
                          <input type="hidden" name="" value="{{$suma = $suma + 1}}">
                          @if($suma%2!=0)
                          <tr>
                              <td width="500px">
                                  <br>
                                  <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                          @else
                              <td width="500px">
                                  <br>
                                  <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                          </tr>
                          @endif
                      @endif

                  @endforeach

              </table>


            </div>
            <hr>
        @endif
        @if($expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
        <div class="form-group">
          <h5 class="font-title-blue">Evolución y actualización del cuadro clinico</h5>
          <p>{{$expedient_n->note->Evolucion_y_actualizacion_del_cuadro_clinico}}</p>

        </div>
        <hr>
        @endif
        @if($expedient_n->note->Sugerencias_y_tratamiento_show == 'si')
        <div class="form-group">
          <h5 class="font-title-blue">Sugerencias y tratamiento</h5>
          <p>{{$expedient_n->note->Sugerencias_y_tratamiento}}</p>
          <hr>
        @endif

      @elseif($expedient_n->note->title == 'Nota médica de Urgencias')

        @if($expedient_n->note->Signos_vitales_show == 'si')
            <div class="form-group">
              <h5 class="font-title-blue">Signos vitales</h5>
              <input type="hidden" name="" value="{{$suma = 0}}">
              <table>

                  @foreach ($expedient_n->note->vital_sign as $question)
                      @if($question->show == 'on')
                          <input type="hidden" name="" value="{{$suma = $suma + 1}}">
                          @if($suma%2!=0)
                          <tr>
                              <td width="500px">
                                  <br>
                                  <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                          @else
                              <td width="500px">
                                  <br>
                                  <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
                          </tr>
                          @endif
                      @endif

                  @endforeach

              </table>


            </div>
            <hr>
        @endif
        @if($expedient_n->note->Motivo_de_atencion_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Motivo de atención:</h6>
            <p>{{$expedient_n->note->Motivo_de_atencion}}</p>
          </div>
          <hr>
        @endif
        @if($expedient_n->note->Estado_mental_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Estado mental:</h6>
            <p>{{$expedient_n->note->Estado_mental}}</p>
          </div>
          <hr>
        @endif
        @if($expedient_n->note->Resultados_relevantes_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Resultados relevantes de los servicios auxiliares de diagnostico:</h6>
            <p>{{$expedient_n->note->Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico}}</p>
          </div>
          <hr>
        @endif
        @if($expedient_n->note->Diagnostico_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Diagnóstico:</h6>
            <p>{{$expedient_n->note->Diagnostico}}</p>
          </div>
          <hr>
        @endif
        @if($expedient_n->note->Pronostico_show == 'si')
          <div class="form-group">
            <h6 class="font-title-blue">Pronostico:</h6>
            <p>{{$expedient_n->note->Pronostico}}</p>
          </div>
          <hr>
        @endif

      @elseif($expedient_n->note->title == 'Nota médica de Egreso')
        <div class="row">
          <div class="col-lg-6 col-sm-6 col-12">
            <h6 class="font-title-blue">Fecha de ingreso:</h6>

            <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($expedient_n->note->fecha_ingreso)->format('d-m-Y')}}">
            {{$fecha_egreso}}
          </div>
          <div class="col-lg-6 col-sm-6 col-12">
            <h6 class="font-title-blue">Fecha de egreso:</h6>
            <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($expedient_n->note->fecha_egreso)->format('d-m-Y')}}">
            {{$fecha_egreso}}
          </div>
        </div>

        @if($expedient_n->note->Motivo_del_egreso_show == 'si')

        <div class="form-group mt-3">
          <h6 class="font-title-blue">Motivo del egreso:</h6>
          {{$expedient_n->note->Motivo_del_egreso}}
        </div>
        <hr>
        @endif

        @if($expedient_n->note->Diagnosticos_finales_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Diagnosticos finales:</h6>
          {{$expedient_n->note->Diagnosticos_finales}}
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Resumen_de_evolucion_y_estado_actual_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Resumen de evolucion y estado actual:</h6>
          {{$expedient_n->note->Resumen_de_evolucion_y_estado_actual}}
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Manejo_durante_la_estancia_hospitalaria_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Manejo durante la estancia hospitalaria:</h6>
          {{$expedient_n->note->Manejo_durante_la_estancia_hospitalaria}}
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Problemas_clinicos_pendientes_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Problemas clinicos pendientes:</h6>
          {{$expedient_n->note->Problemas_clinicos_pendientes}}
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Plan_de_manejo_y_tratamiento_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Plan de manejo y tratamiento:</h6>
          {{$expedient_n->note->Plan_de_manejo_y_tratamiento}}
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Recomendaciones para vigilancia ambulatoira:</h6>
          {{$expedient_n->note->Recomendaciones_para_vigilancia_ambulatoira}}
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Otros_datos_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Otros datos:</h6>
          {{$expedient_n->note->Otros_datos}}
          <hr>
        @endif

      @elseif($expedient_n->note->title == 'Nota de Referencia o traslado')
        @if($expedient_n->note->Motivo_de_envio_show == 'si')
         <div class="form-group">
           <h6 class="font-title-blue">Motivo de envio:</h6>
           <p>{{$expedient_n->note->Motivo_de_envio}}</p>
         </div>
         <hr>
        @endif
         @if($expedient_n->note->Establecimiento_que_envia_show == 'si')
         <div class="form-group">
          <h6 class="font-title-blue">Establecimiento que envia:</h6>
          <p>{{$expedient_n->note->Establecimiento_que_envia}}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Establecimiento_receptor_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Establecimiento receptor:</h6>
          <p>{{$expedient_n->note->Establecimiento_receptor}}</p>
        </div>
        <hr>
        @endif
        @if($expedient_n->note->Diagnostico_show == 'si')
        <div class="form-group">
          <h6 class="font-title-blue">Diagnóstico:</h6>
          <p>{{$expedient_n->note->Diagnostico}}</p>
        </div>
        <hr>
        @endif

      @endif

    @endforeach

  </div>



</div>
</div>

<div class="col-12 text-right">
  @if($expedient == Null)
      <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
  @else
      <a href="{{route('expedient_open',['m_id'=>$medico->id ,'p_id'=>$patient->id,'ex_id'=>$expedient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
  @endif


  <a href="{{route('download_expedient_pdf',$expedient->id)}}" class="btn btn-info ml-auto mr-3">Descargar en pdf</a>
</div>
@endsection
