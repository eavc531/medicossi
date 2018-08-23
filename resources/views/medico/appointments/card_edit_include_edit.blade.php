
<div class="card p-2 mb-2" id="card_edit">
  <div class="row">
    <div class="col-12">

      {{-- &times; --}}
    </button>
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
