@extends('layouts.app')
@section('css')
  <link rel="stylesheet" href="{{asset('rateyo/jquery.rateyo.css')}}">

@endsection
@section('content')
{{-- {{\Carbon\Carbon::now()->format('d-m-Y H:i')}} --}}
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
     <div class="col-12">
      <h2 class="text-center font-title">Citas Médicas @if(isset($pending)){{$pending}}s     @elseif(isset($unrated)){{$unrated}}@endif</h2>
      <hr>
    </div>
  </div>
  <div class="mb-3">
    @if(isset($pending))
      <a href="{{route('patient_appointments',\Hashids::encode($patient->id))}}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i> Todas</a>

      @if($appointments_pending_confirm_count != 0)
      <a href="{{route('patient_pending_confirm',\Hashids::encode($patient->id))}}" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="<em>Esperando Confirmación</em>"><i class="fas fa-exclamation-circle"></i> Esperando Confirmación</a>
      @endif

      <a href="{{route('patient_appointments_pending',\Hashids::encode($patient->id))}}" class="btn btn-success disabled" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i> Pendietes</a>

      <a href="{{route('patient_appointments_unrated',\Hashids::encode($patient->id))}}" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i> Por Calificar</a>



    @elseif(isset($unrated))
        <a href="{{route('patient_appointments',\Hashids::encode($patient->id))}}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i> Todas</a>
        @if($appointments_pending_confirm_count != 0)
        <a href="{{route('patient_pending_confirm',\Hashids::encode($patient->id))}}" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="<em>Esperando Confirmación</em>"><i class="fas fa-exclamation-circle"></i> Esperando Confirmación</a>
        @endif
        <a href="{{route('patient_appointments_pending',\Hashids::encode($patient->id))}}" class="btn btn-success" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i> Pendietes</a>

        <a href="{{route('patient_appointments_unrated',\Hashids::encode($patient->id))}}" class="btn btn-danger disabled" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i> Por Calificar</a>
    @elseif(isset($pending_confirm))
        <a href="{{route('patient_appointments',\Hashids::encode($patient->id))}}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i> Todas</a>


        <a href="{{route('patient_pending_confirm',\Hashids::encode($patient->id))}}" class="btn btn-warning disabled" data-toggle="tooltip" data-html="true" title="<em>Esperando Confirmación</em>"><i class="fas fa-exclamation-circle"></i> Esperando Confirmación</a>


        <a href="{{route('patient_appointments_pending',\Hashids::encode($patient->id))}}" class="btn btn-success" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i> Pendietes</a>

        <a href="{{route('patient_appointments_unrated',\Hashids::encode($patient->id))}}" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i> Por Calificar</a>
    @else
        <a href="{{route('patient_appointments',\Hashids::encode($patient->id))}}" class="btn btn-primary disabled" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i> Todas</a>

        @if($appointments_pending_confirm_count != 0)
        <a href="{{route('patient_pending_confirm',\Hashids::encode($patient->id))}}" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="<em>Esperando Confirmación</em>"><i class="fas fa-exclamation-circle"></i> Esperando Confirmación</a>
        @endif

        <a href="{{route('patient_appointments_pending',\Hashids::encode($patient->id))}}" class="btn btn-success" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i> Pendietes</a>

        <a href="{{route('patient_appointments_unrated',\Hashids::encode($patient->id))}}" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i> Por Calificar</a>
    @endif
  </div>

  @if($appointments->first() != Null)
  <div class="row mb-3">
    @foreach ($appointments as $app)
        {{-- {{$app->end}} --}}
    <div class="col-lg-12">
      <div class="card date-card my-2">
        <div class="row">
          <div class="col-lg-4 col-sm-4 col-12">
           <div class="p-2">
            <label for="" class="font-title-grey"> Médico:</label> <p><a href="{{route('medico.edit',\Hashids::encode($app->medico->id))}}"><strong>{{$app->medico->name}} {{$app->medico->lastName}}</strong></a></p>
            <label for="" class="font-title-grey">Tipo de Cita:</label> <p>{{$app->title}}</p>
            <label for="" class="font-title-grey">Especialidad del Medico:</label> <p>{{$app->medico->specialty}}</p>
            @isset($app->descriptión)
            Mensaje o descriptión: <p>{{$app->descriptión}}</p>
            @endisset

          </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-12">
          <div class="p-2">
            <label for="" class="font-title-grey">Fecha:</label> <p>{{\Carbon\Carbon::parse($app->start)->format('d-m-Y')}}</p>

            <label for="" class="font-title-grey">Hora:</label> <p>{{\Carbon\Carbon::parse($app->start)->format('H:i')}}</p>
            {{-- @isset($pending) --}}
            <label for="" class="font-title-grey">Estado:</label>
              {{$app->state}}
          {{-- @endisset --}}

          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-12">
          <div class="p-2">
            <label for="" class="font-title-grey">Fecha de Creacion:</label> <p>{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>

              <label for="" class="font-title-grey">Solicitada Por:</label> <p>@if($app->stipulated == 'Paciente') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}

              @endif
              {{-- {{\Carbon\Carbon::parse($app->end)->format('Y-m-d H:i')}}
              hoy:{{\Carbon\Carbon::now()}} --}}
                @if($app->status == 'calificada')
                  <div class="">
                      <strong class="text-success">Calificada</strong>
                  </div>
                @elseif($app->medico->plan != 'plan_profesional' and $app->medico->plan != 'plan_platino')
                    <a href="#" class="btn btn-secondary disabled text-white" data-toggle="tooltip" data-placement="top" title="No podras Calificar al médico hasta despues de la cita.">Calificar/disabled</a>
                @elseif($app->confirmed_medico == 'Si' and $app->state != 'Rechazada/Cancelada' and \Carbon\Carbon::parse($app->end)->format('Y-m-d H:i') < \Carbon\Carbon::now())

                    <a onclick="return alert('No podras calificar al médico hasta que la cita sea confirmada y halla pasado la fecha de la misma.')" href="#" class="btn btn-warning mt-4" data-toggle="tooltip" data-placement="top" title="No podras Calificar al médico hasta despues de la cita."><strong>Calificar Médico</strong></a>
                @else
                    xx
                  <a class="btn btn-primary mt-2" href="{{route('qualify_medic',['p_id'=>\Hashids::encode($app->patient_id),'m_id'=>\Hashids::encode($app->medico_id),'app_id'=>\Hashids::encode($app->id)])}}">Calificar Médico</a>

                @endif
                <label for="" class="font-title-grey mt-2">Confirmada por Médico: </label> {{$app->confirmed_medico}}
            {{-- <label for="" class="font-title-grey">Estrellas Otorgadas:</label> <p><div class="rateYo p-1" style="border: solid 1px rgb(139, 139, 138);border-radius:10px"></div></p>
            <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p> --}}
            {{-- <label for="" class="font-title-grey">Comentario:</label> <p>{{$app->comentary}}</p> --}}


          </p>
          </div>
        </div>
      </div>
      {{-- @isset($app->calification)
        <div class="card-footer">
          <strong>Tu Comentario sobre el servicio:</strong> {{$app->comentary}}
        </div>
      @else
        <a href="{{route('rate_appointment',$app->id)}}" class="btn btn-primary">Calificar Cita</a>
      @endif --}}
    </div>
  </div>
  @endforeach
  <div class="card-heading">
    {{$appointments->appends(Request::all())->links()}}
  </div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No se encontraron resultados</h4>
</div>
@endif
</div>
</div>
</section>
@endsection

@section('scriptJS')
  <script src="{{asset('rateyo/jquery.rateyo.js')}}" type="text/javascript">

  </script>
  <script type="text/javascript">
  $(function () {

  $(".rateYo").rateYo({
    starWidth: "20px",
    rating: 3.2,

    });
  });
  </script>
@endsection
