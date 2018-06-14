@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Citas con Paciente: {{$patient->name}} {{$patient->lastName}} </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
@include('medico.includes.main_medico_patients')

@if($appointments->first() != Null)
<div class="row">
  @foreach ($appointments as $app)
  <div class="col-lg-12">
    <div class="card date-card my-2">
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-12">
         <div class="p-2">
          <label for="" class="font-title-grey"> Paciente:</label> <p><a href="{{route('medico.edit',$app->medico->id)}}"><strong>{{$app->patient->name}} {{$app->patient->lastName}}</strong></a></p>
          <label for="" class="font-title-grey">Tipo de Cita:</label> <p>{{$app->title}}</p>
          {{-- <label for="" class="font-title-grey">Especialidad del Medico:</label> <p>{{$app->medico->scpecialty}}</p> --}}

        </div>
      </div>
      <div class="col-lg-4 col-sm-4 col-12">
        <div class="p-2">
          <label for="" class="font-title-grey">Fecha:</label> <p>{{\Carbon\Carbon::parse($app->hour_start)->format('d-m-Y')}}</p>
          <label for="" class="font-title-grey">Hora:</label> <p>{{\Carbon\Carbon::parse($app->hour_start)->format('H:i')}}</p>
          <label for="" class="font-title-grey">Estado:</label> <p>{{$app->state}}</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-4 col-12">
        <div class="p-2">

            <label for="" class="font-title-grey">Solicitada Por:</label> <p>@if($app->stipulated == 'patient') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}

            @endif
          {{-- <label for="" class="font-title-grey">Estrellas Otorgadas:</label> <p>{{$app->score}}</p>
          <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p> --}}
          {{-- <label for="" class="font-title-grey">Comentario:</label> <p>{{$app->comentary}}</p> --}}


        </p>
        <div class="form-inline">
          <a href="{{route('medico_app_details',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id,'app_id'=>$app->id])}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i>Editar</a>
          {{-- <a href="{{route('marcar_como_vista',$app->id)}}" class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="Marcar como vista"><i class="fas fa-check"></i></a> --}}


        </div>
        </div>
      </div>
    </div>



  </div>
</div>
@endforeach
  <div class="card-heading">
    {{$appointments->appends(Request::all())->links()}}
  </div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No ahi registro de Citas Agendadas</h4>
</div>

@endif

@endsection
