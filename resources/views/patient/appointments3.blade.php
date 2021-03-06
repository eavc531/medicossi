@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-12 mb-3">
      @if($type == 'sin confirmar')
        <h2 class="text-center font-title">Citas Nuevas / sin confirmar</h2>
      @elseif($type == 'Citas confirmadas o Creadas por médico')
        <h2 class="text-center font-title">Citas Citas confirmadas o Creadas por médico</h2>
      @elseif($type == 'Pasada y por Cobrar')
        <h2 class="text-center font-title">Citas Pasadas y por Cobrar</h2>
      @else
        <h2 class="text-center font-title">Citas {{$type}}</h2>
      @endif
    </div>
  </div>
  {{-- MENU DE PACIENTES --}}
  {{-- @include('medico.includes.main_medico_patients') --}}
  <div class="row mt-4 mb-1">
    <div class="col-12 mb-1">
      @if($type == 'sin confirmar')
        <a href="{{route('patient_appointments',\Hashids::encode(request()->id))}}" class="btn btn-success mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning disabled mt-2" disabled> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary mt-2"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'confirmadas')
        <a href="{{route('patient_appointments',\Hashids::encode(request()->id))}}" class="btn btn-success mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}
          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary disabled mt-2" disabled> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary mt-2"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'Pagadas y Pendientes')
        <a href="{{route('patient_appointments',\Hashids::encode(request()->id))}}" class="btn btn-success mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}
          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info disabled mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary mt-2"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger"> Canceladas</a>
      @elseif($type == 'Pagadas y Completadas')
        <a href="{{route('patient_appointments',\Hashids::encode(request()->id))}}" class="btn btn-success mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}
          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary disabled mt-2 text-black" style="color:black"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'todas')
        <a href="{{route('appointments_all',\Hashids::encode(request()->id))}}" class="btn btn-success disabled mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}
          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary text-black mt-2" style="color:black"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'Pasada y por Cobrar')
        <a href="{{route('patient_appointments',\Hashids::encode(request()->id))}}" class="btn btn-success mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}
          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white disabled mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary text-black mt-2" style="color:black"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger mt-2"> Canceladas</a>
      @else
        <a href="{{route('patient_appointments',\Hashids::encode(request()->id))}}" class="btn btn-success mt-2">Todas</a>
        {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}
          <a href="{{route('appointments',\Hashids::encode(request()->id))}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
          <a href="{{route('appointments_confirmed',\Hashids::encode(request()->id))}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
        {{-- @endif --}}
        <a href="{{route('appointments_paid_and_pending',\Hashids::encode(request()->id))}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
        <a href="{{route('appointments_past_collect',\Hashids::encode(request()->id))}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y por cobrar</a>
        <a href="{{route('appointments_completed',\Hashids::encode(request()->id))}}" class="btn btn-secondary mt-2"> Completadas</a>
        <a href="{{route('appointments_canceled',\Hashids::encode(request()->id))}}" class="btn btn-danger disabled mt-2" disabled> Canceladas</a>
      @endif

    </div>
  </div>
    @if($type == 'sin confirmar')
<div class="">
  <p class="text-justify text-secondary" style="font-size:12px"> Las Citas "Nuevas / sin confirmar" son las citas agendadas por los pacientes, a travez de su cuenta Médicossi. @if ($medico->plan != 'plan_profesional' and $medico->plan != 'plan_platino') (Debes tener activo almenos el plan "Profesional" para que los pacientes puedan realizar esta acción). @endif</p>
</div>
@endif
  @if($appointments->first() != Null)
    <div class="row">
      @foreach ($appointments as $app)
        <div class="col-lg-12">
          <div class="card date-card my-2">
            <div class="row">
              <div class="col-lg-4 col-sm-4 col-12">
                <div class="mt-2">
                  <label for="" class="font-title-grey mt-1"> Paciente: </label>{{$app->patient->name}} {{$app->patient->lastName}} <p><a href="{{route('medico.edit',\Hashids::encode(request()->id))}}"><strong></strong></a></p>
                  <label for="" class="font-title-grey">Tipo de Cita:</label> <p>{{$app->title}}</p>
                  {{-- <label for="" class="font-title-grey">Especialidad del Medico:</label> <p>{{$app->medico->scpecialty}}</p> --}}
                  @isset($app->descriptión)
                    Mensaje o descripción: <p>{{$app->descriptión}}</p>
                  @else
                    Mensaje o descripción:  <p style="color:rgb(153, 153, 158)">"No Aplica"</p>
                  @endisset

                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-12">
                <div class="mt-2">
                  <label for="" class="font-title-grey">Fecha:</label> <p>{{\Carbon\Carbon::parse($app->hour_start)->format('d-m-Y')}}</p>
                  <label for="" class="font-title-grey">Hora:</label> <p>{{\Carbon\Carbon::parse($app->hour_start)->format('H:i')}}</p>
                  <label for="" class="font-title-grey">Estado:</label> <p>{{$app->state}}</p>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-12">
                <div class="mt-2">
                  <label for="" class="font-title-grey">Fecha de Creacion:</label> <p>{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>

                  <label for="" class="font-title-grey">Solicitada Por:</label> <p>@if($app->stipulated == 'Paciente') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}
                  @endif
                  {{-- <label for="" class="font-title-grey">Estrellas Otorgadas:</label> <p>{{$app->score}}</p>
                  <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p> --}}
                  {{-- <label for="" class="font-title-grey">Comentario:</label> <p>{{$app->comentary}}</p> --}}
                </p>
                <div class="form-inline">
                  @if($app->confirmed_medico == 'No')
                    <a href="{{route('edit_appointment',['m_id'=>\Hashids::encode(request()->id),'p_id'=>\Hashids::encode($app->patient_id),'app_id'=>\Hashids::encode($app->id)])}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i></a>
                    @cita_confirm
                    <a href="{{route('appointment_confirm',\Hashids::encode($app->id))}}" class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="Confirmar Cita"><i class="fas fa-check"></i></a>
                    @else
                    <a href="{{route('appointment_confirm',\Hashids::encode($app->id))}}" class="btn btn-success ml-2 disabled" data-toggle="tooltip" data-placement="top" title="Confirmar Cita"><i class="fas fa-check"></i></a>
                    @endcita_confirm
                @elseif($app->state == 'Rechazada/Cancelada' or $app->state == 'Pagada y Completada')

                @elseif($app->stipulated == 'Medico' or $app->confirmed_medico == 'Si')
                    <a href="{{route('edit_appointment',['m_id'=>\Hashids::encode($app->medico_id),'p_id'=>\Hashids::encode($app->patient_id),'app_id'=>\Hashids::encode($app->id)])}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i></a>
                  @endif
                     <strong class="ml-1" >Confirmada:</strong><span>{{$app->confirmed_medico}}</span>
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
    <h5>No ahi registro de citas {{$type}}</h5>
  </div>
@endif

@endsection
