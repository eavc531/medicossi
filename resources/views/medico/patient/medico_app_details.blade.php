@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
      <div class="col-10 mb-3">
      <h2 class="text-center font-title">Detalles de Cita: {{$app->patient->name}} {{$app->patient->lastName}} </h2>
    </div>
    <div class="col-12 text-right">

        <a href="{{route('notification_appointments',$app->medico_id)}}" class="btn btn-primary">Notificaciones</a>
        <a href="{{route('medico_appointments_patient',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id])}}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Atras</a>


    </div>
  </div>


  <div class="col-lg-12">
    <div class="card date-card my-2">
      <div class="card-header bg-primary text-white">
       <p class="mt-3"><b>Tipo de Cita: {{$app->title}}</b></p>
      </div>
      <div class="card-body">


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
          <label for="" class="font-title-grey">Fecha:</label> <p>{{\Carbon\Carbon::parse($app->start)->format('d-m-Y')}}</p>
          <label for="" class="font-title-grey">Hora inicio:</label> <p>{{\Carbon\Carbon::parse($app->start)->format('H:i')}}</p>
          <label for="" class="font-title-grey">Hora Culminacion:</label> <p>{{\Carbon\Carbon::parse($app->end)->format('H:i')}}</p>
          <label for="" class="font-title-grey">Estado:</label> <p>{{$app->state}}</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-4 col-12">
        <div class="p-2">
          <label for="" class="font-title-grey">Fecha de Creacion:</label> <p>{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>

            <label for="" class="font-title-grey">Solicitada Por:</label> <p>@if($app->stipulated == 'patient') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}

            @endif
          {{-- <label for="" class="font-title-grey">Estrellas Otorgadas:</label> <p>{{$app->score}}</p>
          <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p> --}}
          {{-- <label for="" class="font-title-grey">Comentario:</label> <p>{{$app->comentary}}</p> --}}


        </p>
        <div class="form-inline">

          {{-- <a href="{{route('marcar_como_vista',$app->id)}}" class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="Marcar como vista"><i class="fas fa-check"></i></a> --}}


        </div>
        </div>
      </div>
    </div>
      </div>
    <div class="card-footer">
      @isset($app->descriptión)
      Mensaje o descripción: <p>{{$app->descriptión}}</p>
      @else
      Mensaje o descripción:  <p style="color:rgb(153, 153, 158)">"No Aplica"</p>
      @endisset
      <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6">
          <a href="{{route('edit_appointment',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id,'app_id'=>$app->id])}}" class="btn btn-warning btn-block" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i>Editar/Cambiar Fecha</a>
        </div>
      </div>

    </div>
</div>



</div>
</div>
</section>
@endsection
