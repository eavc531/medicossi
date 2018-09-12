
<div class="card p-2 mb-2" id="card_edit">
  <div class="row">
    <div class="col-12">

      {{-- &times; --}}
      <a href="{{route('manage_patient',['m_id'=>Hashids::encode($medico->id),'p_id'=>Hashids::encode($patient->id)])}}" class="btn btn-primary btn-sm float-right"><i class="fas  fa-user-cog"></i> Gestionar Paciente</a>

    <h3 class="font-title-blue text-center my-2">Editar</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-12">
    <input name="medico_id" type="hidden" value="1">

    {!!Form::open(['route'=>'update_event','method'=>'POST','id'=>'fo3'])!!}
    {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id9'])!!}
    {!!Form::hidden('event_id',null,['id'=>'event_id9'])!!}
    {!!Form::hidden('event_id3',null,['id'=>'event_id3'])!!}
    {{-- //clones --}}

        {!!Form::hidden('event_id3',null,['id'=>'dateStart99'])!!}
        {!!Form::hidden('event_id3',null,['id'=>'hourStart99'])!!}
        {!!Form::hidden('event_id3',null,['id'=>'minsStart99'])!!}
        {!!Form::hidden('event_id3',null,['id'=>'hourEnd99'])!!}
        {!!Form::hidden('event_id3',null,['id'=>'minsEnd99'])!!}

    {{-- // --}}
    <div class="form-group">
      <label for="" class="font-title">Paciente</label>
      {{Form::text('namePatient',null,['id'=>'namePatient9','class'=>'form-control','readonly'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group">
      <label for="" class="font-title">Tipo de evento</label>
      {!!Form::text('title',null,['class'=>'form-control','id'=>'title9','placeholder'=>'Tipo de Cita','readonly'])!!}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group">
      <label for="" class="font-title">Precio</label>
      {!!Form::number('price',null,['class'=>'form-control','id'=>'price9'])!!}
    </div>
  </div>
  <div class="col-2">
    <label for="" class="font-title">¿Pagó?</label>
    {!!Form::text('payment_state',null,['class'=>'form-control','id'=>'payment_state9','readonly'])!!}
  </div>
</div>

<div class="row">
  <div class="col-lg-3 col-12">
    <div class="form-group">
      <label for="" class="font-title">Descripción (Opcional)</label>
      {!!Form::text('description',null,['class'=>'form-control','id'=>'description9'])!!}

    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group">
      <label for="" class="font-title">Fecha de inicio</label>


      {!!Form::date('date_start',null,['class'=>'form-control','id'=>'dateStart9'])!!}

    </div>
  </div>

  <div class="col-3">
    <div class="form-group">
      <label for="" class="font-title">Hora de Inicio</label>

      <div class="row">
        <div class="col">{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourStart9'])!!}</div>
        <div class="col">
          {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsStart9'])!!}
        </div>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group text-center">
      <label for="" class="font-title" class="mx-3">Hora de Culminación</label>
      <div class="row">
        <div class="col-lg-6 my-1">{!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourEnd9'])!!}</div>
        <div class="col-lg-6 my-1"> {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEnd9'])!!}</div>
      </div>
    </div>
  </div>
</div>
<div class="row">

  <div class="col-3">
    <label for="" class="font-title">Tipo de Pago</label>
    {!!Form::select('payment_method',['Normal'=>'Normal','Pre-pagada'=>'Pre-pagada','Aseguradora'=>'Aseguradora'],null,['class'=>'form-control','id'=>'payment_method9'])!!}
  </div>
  <div class="col-3">
    <label for="Estado" class="font-title">Estado:</label>
    {{Form::text('state',null,['class'=>'form-control','id'=>'state9','readonly'])}}
  </div>
  <div class="col-6 row">
    <div class="col-12 text-center">
      <label for="" class="font-title">Confirmada por:</label>
    </div>
    <div class="col-6">
      <div class="form-inline">
        <label for="" class="font-title">Paciente:</label>
        {{Form::select('confirmed_patient',['No'=>'No','Si'=>'Si'],null,['class'=>'form-control','id'=>'confirmed_patient9','style'=>'width:70px'])}}
      </div>

    </div>
    <div class="col-6">
      <div class="form-inline" id="confirmed_medico_div">
        <label for="" class="font-title">Médico:</label>
        {{Form::text('confirmed_medico',null,['class'=>'form-control','style'=>'width:70px','readonly','id'=>'confirmed_medico9'])}}

      </div>
      {{-- <div class="form-inline" id="button_confirm_app_div">
        <button onclick="confirmar2()" type="button" name="button" class="btn btn-warning btn-block" id="button_confirm_app">Confirmar Cita</button>
      </div> --}}
    </div>
  </div>

</div>
<div class="row mt-3">
  <div class="col-4">
     <button onclick="mail_cancel()" type="button" name="button" class="btn btn-danger btn-block" id="rechazar">Rechazar/cancelar</button>
    {{-- <button onclick="cancel()" type="button" name="button" class="btn btn-danger btn-block" id="rechazar">Rechazar/cancelar</button> --}}
  </div>
  <div class="col-4">

    <input name="mysubmit" type="submit" value="Guardar y Confirmar" class="btn btn-success btn-block" id="but_save"/>

  </div>
    <div class="col-4">
      <button onclick="confirmed_payment_or_completed()" type="button" name="button" class="btn btn-info btn-block" id="button_confirmed_payment" value="55">Confirmar Pago</button>

      <button onclick="confirmed_completed()" type="button" name="button" class="btn btn-warning btn-block" id="button_confirmed_complete" style="display:none">Finalizar/completada</button>
    </div>
  {{-- <div class="col-3">
      @if(Auth::user()->role == 'medico')
          @plan_agenda
              <a href="{{route('appointments_confirmed', Auth::user()->medico_id)}}" class="btn btn-block btn-secondary"> <span>volver a Citas   </span></a>
            @else
              <a href="{{route('appointments', Auth::user()->medico_id)}}" class="btn btn-block btn-secondary"> <span>volver a Citas  </span></a>
          @endplan_agenda
      @else
          @plan_agenda
              <a href="{{route('appointments_confirmed', Auth::user()->assistant->medico_id)}}" class="btn btn-block btn-secondary"> <span>volver a Citas   </span></a>
            @else
              <a href="{{route('appointments', Auth::user()->assistant->medico_id)}}" class="btn btn-block btn-secondary"> <span>volver a Citas  </span></a>
          @endplan_agenda
    @endif --}}


  </div>
  <div id="text_confirm" class="col-12" style="display:none">
      <p class="text-secondary">No tienes permisos para confirmar esta cita. antes de poder de ditar se debe confirmar.</p>

  </div>
  {!!Form::close()!!}
</div>



/////////
/@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-12 mb-3">
      @if($type == 'sin confirmar')
        <h3 class="text-center font-title">Citas Nuevas / sin confirmar
      @elseif($type == 'Citas confirmadas o Creadas por médico')
        <h3 class="text-center font-title">Citas Citas confirmadas o Creadas por médico
      @elseif($type == 'Pasada y sin realizar')
        <h3 class="text-center font-title">Citas Pasadas y sin realizar
        @elseif($type == 'todas')
          <h3 class="text-center font-title">Citas
         @elseif($type == 'Realizadas y por cobrar')
            <h3 class="text-center font-title">Citas Realizadas y por cobrar
      @else
        <h3 class="text-center font-title">Citas {{$type}}
      @endif
        con el paciente: {{$patient->nameComplete}}
        </h3>
    </div>
  </div>
  {{-- MENU DE PACIENTES --}}
  {{-- @include('medico.includes.main_medico_patients') --}}
  <div class="row mt-4 mb-1">
    <div class="col-12 mb-1">

      @if($type == 'sin confirmar')
          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2 disabled"> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>


      @elseif($type == 'Realizadas y por cobrar')

          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white disabled" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>

      @elseif($type == 'Pasada y por realizar')

          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2 disabled" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>

      @elseif($type == 'confirmadas')

          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2 disabled"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'Pagadas y Pendientes')
          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2"> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2 disabled"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'Pagadas y Completadas')
          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2" disabled> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2 disabled"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'todas')
          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2 disabled">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2" disabled> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>
      @elseif($type == 'Pasada y sin realizar')


          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2" disabled> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2 disabled" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2"> Canceladas</a>
      @else
          <a href="{{route('patient_appointments_all',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-success mt-2">Todas</a>
          {{-- @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino') --}}

            <a href="{{route('patient_appointments_no_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-warning mt-2" disabled> Nuevas / sin confirmar</a>
            <a href="{{route('patient_appointments_confirmed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-primary mt-2"> Citas confirmadas o Creadas por médico</a>
          {{-- @endif --}}
          <a href="{{route('patient_appointments_paid_and_pending',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-info mt-2"> Pagadas y Pendientes</a>
          <a href="{{route('patient_app_realizada_por_cobrar',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn mt-2 text-white" style="background:rgb(92, 40, 221)">Realizadas y por cobrar</a>
          <a href="{{route('patient_appointments_past_collect',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn text-white mt-2" style="background:rgb(119, 38, 88)">Pasadas y sin realizar</a>
          <a href="{{route('patient_appointments_completed',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2"> Completadas</a>
          <a href="{{route('patient_appointments_canceled',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-danger mt-2 disabled"> Canceladas</a>
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

                  <label for="" class="font-title-grey">Fecha:</label> <p>{{\Carbon\Carbon::parse($app->start)->format('d-m-Y')}}</p>
                  <label for="" class="font-title-grey">Hora:</label> <p>{{\Carbon\Carbon::parse($app->start)->format('H:i')}}</p>
                  <label for="" class="font-title-grey">Estado:</label> <p>{{$app->state}}</p>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-12">
                <div class="mt-2">
                  <label for="" class="font-title-grey">Fecha de Creacion:</label> <p>{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>

                  <label for="" class="font-title-grey">Solicitada Por:</label> <p>@if($app->stipulated == 'Paciente') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}

                  @endif
                  {{-- <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p>  --}}
                  {{-- <label for="" class="font-title-grey">Comentario:</label> <p>{{$app->comentary}}</p> --}}
                </p>
                <div class="form-inline">
                  @if($app->confirmed_medico == 'No' and $app->state != 'Rechazada/Cancelada' and $app->state != 'Pagada y Completada')
                    <a href="{{route('edit_appointment',['m_id'=>\Hashids::encode(request()->id),'p_id'=>\Hashids::encode($app->patient_id),'app_id'=>\Hashids::encode($app->id)])}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i></a>
                    @cita_confirm
                    <a onclick="loader()" href="{{route('appointment_confirm',\Hashids::encode($app->id))}}" class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="Confirmar Cita"><i class="fas fa-check"></i></a>
                    @else
                    <a href="#" class="btn btn-success ml-2 disabled" data-toggle="tooltip" data-placement="top" title="Confirmar Cita"><i class="fas fa-check"></i></a>
                    @endcita_confirm
                @elseif($app->state == 'Rechazada/Cancelada' or $app->state == 'Pagada y Completada')

                @elseif($app->stipulated == 'Medico' or $app->confirmed_medico == 'Si')
                    <a href="{{route('edit_appointment',['m_id'=>\Hashids::encode($app->medico_id),'p_id'=>\Hashids::encode($app->patient_id),'app_id'=>\Hashids::encode($app->id)])}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i></a>
                @endif
                  <a class="btn btn-secondary ml-2" href="" data-toggle="tooltip" data-html="true" title="<em>Acciones Realizadas</em>"><i class="fas fa-list"></i></a>
                     <strong class="ml-1">Confirmada:</strong><span>{{$app->confirmed_medico}}</span>
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
    <h5>No ahi registro de citas</h5>
  </div>

@endif

@endsection
