@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
      <div class="col-10 mb-3">
      <h2 class="text-center font-title">Calificar cita con Médico: {{$app->medico->name}} {{$app->medico->lastName}} </h2>
    </div>
    <div class="col-1 text-right">
      <a href="{{route('patient_appointments',\Hashids::encode($app->patient_id))}}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Atras</a>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-lg-8 m-lg-auto col-sm-8 m-sm-auto col-12 card card-style">
      <div class="row">
        <div class="col-12  bg-primary text-white text-center">
         <p class="mt-3"><b>Tipo de Cita: {{$app->title}}</b></p>
       </div>
     </div>
     <div class="card-body">
      <div class="row">
        <div class="col-12">
          {{-- <label for="" class="font-title-grey">Medico:</label><p> <a href="{{route('medico.edit',$app->medico->id)}}"><strong>{{$app->medico->name}} {{$app->medico->lastName}}</strong></a></p> --}}
          <label for="" class="font-title-grey">Especialidad del Medico:</label> <p>{{$app->medico->specialty}}</p>
          @isset($app->descriptión)
          <label for="" class="font-title-grey">Mensaje o descriptión:</label> <p>{{$app->descriptión}}</p>
          @endisset
        </div>
        <div class="col-6">
          <label for="" class="font-title-grey">Fecha:</label>
          <p>{{\Carbon\Carbon::parse($app->hour_start)->format('d-m-Y')}}</p>
          <label for="" class="font-title-grey">Estado:</label>
          <p>{{$app->state}}</p>
          {{--}}@isset($app->medico->phoneOffice1) Teléfono 1: {{$app->medico->phoneOffice1}}@endisset
          @isset($app->medico->phoneOffice2) Teléfono 2: {{$app->medico->phoneOffice2}}@endisset --}}
        </div>
        <div class="col-6">
          <label for="" class="font-title-grey">Hora:</label>
          <p>{{\Carbon\Carbon::parse($app->hour_start)->format('H:i')}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 nopadding">
        <div class="card-footer">
          <div class="form-group">
            @if($app->score == Null)
            <h5 class="font-title-blue">Calificar Cita </h5>
            @else
            <strong>Editar Cita</strong>
            @endif
          </div>
          {!!Form::model($app,['route'=>'store_rate_comentary','method'=>'POST'])!!}
          <p class="m-0">Calificación sobre el servicio del Médico: </p>
          <div class="row p-3">
            <div class="col-12 col-lg nopadding">
              {{Form::radio('score',1,['class'=> 'mr-1'])}}  Muy Malo
            </div>
            <div class="col-12 col-lg nopadding">
              {{Form::radio('score',2,['class'=> 'mr-1'])}}  Malo
            </div>
            <div class="col-12 col-lg nopadding">
              {{Form::radio('score',3,['class'=> 'mr-1'])}}  Regular
            </div>
            <div class="col-12 col-lg nopadding">
             {{Form::radio('score',4,['class'=> 'mr-1'])}}  Bueno
           </div>
           <div class="col-12 col-lg nopadding">
             {{Form::radio('score',5,['class'=> 'mr-1'])}}  Muy Bueno
           </div>

         </div>
         <div class="form-group">
          <label for="" class="font-title-grey">Comentario sobre la Cita:</label>
          {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px'])!!}

          {{-- <input type="hidden" name="event_id" value="{{$app->id}}">
        </div>
        <input type="submit" name="" value="Guardar" class="btn btn-success">
        <a href="{{route('patient_appointments',$app->patient_id)}}" class="btn btn-secondary">Cancelar</a> --}}
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>
@endsection
