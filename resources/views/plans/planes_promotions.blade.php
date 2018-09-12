@extends('layouts.app')
@section('content')


  <div class="container my-5 box-register">

    @if($plan_actual != Null)

          <div class="card mb-5">
            <div class="card-header text-center">
              <h3 class="font-title">Tu Plan Actual</h3>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Periodo Pagado</th>
                    <th>Fecha de Inicio</th>
                    <th>fecha de Culminacion</th>
                </thead>
                <tbody>
                  <tr>
                    @if ($plan_actual->name == 'plan_basico')
                      <td>Plan Basico</td>
                      <td>Gratis</td>
                      <td>indefinido</td>
                      <td>indefinida</td>
                      <td>indefinida</td>
                    @else
                      <td>{{$plan_actual->name}}</td>
                      <td>{{$plan_actual->price}}</td>
                      <td>{{$plan_actual->period}}</td>
                      <td>{{$plan_actual->date_start}}</td>
                      <td>{{$plan_actual->date_end}}</td>
                    @endif

                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        @endif

       <div class="row">
        <div class="col-12 text-center">
          <h2 class="font-title">Suscribete</h2>
          <h5 class="my-4">Conoce los mejores paquetes que hemos preparado para ti</h5>
        </div>
      </div>
      <div class="card-deck">
        <div class="row">
          <div class="col-12 col-lg-4 col-sm-6 col-md-6 p-1">
            <div class="card mt-2">
              <div class="border-bottom p-2 color-card orange">
                <h5 class="card-title text-center">Plan mi agenda</h5>
                <div class="row">
                  <div class="col-lg col-12 text-center px-2">
                    <label for="">Pago mensual</label>
                  </div>
                  <div class="col-lg col-12 text-center px-2">
                   <label for="">{{$plan_mi_agenda->price1}}<b> MXN</b></label>
                 </div>
               </div>
             </div>
             <div class="card-body card-height">
              <p class="card-text">-Todo lo del plan básico +</p>
              <p class="card-text">-Control y administración de su agenda</p>
              <p class="card-text">-Acceso a información desde cualquier dispositivo 24/7</p>
              <p class="card-text">-Diferencia de status de sus citas por colores</p>
              <p class="card-text">-Recordatorio a sus pacientes de sus citas</p>
              <p class="card-text">-Recordatorios personales para usted</p>
              <p class="card-text">-Modulo de ingresos (registro de pago y citas por pagar en caso de aseguradoras)</p>
              <p class="card-text">-Soporte tecnico</p>
            </div>
            <div class="my-2">
              <div class="col-12 text-center">
                 @if(Auth::user()->role == 'medico')
                     @if($plan_actual == Null)
                       <a href="{{route('plan_agenda_contract',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-primary btn-block">Contratar</a>
                     @else
                       <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                         Contratar
                       </button>
                     @endif
                @else
                    @if($plan_actual == Null)
                      <a href="{{route('plan_agenda_contract',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-primary btn-block">Contratar</a>
                    @else
                      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Contratar
                      </button>
                    @endif
                @endif


              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4 col-sm-6 col-md-6 p-1">
          <div class="card mt-2">
            <div class="border-bottom p-2 color-card purple">
              <h5 class="card-title text-center">Plan profesional</h5>
              <div class="row">
                <div class="col-lg col-12 text-center px-2">
                  <label for="">Pago mensual</label>
                </div>
                <div class="col-lg col-12 text-center px-2">
                 <label for="">{{$plan_profesional->price1}}<b> MXN</b></label>
               </div>
             </div>
           </div>
           <div class="card-body card-height">
             <p class="card-text">-Todo lo del plan mi agenda+</p>
             <p class="card-text">-PERFIL COMPLETO. usuarios podran ubicarlo a travez de la busqueda por filtros principal</p>
             <p class="card-text ml-3">-Telefono oficina</p>
             <p class="card-text ml-3">-Telefono móvil</p>
             <p class="card-text ml-3">-Redes sociales y web site</p>
             <p class="card-text">-Sus pacientes podran agendar citas en linea</p>

             <p class="card-text">-Podra crear usuarios tipo asistente para su agenda, y asignarle derechos. Ejemplo: ver agenda,asignar citas, cambiar su estatus, enviar mensajes de confirmación, etc...</p>
             <p class="card-text">Podra ser calíficado por su paciente (¡Esto atraera mas confianza a nuevos pacientes obteniendo así mas citas!).</p>
             {{-- <p class="card-text">-Adjuntar archivos a expedientes clínicos</p>
             <p class="card-text ml-3">Sube el expediente de su paciente</p>
             <p class="card-text ml-3">-Fotos</p>
             <p class="card-text ml-3">-Placas</p>
             <p class="card-text ml-3">-Radiografías</p>
             <p class="card-text ml-3">-Estudio de laboratorios</p>
             <p class="card-text">-Respaldo de todos tus archivos en la nube con la mejor tecnología de seguridad</p>
             <p class="card-text">Obten información relevante</p>
             <p class="card-text ml-3">-Numero de pacientes atendidos por primera vez para el reporte (suive) con clave del diagnostico CIE-10</p> --}}
             {{-- <p class="card-text ml-3">-Pacientes atendidos según su tipo de consulta</p> --}}


          </div>
          <div class="my-2">
            <div class="col-12 text-center">

                @if(Auth::user()->role == 'medico')
                    @if($plan_actual == Null)
                      <a href="{{route('plan_profesional_contract',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-primary btn-block">Contratar</a>
                    @else
                      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal11">
                        Contratar
                      </button>
                    @endif
               @else
                   @if($plan_actual == Null)
                     <a href="{{route('plan_profesional_contract',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-primary btn-block">Contratar</a>
                   @else
                     <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal11">
                       Contratar
                     </button>
                   @endif
               @endif




            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-sm-6 col-md-6 p-1">
        <div class="card mt-2">
          <div class="border-bottom p-2 color-card green">
            <h5 class="card-title text-center">Plan Platino</h5>
            <div class="row">
              <div class="col-lg col-12 text-center px-2">
                <label for="">Pago mensual</label>
              </div>
              <div class="col-lg col-12 text-center px-2">
               <label for=""> {{$plan_platino->price1}}<b> MXN</b></label>
             </div>
           </div>
         </div>
         <div class="card-body card-height">

           <p class="card-text">-Todo lo del plan profesional+</p>

           <p class="card-text">-Registro de consulta ilimitados</p>
           <p class="card-text">-Expedientes clinicos electronicos ilimitados</p>
           <p class="card-text ml-3">-Histora clinica (cronologica)</p>
           <p class="card-text ml-3">-Notas médicas</p>
           <p class="card-text ml-3">-Nota de evolución</p>
           <p class="card-text ml-3">-Nota de interconsulta (Comparte la información del excedente con otro profesional de salud)</p>
           <p class="card-text ml-3">-Notas para cirugia</p>
           <p class="card-text">-Impresiones de recetas y estudios de laboratorios</p>
            <p class="card-text">-Adjuntar archivos a expedientes clinicos</p>
            <p class="card-text">-Subir el expediente de su pasiente:</p>
            <p class="card-text">
                <ul>
                    <li>Fotos</li>
                    <li>Placas Radiograficas</li>
                    <li>Estudios de Laboratorio</li>

                </ul>
            </p>
           <p class="card-text">-Modulos de respaldos</p>
           <p class="card-text ml-3"><ul>
                                        <li>
                                            Los respaldos podra almacenarlos donde prefiera.
                                        </li>
                                        <li>
                                            Sus expedientes podran migrarlos en el momento que prefiera, o convertirlos en pdf.
                                        </li>

                                    </ul>
                                </p>
            <p class="card-text">-RESPALDO DE TODOS SUS ARCHIVOS EN LA NUBE CON LA MEJOR TECNOLOGIA DE SEGURIDAD</p>
            <p class="card-text">-MODULO DE ESTADISTICAS (para la recopilación de información importante.)</p>

        </div>
        <div class="my-2">
          <div class="col-12 text-center">

              @if(Auth::user()->role == 'medico')
                  @if($plan_actual == Null)
                    <a href="{{route('plan_platino_contract',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-primary btn-block">Contratar</a>
                  @else
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal33">
                      Contratar
                    </button>
                  @endif
             @else
                 @if($plan_actual == Null)
                   <a href="{{route('plan_platino_contract',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-primary btn-block">Contratar</a>
                 @else
                   <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal33">
                     Contratar
                   </button>
                 @endif
             @endif



          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4 m-auto col-sm-6 col-md-6 p-1">
      <div class="card mt-3">
        <div class="border-bottom font-white p-2 blue">
          <h5 class="card-title text-center">Plan Basico</h5>
          <div class="row">
            <div class="col-lg col-12 text-center px-2">
             <label for=""> <b>Gratis</b></label>
           </div>
         </div>
       </div>
       <div class="card-body card-height">

        <p class="card-text">-Perfíl Basico</p>
        <p class="card-text">-Podran encontrar tu perfil por geolocalización</p>
        <p class="card-text">-App movil para Ios y android</p>
        {{-- <p class="card-text">-Dar de alta a tus especialistas</p> --}}
      </div>
      <div class="my-2">
        <div class="col-12 text-center">
          {{-- <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#information">Contratar</a> --}}
          @if(Auth::user()->role == 'medico')
          <a class="btn btn-primary btn-block" href="{{route('contract_basic',\Hashids::encode(Auth::user()->medico_id))}}">Contratar</a>
      @elseif(Auth::user()->role == 'Asistente')
          <a class="btn btn-primary btn-block" href="{{route('contract_basic',\Hashids::encode(Auth::user()->assistant->medico_id))}}">Contratar</a>
      @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- </div> -->
</div>

</div>
@include('plans.modals')
<!-- Button trigger modal -->
@endsection

@section('scriptJS')
  <script type="text/javascript">

    function modal_agenda(){
      $('#payment_plan_mi_agenda').modal('show');
    }

    function modal_plan_profesional(){
      $('#payment_plan_profesional').modal('show');
    }

    function modal_plan_platino(){
      $('#payment_plan_platino').modal('show');
    }




  </script>

@endsection
