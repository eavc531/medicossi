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
      <h2 class="text-center font-title">Editar datos de Consultorio</h2>
    </div>
  </div>
  {!!Form::model($consulting_room,['route'=>['consulting_room_update',\Hashids::encode($consulting_room)],'method'=>'update'])!!}

  <div class="col-12">
    <div class="row" id="comb">
      <div class="col-lg-6 col-12">
        <div class="form-group">
          @if($consulting_room->type != 'Medicina General o Familiar' and $consulting_room->type != 'Consultorio de Especialidades' and $consulting_room->type != 'Consultorio Odontologia' and $consulting_room->type != Null)
            <label for="">Tipo de Consultorio (Opcional)</label>
            {{Form::select('type',['Medicina General o Familiar'=>'Medicina General o Familiar','Consultorio de Especialidades'=>'Consultorio de Especialidades','Consultorio Odontologia'=>'Consultorio Odontologia','Otro Especifique:'=>'Otro Especifique:'],'Otro Especifique:',['class'=>'form-control','id'=>'type2','placeholder'=>'Opciones'])}}

          @else
            <label for="">Tipo de Consultorio (Opcional)</label>
            {{Form::select('type',['Medicina General o Familiar'=>'Medicina General o Familiar','Consultorio de Especialidades'=>'Consultorio de Especialidades','Consultorio Odontologia'=>'Consultorio Odontologia','Otro Especifique:'=>'Otro Especifique:'],null,['class'=>'form-control','id'=>'type2','placeholder'=>'Opciones'])}}

          @endif
            </div>
      </div>

      @if($consulting_room->type == Null)

        <div class="col-lg-6 col-12" id="otro2" style="Display:none">
          <label for="">especifique el Tipo de Consultorio</label>
          {{Form::text('otro',null,['class'=>'form-control','id'=>'','placeholder'=>'escriba el tipo de consultorio'])}}
        </div>
      @elseif($consulting_room->type != 'Medicina General o Familiar' and $consulting_room->type != 'Consultorio de Especialidades' and $consulting_room->type != 'Consultorio Odontologia' and $consulting_room->type != Null)

        <div class="col-lg-6 col-12" id="otro2">
          <label for="">Escriba el Tipo de Consultorio</label>
          {{Form::text('otro',$consulting_room->type,['class'=>'form-control','id'=>'','placeholder'=>'escriba el tipo de consultorio'])}}
        </div>
      @elseif($consulting_room->type == 'Medicina General o Familiar' or $consulting_room->type == 'Consultorio de Especialidades' or $consulting_room->type == 'Consultorio Odontologia')
        <div class="col-lg-6 col-12" id="otro2" style="Display:none">
          <label for="">Escriba el Tipo de Consultorio</label>
          {{Form::text('otro',null,['class'=>'form-control','id'=>'','placeholder'=>'escriba el tipo de consultorio'])}}
        </div>
      @endif

    </div>
    <div class="row mt-3">
      {{-- <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="">Pais</label>
          {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
        </div>
      </div> --}}
      <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="">Estado</label>
          {{Form::select('state',$states,$consulting_room->state,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
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
          <label for="">Clave Unica (Opcional)</label>
          {{Form::text('passwordUnique',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}

       </div>
     </div>
     <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="">Numero Externo (opcional)</label>
        {{Form::text('numberExt',null,['class'=>'form-control','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="">Numero Interno (opcional)</label>
        {{Form::text('numberInt',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="form-group">
        <label for="">Nombre Comercial del Consultorio</label>
        {{Form::text('name',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
      </div>
    </div>
    <div class="col-lg-6 col-12">  <div class="form-group">
        <label for="">Codigo Postal (opcional)</label>
        {{Form::text('postal_code',null,['class'=>'form-control','style'=>'border-color:black'])}}
      </div>

    </div>

    </div>

  <div class="row">

    <div class="col-lg-6 col-12 mt-2">
      <a href="{{route('medico.edit',\Hashids::encode($medico->id))}}" class="btn btn-primary btn-block">Cancelar</a>
    </div>

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
