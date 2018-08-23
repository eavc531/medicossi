@extends('layouts.app')

@section('content')
<section class="container">
  <div class="row">
    <div class="col-8 mb-3">
      <h2 class="text-center font-title">Editar Datos de Centro Médico</h2>
    </div>
    <div class="col-lg col-12 text-right">
      <a class="btn btn-primary" href="{{route('medicalCenter.edit',\Hashids::encode(request()->id))}}">Atras</a>
    </div>
  </div>
  {!!Form::model($medicalCenter,['route'=>['medical_center_update_address',\Hashids::encode($medicalCenter)],'method'=>'update'])!!}
  <div class="row my-3">
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Pais</label>
        {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Estado</label>
        {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Ciudad</label>
        {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title" >Codigo Postal</label>
        {{Form::number('postal_code',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title" >Colonia</label>
        {{Form::text('colony',null,['class'=>'form-control'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">

       <label class="font-title" for="[object Object]">Calle/Av (especifique)</label>
       {{Form::text('street',null,['class'=>'form-control'])}}
     </div>
   </div>
   <div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="" class="font-title">Numero Externo</label>
      {{Form::text('number_ext',null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="" class="font-title">Numero Interno</label>
      {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2'])}}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-12 mt-2">
    <a href="{{route('medicalCenter.edit',\Hashids::encode($medicalCenter->id))}}" class="btn btn-primary btn-block">Cancelar</a>
  </div>
  <div class="col-lg-6 col-12 mt-2">
    <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
  </div>
</div>
{!!Form::close()!!}
</section>

@endsection

@section('scriptJS')

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDh9hTFPYHnnfVtoHSXysAdzQjmxKuZd3s"></script>
<script src="{{asset('geocoder_autocomplete\jquery.geocomplete.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function(){


    $("#input").geocomplete({
      map:"#my_input"
    });

  });

  $("#find").click(function(){
    $("input").trigger("geocode");
  });


/////////////////////////////

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
