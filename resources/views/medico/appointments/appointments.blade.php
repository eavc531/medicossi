@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    @if($type == 'sin confirmar')
    <h2 class="text-center font-title">Citas Nuevas / sin confirmar</h2>
    @elseif($type == 'Citas confirmadas o creadas por médico')
    <h2 class="text-center font-title">Citas Citas confirmadas o creadas por médico</h2>
    @elseif($type == 'Pasada y por Cobrar')
    <h2 class="text-center font-title">Citas Pasadas y por Cobrar</h2>
    @else
    <h2 class="text-center font-title">Citas {{$type}}</h2>
    @endif
  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}
<div class="row my-2">
  <div class="col-12 text-center text-md-center">

      @if($type == 'todas')
          <a href="{{route('appointments_all',\Hashids::encode(request()->id))}}" class="btn btn-azul disabled mt-2">Todas</a>
      @else
          <a href="{{route('appointments_all',\Hashids::encode(request()->id))}}" class="btn btn-azul mt-2">Todas</a>
      @endif

@if($type == 'sin confirmar')
    <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-green disabled mt-2" disabled> Nuevas / sin confirmar</a>
@else
    <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-green mt-2"> Nuevas / sin confirmar</a>
@endif
    @if($type == 'confirmadas')

    <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-azul disabled mt-2" disabled> Citas confirmadas o creadas por médico</a>
@else
    <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-azul  mt-2" disabled> Citas confirmadas o creadas por médico</a>
@endif

@if($type == 'Pagadas y pendientes')
    <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-green disabled mt-2"> Pagadas y pendientes</a>
@else
    <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-green mt-2"> Pagadas y pendientes</a>
@endif





@if($type == 'Pasada y por Cobrar')
    <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn btn-azul text-white disabled mt-2">Pasadas y por cobrar</a>
    @else
    <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn btn-azul text-white mt-2">Pasadas sin realizar</a>
@endif
@if($type == 'Pagadas y Completadas')
    <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-green disabled mt-2 text-black"> Completadas</a>
@else
    <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-green  mt-2 text-black"> Completadas</a>
@endif
@if($type == 'Rechazada/Cancelada')
    <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-azul disabled mt-2">Rechazadas/Canceladas</a>
@else
    <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-azul mt-2">Rechazadas/Canceladas</a>
@endif
@if($type == 'Realizadas y por Cobrar')
    <a href="{{route('app_realizada_por_cobrar',\Hashids::encode(request()->id))}}" class="btn btn-green disabled mt-2">Realizadas y por Cobrar</a>
@else
    <a href="{{route('app_realizada_por_cobrar',\Hashids::encode(request()->id))}}" class="btn btn-green mt-2">Realizadas y por Cobrar</a>
@endif
    
  </div>
</div>
@if($type == 'sin confirmar')
<div class="text-center text-muted">
  <p > Las Citas "Nuevas / Sin confirmar" son las citas agendadas por los pacientes, a través de su cuenta Médicossi. @if ($medico->plan != 'plan_profesional' and $medico->plan != 'plan_platino') (Debes tener activo almenos el plan "Profesional" para que los pacientes puedan realizar esta acción). @endif</p>
</div>
@endif
@if($appointments->first() != Null)
<div class="row">
  @foreach ($appointments as $app)
  <div class="col-lg-12">
    <div class="card date-card my-2 p-2">
      <div class="row">
        <div class="col-sm-4 col-12">
            <label for="" class="textGray mt-1"> Paciente:</label>
            <p class="text-capitalize">{{$app->patient->name}} {{$app->patient->lastName}} </p>
            <p class="text-capitalize"><a href="{{route('medico.edit',\Hashids::encode(request()->id))}}"></a></p>

            <label for="" class="textGray">Tipo de Cita:</label>
            <p class="text-capitalize">{{$app->title}}</p>
            {{-- <label for="" class="textGray">Especialidad del Medico:</label> <p>{{$app->medico->scpecialty}}</p> --}}
            @isset($app->descriptión)
            <label for="" class="textGray">Mensaje o descripción:</label> <p>{{$app->descriptión}}</p>
            @else
            <label for="" class="textGray">Mensaje o descripción:</label>  <p class="text-muted">"No Aplica"</p>
            @endisset
        </div>
        <div class="col-sm-4 col-12">
          <label for="" class="textGray">Fecha:</label>
            <p class="text-capitalize">{{\Carbon\Carbon::parse($app->start)->format('d-m-Y')}}</p>
          <label for="" class="textGray">Hora:</label>
            <p class="text-capitalize">{{\Carbon\Carbon::parse($app->start)->format('H:i')}}</p>
          <label for="" class="textGray">Estado:</label>
            <p class="text-capitalize">{{$app->state}}</p>
        </div>
        <div class="col-sm-4 col-12">
          <div class="mt-2">
            <label for="" class="textGray">Fecha de Creacion:</label>
              <p class="text-capitalize">{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>
            <label for="" class="textGray">Solicitada Por:</label>
              <p class="text-capitalize">@if($app->stipulated == 'Paciente') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}
            @endif
            {{-- <label for="" class="textGray">Calificación:</label> <p>{{$app->calification}}</p>  --}}
            {{-- <label for="" class="textGray">Comentario:</label> <p>{{$app->comentary}}</p> --}}
          </p>
          <div class="form-inline">
            @if($app->confirmed_medico == 'No' and $app->state != 'Rechazada/Cancelada' and $app->state != 'Pagada y Completada')
            <a href="{{route('edit_appointment',['m_id'=>\Hashids::encode(request()->id),'p_id'=>\Hashids::encode($app->patient_id),'app_id'=>\Hashids::encode($app->id)])}}" class="btn btn-green" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i>
            </a>
            @cita_confirm
            <a onclick="loader()" href="{{route('appointment_confirm',\Hashids::encode($app->id))}}" class="btn btn-azul ml-2" data-toggle="tooltip" data-placement="top" title="Confirmar Cita"><i class="fas fa-check"></i></a>
            @else
            <a href="#" class="btn btn-azul ml-2 disabled" data-toggle="tooltip" data-placement="top" title="Confirmar Cita"><i class="fas fa-check"></i></a>
            @endcita_confirm
            @elseif($app->state == 'Rechazada/Cancelada' or $app->state == 'Pagada y Completada')
            @elseif($app->stipulated == 'Medico' or $app->confirmed_medico == 'Si')
            <a href="{{route('edit_appointment',['m_id'=>\Hashids::encode($app->medico_id),'p_id'=>\Hashids::encode($app->patient_id),'app_id'=>\Hashids::encode($app->id)])}}" class="btn btn-green" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i></a>
            @endif
            <strong class="ml-1" >Confirmada: &nbsp;</strong><span> {{$app->confirmed_medico}}</span>
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
<div class="text-green text-center mt-5">
  <h2>No hay registro de citas {{$type}}</h2>
</div>
@endif
@endsection
