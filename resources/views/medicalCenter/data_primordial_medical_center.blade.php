@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="row mb-3">
    <div class="col-lg col-12">
    </div>
    <div class="col-lg col-12 text-right">
      <a class="btn btn-primary" href="{{route('medicalCenter.edit',request()->id)}}">Atras</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mb-3">
      <h5 class="font-title">Bienevenido: {{$medicalCenter->nameAdmin}} </h5>
      <p>Por Favor rellene los datos a continuación, requeridos para poder gestionar correctamente todas las funciones de nuestro  sistema.</p>
    </div>
  </div>
  {!!Form::model($medicalCenter,['route'=>['medicalCenter.update',$medicalCenter],'method'=>'PUT'])!!}
  <div class="row">
    <div class="col-lg-6 col-sm-12 col-12">
      <div class="form-group">
        <label for="" class="font-title">Nombre de la Institución o Centro Medico</label>
        {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Centro Medico'])}}

      </div>
      <div class="form-group">
        <label for="" class="font-title">Nombre del Administrador</label>
        {{Form::text('nameAdmin',null,['class'=>'form-control','placeholder'=>'Nombre del Administrador'])}}
      </div>

    </div>
    <div class="col-lg-6 col-sm-12 col-12">
      <div class="form-group">
        <div class="form-group">
          <label for="" class="font-title">Email de la institución (opcional)</label>
          {{Form::text('email_institution',null,['class'=>'form-control'])}}
        </div>
      </div>
      <div class="form-group">
        <label for="" class="font-title">Teléfono del Administrador</label>
        {{Form::text('phone_admin',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Licencia sanitaria</label>
        {{Form::text('sanitary_license',null,['class'=>'form-control'])}}
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Id del Centro Medico</label>
        {{Form::text('id_medicalCenter',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Telefono de Oficina 1</label>
        {{Form::text('phone',null,['class'=>'form-control'])}}
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Telefono de Oficina 2</label>
        {{Form::text('phone2',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>
  <div class="row">
   <div class="col-12">
    <label for="" class="font-title-blue"><b>Dirección de la Institución o Centro Médico</b></label>
  </div>
</div>
<div class="row my-3">
  <div class="col-lg-6 col-sm-6 col-12">
    <div class="form-group">
      <label for="" class="font-title">Pais</label>
      {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <div class="form-group">
      <label for="" class="font-title">Estado</label>
      {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
    </div>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <div class="form-group">
      <label for="" class="font-title">Ciudad</label>
      {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}
    </div>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <div class="form-group">
      <label for="" class="font-title" >Codigo Postal</label>
      {{Form::number('postal_code',null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <div class="form-group">
      <label for="" class="font-title" >Colonia</label>
      {{Form::text('colony',null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <div class="form-group">
     <label for="[object Object]" class="font-title">Calle/Av (especifique)</label>
     {{Form::text('street',null,['class'=>'form-control'])}}
   </div>
 </div>
 <div class="col-lg-6 col-sm-6 col-12">
  <div class="form-group">
    <label for="" class="font-title col-12">Numero Externo</label>
    {{Form::text('number_ext',null,['class'=>'form-control'])}}
  </div>
</div>
<div class="col-lg-6 col-sm-6 col-12">
  <div class="form-group">
    <label for="" class="font-title col-12">Numero Interno</label>
    {{Form::text('number_int',null,['class'=>'form-control'])}}
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-6 col-sm-6 col-12 mt-2">

  </div>
  <div class="col-lg-6 col-sm-6 col-12 mt-2">
    <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
  </div>
</div>
{!!Form::close()!!}
</div>
</section>
@endsection

@section('scriptJS')

<script type="text/javascript">

  $('#state').on('change', function() {

    state = $('#state').val();

    route = "{{route('inner_cities_select3')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'post',
      url: route,
      data:{name:state},
      success:function(result){
        console.log(result);
        $("#city").empty();
        $('#city').append($('<option>', {
         value: null,
         text: 'opciones'
       }));
        $.each(result,function(key, val){
         $('#city').append($('<option>', {
          value: val,
          text: val
        }));
       });
      },
      error:function(error){
        console.log(error);
      },
    });
  })

</script>
@endsection
