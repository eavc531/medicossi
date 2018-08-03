@extends('layouts.app')
@section('content')


  <div class="container my-5 box-register">

       <div class="row">
        <div class="col-12 text-center">
          <h2 class="font-title">Descripcion de los planes</h2>
          <div class="my-5 text-left">
              @if (isset($specialties))
                  <a href="{{route('planes_medic_specialties')}}" class="btn btn-primary disabled">Planes Medicos y Especialistas</a>
                  <a href="{{route('planes_alt_psicologos')}}" class="btn btn-success ml-2">Planes  Medicina Alternativa, Psicologos y Terapeutas</a>
              @else
                  <a href="{{route('planes_medic_specialties')}}" class="btn btn-primary ">Planes Medicos y Especialistas</a>
                  <a href="{{route('planes_alt_psicologos')}}" class="btn btn-success ml-2 disabled">Planes Medicina Alternativa, Psicologos y Terapeutas</a>
              @endif

          </div>

          <h4 class="my-5 text-primary">Planes {{$plan_mi_agenda->applicable}}</h4>
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
               <div class="row">
                 <div class="col-lg col-12 text-center px-2">
                   <label for="">Pago 6 meses</label>
                 </div>
                 <div class="col-lg col-12 text-center px-2">
                  <label for="">{{$plan_mi_agenda->price2}}<b> MXN</b></label>
                </div>
              </div>
              <div class="row">
                <div class="col-lg col-12 text-center px-2">
                  <label for="">Pago Anual</label>
                </div>
                <div class="col-lg col-12 text-center px-2">
                 <label for="">{{$plan_mi_agenda->price3}}<b> MXN</b></label>
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

          <div class="col-12 text-center">

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
             <div class="row">
               <div class="col-lg col-12 text-center px-2">
                 <label for="">Pago 6 meses</label>
               </div>
               <div class="col-lg col-12 text-center px-2">
                <label for="">{{$plan_profesional->price2}}<b> MXN</b></label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg col-12 text-center px-2">
                <label for="">Pago Anual</label>
              </div>
              <div class="col-lg col-12 text-center px-2">
               <label for="">{{$plan_profesional->price3}}<b> MXN</b></label>
             </div>
           </div>

           </div>
           <div class="card-body card-height">
             <p class="card-text">-Todo lo del plan mi agenda+</p>
             <p class="card-text">-Perfil completo</p>
             <p class="card-text ml-3">-Telefono oficina</p>
             <p class="card-text ml-3">-Telefono móvil</p>
             <p class="card-text ml-3">-Redes sociales y web site</p>
             <p class="card-text">-Sus pacientes podran agendar citas en linea</p>

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
             <p class="card-text">-Podra crear usuarios tipo asistente para su agenda, y asignarle derechos. Ejemplo: ver agenda,asignar citas, cambiar su estatus, enviar mensajes de confirmación, etc...</p>
             <p class="card-text">Podra ser calíficado por su paciente (¡Esto atraera mas confianza a nuevos pacientes obteniendo así mas citas!).</p>


          </div>
          <div class="my-2">

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
               <label for="">{{$plan_platino->price1}}<b> MXN</b></label>
             </div>
           </div>
           <div class="row">
             <div class="col-lg col-12 text-center px-2">
               <label for="">Pago 6 meses</label>
             </div>
             <div class="col-lg col-12 text-center px-2">
              <label for="">{{$plan_platino->price2}}<b> MXN</b></label>
            </div>
          </div>
          <div class="row">
            <div class="col-lg col-12 text-center px-2">
              <label for="">Pago Anual</label>
            </div>
            <div class="col-lg col-12 text-center px-2">
             <label for="">{{$plan_platino->price3}}<b> MXN</b></label>
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
           <p class="card-text">-Modulos de respaldos</p>
           <p class="card-text ml-3">-Los respaldos podra almacenarlos donde prefiera</p>
           <p class="card-text ml-3">-Sus expedientes podran migrarlos en el momento</p>

        </div>
        <div class="my-2">
          <div class="col-12 text-center">

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
            <div class="card-footer col-12">
               <h5>Gratis</h5>

            </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- </div> -->
</div>

</div>
{{-- @include('plans.modals') --}}
<!-- Button trigger modal -->
@endsection

@section('scriptJS')
  <script type="text/javascript">



  </script>

@endsection
