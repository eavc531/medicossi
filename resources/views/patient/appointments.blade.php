@extends('layouts.app')
@section('css')
  <link rel="stylesheet" href="{{asset('rateyo/jquery.rateyo.css')}}">

@endsection
@section('content')

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
      <a href="{{route('patient_appointments',$patient->id)}}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i></a>
      <a href="{{route('patient_appointments_pending',$patient->id)}}" class="btn btn-warning disabled" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i></a>

      <a href="{{route('patient_appointments_unrated',$patient->id)}}" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i></a>
    @elseif(isset($unrated))
      <a href="{{route('patient_appointments',$patient->id)}}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i></a>
      <a href="{{route('patient_appointments_pending',$patient->id)}}" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i></a>
      <a href="{{route('patient_appointments_unrated',$patient->id)}}" class="btn btn-danger disabled" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i></a>
    @else
      <a href="{{route('patient_appointments',$patient->id)}}" class="btn btn-primary disabled" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i></a>
      <a href="{{route('patient_appointments_pending',$patient->id)}}" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i></a>
      <a href="{{route('patient_appointments_unrated',$patient->id)}}" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="<em>Por Calificar</em>"><i class="fas fa-star"></i></a>
    @endif
  </div>
  @if($appointments->first() != Null)
  <div class="row mb-3">
    @foreach ($appointments as $app)

    <div class="col-lg-12">
      <div class="card date-card my-2">
        <div class="row">
          <div class="col-lg-4 col-sm-4 col-12">
           <div class="p-2">
            <label for="" class="font-title-grey"> Medicox:</label> <p><a href="{{route('medico.edit',$app->medico->id)}}"><strong>{{$app->medico->name}} {{$app->medico->lastName}}</strong></a></p>
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
            <label for="" class="font-title-grey">Estado:</label>
              {{$app->state}}


          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-12">
          <div class="p-2">
            <label for="" class="font-title-grey">Fecha de Creacion:</label> <p>{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>

              <label for="" class="font-title-grey">Creada Por:</label> <p>@if($app->stipulated == 'Paciente') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}

              @endif

                @if($app->status == 'calificada')
                  <div class="">
                      <strong class="text-success">Calificada</strong>
                  </div>
                @elseif($app->medico->plan != 'plan_profesional' and $app->medico->plan != 'plan_platino')

                @elseif(\Carbon\Carbon::parse($app->end) < \Carbon\Carbon::now())
                  <a class="btn btn-primary mt-2" href="{{route('qualify_medic',['p_id'=>$app->patient_id,'m_id'=>$app->medico_id,'app_id'=>$app->id])}}">Calificar Médico</a>

                @else
                  <a onclick="return alert('No podras calificar al médico hasta despues de la cita, luego de la fecha de la cita este boton se activara y podras calificar al médico.')" href="" class="btn btn-warning mt-4" data-toggle="tooltip" data-placement="top" title="No podras Calificar al médico hasta despues de la cita."><strong>Calificar Médico</strong></a>
                @endif
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
