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
      <h2 class="text-center font-title">Editar Dirección de Trabajo Principal: {{$medico->name}} {{$medico->lastName}}</h2>
    </div>
  </div>
  {!!Form::model($medico,['route'=>['medico_update_address',\Hashids::encode($medico->id)],'method'=>'update'])!!}

  <div class="col-12">
    <div class="row" id="comb">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          @if($medico->type_consulting_room != 'Medicina General o Familiar' and $medico->type_consulting_room != 'Consultorio de Especialidades' and $medico->type_consulting_room != 'Consultorio Odontologia' and $medico->type_consulting_room != Null)

            <label for="" class="font-title">Tipo de Consultorio</label>
            {{Form::select('type_consulting_room',['Medicina General o Familiar'=>'Medicina General o Familiar','Consultorio de Especialidades'=>'Consultorio de Especialidades','Consultorio Odontologia'=>'Consultorio Odontologia','Otro Especifique:'=>'Otro Especifique:'],'Otro Especifique:',['class'=>'form-control','id'=>'type2','placeholder'=>'Opciones'])}}

          @else
            <label for="" class="font-title">Tipo de Consultorio</label>
            {{Form::select('type_consulting_room',['Medicina General o Familiar'=>'Medicina General o Familiar','Consultorio de Especialidades'=>'Consultorio de Especialidades','Consultorio Odontologia'=>'Consultorio Odontologia','Otro Especifique:'=>'Otro Especifique:'],null,['class'=>'form-control','id'=>'type2','placeholder'=>'Opciones'])}}

          @endif
        </div>
      </div>
      @if($medico->type_consulting_room == Null)
        <div class="col-lg-6 col-12" id="otro2" style="Display:none">
          <label for="" class="font-title">especifique el Tipo de Consultorio</label>
          {{Form::text('otro',null,['class'=>'form-control','id'=>'','placeholder'=>'escriba el tipo de consultorio'])}}
        </div>
      @elseif($medico->type_consulting_room != 'Medicina General o Familiar' and $medico->type_consulting_room != 'Consultorio de Especialidades' and $medico->type_consulting_room != 'Consultorio Odontologia' and $medico->type_consulting_room != Null)
        <div class="col-lg-6 col-12" id="otro2">
          <label for="" class="font-title">Escriba el Tipo de Consultorio</label>
          {{Form::text('otro',$medico->type_consulting_room,['class'=>'form-control','id'=>'','placeholder'=>'escriba el tipo de consultorio'])}}
        </div>
      @elseif($medico->type_consulting_room == 'Medicina General o Familiar' or $medico->type_consulting_room == 'Consultorio de Especialidades' or $medico->type_consulting_room == 'Consultorio Odontologia' or $medico->type_consulting_room)
        <div class="col-lg-6 col-12" id="otro2" style="Display:none">
          <label for="" class="font-title">Escriba el Tipo de Consultorio</label>
          {{Form::text('otro',null,['class'=>'form-control','id'=>'','placeholder'=>'escriba el tipo de consultorio'])}}
        </div>
      @endif
    </div>
    <div class="row mt-3">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" class="font-title">Pais</label>
          {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="form-group">
            <label for="" class="font-title">Codigo Postal</label>
            {{Form::number('postal_code',null,['class'=>'form-control'])}}
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
    </div>
    <div class= "row mt-2">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" class="font-title">Colonia</label>
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
        <label for="" class="font-title">Numero Externo (opcional)</label>
        {{Form::text('number_ext',null,['class'=>'form-control','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Numero Interno (opcional)</label>
        {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Nombre Comercial del Consultorio</label>
        {{Form::text('name_comercial',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Clave Unica (Opcional)</label>
        {{Form::text('password_unique',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
      </div>
    </div>



  </div>
  <div class="row">
    @if($medico->stateConfirm == 'complete')
    <div class="col-lg-6 col-12 mt-2">
      <a href="{{route('medico.edit',\Hashids::encode($medico->id))}}" class="btn btn-primary btn-block">Cancelar</a>
    </div>
    @endif
    <div class="col-lg-6 col-12 mt-2">
      <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
    </div>
  </div>
</div>
{!!Form::close()!!}

</section>
@endsection

@section('scriptJS')


<script type="text/javascript">

/////////////////////////////
$(document).ready(function(){

  if($('#type2').val() == 'Otro Especifique:'){
    $('#comb').css('background','rgb(250, 251, 172)');
  }

  $('#type2').on('change', function(){
    valor = $('#type2').val();

    if(valor == 'Otro Especifique:'){
      $('#otro2').show();
    $('#comb').css('background','rgb(250, 251, 172)');

    }else{
      $('#otro2').hide();
      $('#comb').css('background','white');
    }

  });

  $('#state').on('change', function(){
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
  });
});



</script>
@endsection
