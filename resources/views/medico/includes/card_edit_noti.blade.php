

<div id="alert_success_1" class="alert-success p-3 m-2" style="display:none">
  <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
  <p id="text_success_1" style="font-size:12px"></p>
  <a href="{{route('home')}}" class="btn btn-outline-primary">volver a inicio</a>
</div>

<div class="alert-info p-3 m-2" style="display:none" id="procesando">
  Procesando... por favor espere.
</div>

<div class="card p-2" id="card_edit">

  <div id="alert_danger_up1" class="alert alert-danger alert-dismissible fade show text-left" role="alert" style="display:none">
    <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
    <h4 id="text_danger" style="font-size:12px"></h4>
  </div>
  <div class="row">
    <div class="col-12">
      {{-- <button type="button" name="button" class="close" onclick="close_edit()"> --}}
        {{-- &times; --}}
      </button>
      <h3 class="font-title-blue text-center my-2">Editar</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-12">
      <input name="medico_id" type="hidden" value="1">
      {!!Form::model($app,['route'=>'update_event','method'=>'POST','id'=>'fo3'])!!}
      {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id4'])!!}
      {!!Form::hidden('event_id',$app->id,['id'=>'event_id2'])!!}
      <div class="form-group">
        <label for="" class="font-title">Paciente</label>
        {{Form::text('namePatient',null,['id'=>'namePatient','class'=>'form-control','disabled'])}}
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="form-group">
        <label for="" class="font-title">Tipo de evento</label>
        {!!Form::text('title',null,['class'=>'form-control','id'=>'titleUp1'])!!}
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="form-group">
        <label for="" class="font-title">Descripción (Opcional)</label>
        {!!Form::text('description',null,['class'=>'form-control','id'=>'descriptionUp4'])!!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-12">
      <div class="form-group">
        <label for="" class="font-title">Precio</label>
        {!!Form::text('price',null,['class'=>'form-control','id'=>'priceUp1'])!!}
      </div>
    </div>
    <div class="col-lg-3 col-12">
      <div class="form-group">
        <label for="" class="font-title">Fecha de inicio</label>
        {!!Form::date('date_start',\Carbon\Carbon::parse($app->start),['class'=>'form-control','id'=>'dateStartUp1'])!!}
      </div>
    </div>

    <div class="col-3">
      <div class="form-group">
        <label for="" class="font-title">Hora de Inicio</label>

        <div class="row">
          <div class="col">{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],\Carbon\Carbon::parse($app->start)->format('H'),['class'=>'form-control','id'=>'hourStartUp1'])!!}</div>
          <div class="col">
            {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],\Carbon\Carbon::parse($app->start)->format('i'),['class'=>'form-control','id'=>'minsStartUp1'])!!}
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group text-center">
        <label for="" class="font-title" class="mx-3">Hora de Culminación</label>
        <div class="row">
          <div class="col-lg-6 my-1">{!!Form::select('hourEnd',['--'=>'--','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],\Carbon\Carbon::parse($app->end)->format('H'),['class'=>'form-control','id'=>'hourEndUp1'])!!}</div>
          <div class="col-lg-6 my-1"> {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],\Carbon\Carbon::parse($app->end)->format('i'),['class'=>'form-control','id'=>'minsEndUp1'])!!}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    {{-- <div class="col-lg-4">
      <div class="form-group text-center">
        <label for="" class="font-title">Fecha de Culminación</label>
        {!!Form::date('date_End',null,['class'=>'form-control','id'=>'dateEndUp1'])!!}
      </div>
    </div> --}}
    <div class="col-3">
      <label for="" class="font-title">Tipo de Pago</label>
      {!!Form::select('payment_method',['Normal'=>'Normal','Pre-pagada'=>'Pre-pagada','Aseguradora'=>'Aseguradora'],null,['class'=>'form-control','id'=>'payment_method7'])!!}
    </div>
    <div class="col-3">
      <label for="Estado" class="font-title">Estado:</label>
      {{Form::select('state',['Pendiente'=>'Pendiente','Pagada'=>'Pagada','Cerrada y Cobrada'=>'Cerrada y Cobrada'],null,['class'=>'form-control','id'=>'state'])}}
    </div>
    <div class="col-6 row">
      <div class="col-12 text-center">
          <label for="" class="font-title">Confirmada por:</label>
      </div>
        <div class="col-6">
          <div class="form-inline">
            <label for="" class="font-title">Paciente:</label>
            {{Form::select('confirmed_patient',['No'=>'No','Si'=>'Si'],null,['class'=>'form-control','id'=>'confirmed_patient','style'=>'width:70px'])}}
          </div>

        </div>
        <div class="col-6">
          <div class="form-inline">
            <label for="" class="font-title">Médico:</label>
            {{Form::text('confirmed_medico',null,['class'=>'form-control','style'=>'width:70px','disabled'])}}
          </div>
        </div>
    </div>

  </div>




  <div class="row mt-4">


    <div class="col-4">
      <button type="button" name="button" class="btn btn-danger btn-block" id="rechazar">Rechazar/cancelar</button>

    </div>
    {{-- <div class="col-3">
      <a href="{{route('medico_app_details',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id,'app_id'=>$app->id])}}" class="btn-block btn btn-secondary my-1">Cancelar</a>

    </div> --}}

     <div class="col-4">
       {{-- <input type="submit" name="Submit" value="Enviar" onclick="javascript:this.disabl ed= true;" /> --}}
       <input type="submit" value="Enviar!" onclick="loader();this.form.submit();">
       {{-- <button  type="submit" name="button" value="Guardar y Confirmar" onclick="this.disabled=true;" class="btn btn-success btn-block" >y</button> --}}

     </div>

   <div class="col-4">
     @if($app->medico_confirmed == 'No')
     <a href="{{route('appointment_confirm',$app->id)}}" class="btn btn-info btn-block" id="confirmar">Confirmar Cita</a>
   </div>
     @endif
</div>
{!!Form::close()!!}
</div>
