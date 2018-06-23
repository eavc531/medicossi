@extends('layouts.app')

@section('css')
  <style media="screen">
    .form-control{
      border-color:rgb(200, 38, 38);
    }
  </style>
@endsection

@section('content')
<section class="box">
  <div class="row">
    <div class="col-12 mb-3">
      <h2 class="text-center font-title">Editar Datos de Médico {{$medico->name}} {{$medico->lastName}}</h2>
    </div>
  </div>
  {!!Form::model($medico,['route'=>['medico_update_address',$medico],'method'=>'update'])!!}

  <div class="col-lg-11 m-lg-auto col-12">
    <div class="row mt-3">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="">Pais</label>
          {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="">Estado</label>
          {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="">Ciudad</label>
          {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" >Codigo Postal</label>
          {{Form::number('postal_code',null,['class'=>'form-control'])}}
        </div>
      </div>
    </div>
    <div class= "row mt-2">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" >Colonia</label>
          {{Form::text('colony',null,['class'=>'form-control'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">

         <label for="[object Object]">Calle/Av (especifique)</label>
         {{Form::text('street',null,['class'=>'form-control'])}}
       </div>
     </div>
     <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="">Numero Externo</label>
        {{Form::text('number_ext',null,['class'=>'form-control','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="">Numero Interno</label>
        {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
      </div>
    </div>
  </div>
  <div class="row">
    @if($medico->stateConfirm == 'complete')
    <div class="col-lg-6 col-12 mt-2">
      <a href="{{route('medico.edit',$medico->id)}}" class="btn btn-primary btn-block">Cancelar</a>
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
        <input type="text" name="" class="form-control" value="" id="input">
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


<script type="text/javascript">

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
