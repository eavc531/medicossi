<div class="card p-2 mb-2" id="card_edit" style="display:none">
  <div class="row">
    <div class="col-12">
      <button type="button" class="close" onclick="cerrar_edit()"><span >&times;</span></button>

      {{-- &times; --}}
    </button>
    <h3 class="font-title-blue text-center my-2">Editar Recordatorio</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-12">
    <input name="medico_id" type="hidden" value="1">

    {!!Form::open(['route'=>'reminder_alarm_update','method'=>'POST','id'=>'fo3'])!!}
    {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id9'])!!}
    {!!Form::hidden('event_id',null,['id'=>'event_id9'])!!}
    {!!Form::hidden('event_id3',null,['id'=>'event_id3'])!!}

  </div>



</div>
<div class="row">

  <div class="col-lg-4 col-12">
    <div class="form-group">
      <label for="" class="font-title">Titulo</label>
      {!!Form::text('title',null,['class'=>'form-control','id'=>'title9'])!!}

    </div>
  </div>
  <div class="col-8">
    <div class="form-group">
      <label for="" class="font-title">Descripción (Opcional)</label>
      {!!Form::textarea('description',null,['class'=>'form-control','id'=>'description9','style'=>'height:80px'])!!}

    </div>


  </div>


</div>
<div class="row">

  <div class="col-3">
    <label for="Estado" class="font-title">Estado:</label>
    {{Form::text('state',null,['class'=>'form-control','id'=>'state9','readonly'])}}
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

<div class="row mt-3">
  <div class="col-4">

    {!!Form::hidden('reminder_id',null,['id'=>'reminder_id'])!!}
    <button onclick="reminder_delete()" type="button" name="button" class="btn btn-danger btn-block" id="rechazar">Eliminar</button>
  </div>
  <div class="col-4">

    <input name="mysubmit" type="submit" value="Guardar Cambios" class="btn btn-success btn-block" id="but_save"/>

  </div>

  <div class="col-4">
    <button onclick="cerrar_edit()" type="button" name="button" class="btn btn-secondary btn-block" id="">Cerrar</button>
  </div>



</div>
{!!Form::close()!!}
</div>
