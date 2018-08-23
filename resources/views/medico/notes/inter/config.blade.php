@extends('layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
<style media="screen">
/* ///////////////////////// */
.input-text{
    height: 30px;
}

.area{
    height: 100px;
}
.form-control{
    pointer-events:none;
}
/* //APLICAR ESTO en form-control area element area element */
</style>
{{-- ///////////////////////////// --}}
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Configurar: "{{$note->title}}"</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header bg-warning text-white">
    <b>{{$note->title}}</b>
  </div>
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_config_store','method'=>'POST'])!!}
    {!!Form::hidden('note_id',$note->id)!!}
    {!!Form::hidden('title',$note->title)!!}
    {!!Form::hidden('medico_id',$medico->id)!!}
    {!!Form::hidden('patient_id',$patient->id)!!}
    {!!Form::hidden('date_edit',\Carbon\Carbon::now())!!}
    {!!Form::hidden('note_config_id',$note->id)!!}
    <div class="text-right">
      <label for="" class="font-title-blue mb-5">Fecha:</label>
      {!!Form::date('date_start',\Carbon\Carbon::now())!!}
    </div>

    <div class="form-group">
       @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
         <h5 class="font-title-blue float-left">Afección principal o motivo de consulta:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Afeccion_principal_o_motivo_de_consulta_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Afección principal o motivo de consulta:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Afeccion_principal_o_motivo_de_consulta_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
        {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control area element','id'=>'Afeccion_principal_o_motivo_de_consulta','style'=>''])}}
      @else
        {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
       @if($note->Afeccion_secundaria_show == 'si')
         <h5 class="font-title-blue float-left">Afeccion secundaria:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Afeccion_secundaria_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Afeccion secundaria:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Afeccion_secundaria_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Afeccion_secundaria_show == 'si')
        {{Form::textarea('Afeccion_secundaria',null,['class'=>'form-control area element','id'=>'Afeccion_secundaria','style'=>''])}}
      @else
        {{Form::textarea('Afeccion_secundaria',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>



    <div class="form-group">
       @if($note->Pronostico_show == 'si')
         <h5 class="font-title-blue float-left">Pronostico:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Pronostico_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Pronostico:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Pronostico_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Pronostico_show == 'si')
        {{Form::textarea('Pronostico',null,['class'=>'form-control area element','id'=>'Pronostico','style'=>''])}}
      @else
        {{Form::textarea('Pronostico',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
        @if($note->Pruebas_de_laboratorio_show == 'si')
          <h5 class="font-title-blue float-left">Pruebas de laboratorio:</h5>
         <label class="switch" style="display:block;margin-left:auto;">
            {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Pruebas_de_laboratorio_show'])}}
            <span class="slider round text-white"><span class="ml-1">on</span> of</span>
         </label>
       @else
         <h5 class="float-left font-title" style="color:grey">Pruebas de laboratorio</h5>
         <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Pruebas_de_laboratorio_show'])}}
            <span class="slider round text-white"><span class="ml-1">on</span> of</span>
         </label>
       @endif

       @if($note->Pruebas_de_laboratorio_show == 'si')
           <div class="element" id="div_test_labs">

           </div>
       @else

           <div class="element" id="div_test_labs" style="display:none">

           </div>
       @endif
    </div>


    <div class="form-group">
       @if($note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
         <h5 class="font-title-blue float-left">Evolucion y actualizacion del cuadro clinico:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Evolucion_y_actualizacion_del_cuadro_clinico_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Evolucion y actualizacion del cuadro clinico:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Evolucion_y_actualizacion_del_cuadro_clinico_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
        {{Form::textarea('Evolucion_y_actualizacion_del_cuadro_clinico',null,['class'=>'form-control area element','id'=>'Evolucion_y_actualizacion_del_cuadro_clinico','style'=>''])}}
      @else
        {{Form::textarea('Evolucion_y_actualizacion_del_cuadro_clinico',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
       @if($note->Sugerencias_y_tratamiento_show == 'si')
         <h5 class="font-title-blue float-left">Sugerencias y tratamiento:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Sugerencias_y_tratamiento_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Sugerencias y tratamiento:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Sugerencias_y_tratamiento_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Sugerencias_y_tratamiento_show == 'si')
        {{Form::textarea('Sugerencias_y_tratamiento',null,['class'=>'form-control area element','id'=>'Sugerencias_y_tratamiento','style'=>''])}}
      @else
        {{Form::textarea('Sugerencias_y_tratamiento',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    @if($expedient != Null)

      <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
        <input type="submit" class="btn btn-success line mx-1" name="boton_submit" value="Guardar Nota en Expediente">

    @else
      <input type="submit" class="btn btn-primary line mx-1" name="boton_submit" value="Guardar Nota">

    @endif



  {!!Form::close()!!}
  @if($expedient != Null)
    <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'ex_id'=>\Hashids::encode($expedient->id)])}}" class="btn btn-secondary line" >Cancelar</i></a>
  @else
    <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary mx-1 line">Cancelar</a>
  @endif
  </div>
  </div>

  @include('medico.notes.include_vital_labs.modal_vital_signs')
  @include('medico.notes.include_vital_labs.modal_test_labs')
  {{-- //////////////// --}}
  @endsection

  @section('scriptJS')
  {{-- <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> --}}
  <script type="text/javascript">

          $(document).ready(function(){
          vital_signs();
          ajax_test_labs();
          });
        function toogle(result){
          label = result.parentNode;
          div = label;
          note_id = "{{$note->id}}";
          variable = result.id;

          route = "{{route('check_input_notes')}}";
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: route,
            data:{variable:variable,note_id:note_id},

            success:function(result){
              console.log(result);

              if(result.result == 'si'){
                $(div).next('.element').show();
                $(div).prev().css('color','#007bff');

              }else{


                $(div).next('.element').hide();
                $(div).prev().css('color','grey');
              }
              // $(result).next('.form-control area element').css({"height":"1px"}).attr("disabled","true");
            },
            error:function(error){
             console.log(error);
           },
        });

        }

        function vital_signs(){
            note_id = "{{$note->id}}";

            route = "{{route('ajax_vital_sign_config')}}";
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              url: route,
              data:{note_id:note_id},

              success:function(result){
                console.log(result);
                $('#div_vital_signs').html(result);
            },
            error:function(error){
             console.log(error);
             $('#vital_sign_div').html('Hubo un error al cargar este elemento, por favor recargue la pagina, si no funciona revise el estado de su internet.');
           },
        });
        }

        ////AJAX_TEST_LABS
        function ajax_test_labs(){
            note_id = "{{$note->id}}";

            route = "{{route('ajax_test_labs')}}";
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              url: route,
              data:{note_id:note_id},

              success:function(result){
                console.log(result);
                $('#div_test_labs').html(result);
            },
            error:function(error){
             console.log(error);
             $('#div_test_labs').html('Hubo un error al cargar este elemento, por favor recargue la pagina, si no funciona revise el estado de su internet.');
           },
        });
        }


        $('#test_labs_config').submit(function(){

            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              success:function(result){
                console.log(result);
                ajax_test_labs();
                $('#modal_test_labs').modal('hide');
            },
            error:function(error){
             console.log(error);
             $('modal_test_labs').modal('hide');
           },
        });
        return false;

         });




       $('#vital_sign_config_update').submit(function(){

           $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type: 'POST',
             url: $(this).attr('action'),
             data: $(this).serialize(),
             success:function(result){
               console.log(result);
               vital_signs();
               $('#modal_vital_signs').modal('hide');
           },
           error:function(error){
            console.log(error);
            $('#modal_vital_signs').modal('hide');
          },
       });
       return false;

        });

        function show_modal(){
             $('#modal_test_labs').modal('show');
        }

        function show_modal_vital(){
            // alert('vvv');
             $('#modal_vital_signs').modal('show');
        }

  </script>

  @endsection
