@extends('layouts.app')
@section('css')
    <style media="screen">
        .input-red{
            border-color: rgb(205, 50, 50);
        }
    </style>
@endsection
@section('content')
<section class="box">
  <div class="row">
    <div class="col-12 text-right">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary">1</button>
        <button type="button" class="btn btn-secondary">2</button>
        <button type="button" class="btn btn-config-blue">3</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mb-3">
      <h2 class="text-center font-title">Dirección de Paciente</h2>
    </div>
  </div>
  {{$patient->mame}}
  {!!Form::model($patient,['route'=>['patient_store_address',\Hashids::encode($patient->id)],'method'=>'update'])!!}

  <div class="col-lg-11 m-lg-auto col-12">
    <div class="row mt-3">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" class="font-title">Pais</label>
          {{Form::text('country','Mexico',['class'=>'form-control input-red','readOnly'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="" class="font-title">Codigo Postal</label>
            {{Form::number('postal_code',null,['class'=>'form-control input-red'])}}
          </div>
      </div>
      <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="" class="font-title">Estado</label>
            {{Form::select('state',$states,null,['class'=>'form-control input-red','id'=>'state','placeholder'=>'opciones'])}}
          </div>

      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" class="font-title">Ciudad</label>
          {{Form::select('city',$cities,null,['class'=>'form-control input-red','id'=>'city','placeholder'=>'opciones'])}}

        </div>
      </div>
    </div>
    <div class= "row mt-2">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" class="font-title">Colonia</label>
          {{Form::text('colony',null,['class'=>'form-control input-red'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">

         <label for="[object Object]" class="font-title">Calle/Av (especifique)</label>
         {{Form::text('street',null,['class'=>'form-control input-red'])}}
       </div>
     </div>
     <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Numero Externo (Opcional)</label>
        {{Form::text('number_ext',null,['class'=>'form-control '])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Numero Interno (Opcional)</label>
        {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2'])}}
      </div>
    </div>
  </div>
  <div class="row">
    @if($patient->stateConfirm == 'complete')
    <div class="col-lg-6 col-12 mt-2">
      <a href="{{route('patient_profile',\Hashids::encode($patient->id))}}" class="btn btn-primary btn-block">Cancelar</a>
    </div>
    @endif
    <div class="col-lg-6 col-12 mt-2">

      <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
    </div>
  </div>
</div>
{!!Form::close()!!}



<!-- <div class="row mt-4">
  <div class="col-6">
    <div class="input-group">
        <input type="text" name="" class="form-control input-red" value="" id="input">
      <div class="input-group-prepend">
       <button type="button" name="button" class="btn btn-primary text-right input-group-text" id="find">test</button>
     </div>
   </div>
 </div>
 <div class="col-12">
  <div class="mt-3" id="my_input" style="height:400px;width:100%">

  </div>
</div>
</div> -->
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
