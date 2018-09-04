
<div class="p-2 mb-2" id="card_edit">
  <div class="row">
    <div class="col-12">

        @if($event_edit->state != 'Rechazada/Cancelada' and $event_edit->state != 'Pagada y completada' and $event_edit->state != 'Realizada y por cobrar')
            {{-- <h3 class="font-title-blue text-center mb-5">Cerrar Consulta</h3> --}}

        @endif
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-12">
    <input name="medico_id" type="hidden" value="1">

    {!!Form::model($event_edit,['route'=>'update_event','method'=>'POST','id'=>'fo3'])!!}
    {{-- ///PARA MARCARLA COMO PAGADA y PENDIENTE ESTA VARIABLE --}}
    <input type="hidden" name="cerrar_cita" value="" id="cerrar_cita">

    {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id9'])!!}
    {!!Form::hidden('event_id',$event_edit->id,['id'=>'event_id9'])!!}
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
      <input type="hidden" name="" value="{{$start = \Carbon\Carbon::parse($event_edit->start)}}">

      {!!Form::date('date_start',$start,['class'=>'form-control','id'=>'dateStart9','readonly'])!!}

    </div>
  </div>

  <div class="col-3">
    <div class="form-group">
      <label for="" class="font-title">Hora de Inicio</label>

      <div class="row">

        <div
         class="col">
         <input type="hidden" name="" value="{{$start_hour = \Carbon\Carbon::parse($event_edit->start)->format('H')}}">

         {!!Form::text('hourStart',$start_hour,['class'=>'form-control','id'=>'hourStart9','readonly'])!!}</div>
        <div class="col">
            <input type="hidden" name="" value="{{$start_mins = \Carbon\Carbon::parse($event_edit->start)->format('i')}}">

          {!!Form::text('minsStart',$start_mins,['class'=>'form-control','id'=>'minsStart9','readonly'])!!}
        </div>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group text-center">
      <label for="" class="font-title" class="mx-3">Hora de Culminación</label>
      <div class="row">
        <div class="col-lg-6 my-1">
            <input type="hidden" name="" value="{{$end_hour = \Carbon\Carbon::parse($event_edit->end)->format('H')}}">
            {!!Form::text('hourEnd',$end_hour,['class'=>'form-control','id'=>'hourEnd9','readonly'])!!}</div>
        <div class="col-lg-6 my-1">
            <input type="hidden" name="" value="{{$end_mins = \Carbon\Carbon::parse($event_edit->end)->format('i')}}">
            {!!Form::text('minsEnd',$end_mins,['class'=>'form-control','id'=>'minsEnd9','readonly'])!!}</div>

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
      <div class="form-inline" id="button_confirm_app_div">
        {{-- <button onclick="confirmar2()" type="button" name="button" class="btn btn-warning btn-block" id="button_confirm_app">Confirmar Cita</button> --}}
      </div>
    </div>
  </div>

</div>
<div class="row mt-3">
  <div class="col-4">
      @if($event_edit->state != 'Rechazada/Cancelada' and $event_edit->state != 'Pagada y completada' and $event_edit->state != 'Realizada y por cobrar')
     <button onclick="app_cancel()" type="button" name="button" class="btn btn-danger btn-block" id="rechazar">Rechazar/cancelar</button>
    @endif
    {{-- <button onclick="cancel()" type="button" name="button" class="btn btn-danger btn-block" id="rechazar">Rechazar/cancelar</button> --}}
  </div>
  <div class="col-4">
 @if($event_edit->state != 'Rechazada/Cancelada' and $event_edit->state != 'Pagada y completada' and $event_edit->state != 'Realizada y por cobrar')
    <input onclick="cerrar_pago_pendiente()" name="button" type="button" value="Cerrar/Pago Pendiente" class="btn btn-success btn-block" id="but_save"/>
@endif
  </div>
    <div class="col-4">
      {{-- <button onclick="confirmed_payment_or_completed()" type="button" name="button" class="btn btn-info btn-block" id="button_confirmed_payment" value="55">Confirmar Pago</button> --}}
 @if($event_edit->state != 'Rechazada/Cancelada' and $event_edit->state != 'Pagada y completada')
      <button onclick="cerrar_completada()" type="button" name="button" class="btn btn-warning btn-block" id="button_confirmed_complete" value="Cerrar/Pagada completada">Finalizar/completada</button>
      @endif
    </div>


  </div>
  <div id="text_confirm" class="col-12" style="display:none">
      <p class="text-secondary">No tienes permisos para confirmar esta cita. antes de poder de ditar se debe confirmar.</p>

  </div>
  {!!Form::close()!!}
</div>
