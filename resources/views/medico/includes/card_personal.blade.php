<div class="card p-2 mb-2" id="card_personal" style="display:none">
  <div class="row">
    <div class="col-12">
    <h3 class="font-title-blue text-center my-2">Editar</h3>
  </div>
</div>

{{-- {!!Form::open(['route'=>'update_event','method'=>'POST','id'=>'fo3'])!!} --}}
<div class="row">
<div class="col-lg-4 col-12">
    <div class="form-group">
      <label for="" class="font-title">Tipo de evento</label>
      {{-- //event_id 10 --}}
      <input type="hidden" name="event_id" value="" id="event_id10">

      {!!Form::text('title',null,['class'=>'form-control','id'=>'title10','readonly'])!!}

    </div>
  </div>
  <div class="col-8">
      <div class="form-group">
        <label for="" class="font-title">Descripción</label>
        {!!Form::text('description',null,['class'=>'form-control','id'=>'description10'])!!}

      </div>
</div>
<div class="col-lg-3 col-12">
  <div class="form-group">
    <label for="" class="font-title">Fecha de inicio</label>
    {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start10'])!!}

  </div>
</div>

<div class="col-3">
  <div class="form-group">
    <label for="" class="font-title">Hora de Inicio</label>

    <div class="row">
      <div class="col">{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hour_start10'])!!}</div>
      <div class="col">
        {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'mins_start10'])!!}
      </div>
    </div>
  </div>
</div>
<div class="col-3">
  <div class="form-group text-center">
    <label for="" class="font-title" class="mx-3">Hora de Culminación</label>
    <div class="row">
      <div class="col-lg-6 my-1">{!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hour_end10'])!!}</div>
      <div class="col-lg-6 my-1"> {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'mins_end10'])!!}</div>
    </div>
  </div>
</div>

<div class="col-4">
    <button type="button" name="button" onclick="update_event_personal()" class="btn btn-primary btn-block">Guardar Cambios</button>
</div>
<div class="col-4">
    <button type="button" name="button" onclick="confirm('¿Estas Segur@ de eliminar este evento?');event_personal_delete()" class="btn btn-danger btn-block">Borrar</button>
</div>
<div class="col-4">
    <button type="button" name="button" onclick="$(this).parents('.card').fadeOut()" class="btn btn-secondary btn-block">Cerrar</button>
</div>
</div>
{{-- {!!Form::close()!!} --}}
</div>
{{-- parents('ul') --}}
