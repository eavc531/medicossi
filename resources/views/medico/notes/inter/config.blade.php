@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/switch.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Configurar Nota: "{{$note->title}}" </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}
<div class="text-right">
  <a class="btn btn-secondary my-2" href="{{route('type_notes',['m_id'=>$medico->id,'p_id'=>$patient->id,])}}">Atras</a>
</div>
<p style="color:rgb(156, 156, 156)">Puedes Configurar el campo "Pruebas de laboratorio" para que almacenen de forma predefinida, el texto o preguntas que uses frecuentemente en este tipo de notas, solo tienes que editar su contenido en esta pantalla, y presionar el boton guardar.</p>
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
          {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control','id'=>'Afeccion_principal_o_motivo_de_consulta','style'=>''])}}
        @else
          {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
          {{Form::textarea('Afeccion_secundaria',null,['class'=>'form-control','id'=>'Afeccion_secundaria','style'=>''])}}
        @else
          {{Form::textarea('Afeccion_secundaria',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
          {{Form::textarea('Pronostico',null,['class'=>'form-control','id'=>'Pronostico','style'=>''])}}
        @else
          {{Form::textarea('Pronostico',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
          <h5 class="float-left font-title" style="color:grey">Pruebas de laboratorio:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
            {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Pruebas_de_laboratorio_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @endif

        @if($note->Pruebas_de_laboratorio_show == 'si')
          {{Form::textarea('Pruebas_de_laboratorio',null,['class'=>'form-control','id'=>'Pruebas_de_laboratorio','style'=>''])}}
        @else
          {{Form::textarea('Pruebas_de_laboratorio',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
          {{Form::textarea('Evolucion_y_actualizacion_del_cuadro_clinico',null,['class'=>'form-control','id'=>'Evolucion_y_actualizacion_del_cuadro_clinico','style'=>''])}}
        @else
          {{Form::textarea('Evolucion_y_actualizacion_del_cuadro_clinico',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
          {{Form::textarea('Sugerencias_y_tratamiento',null,['class'=>'form-control','id'=>'Sugerencias_y_tratamiento','style'=>''])}}
        @else
          {{Form::textarea('Sugerencias_y_tratamiento',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
        @endif
      </div>

  <input type="submit" class="btn btn-success" name="" value="Guardar">
  <a href="{{route('type_notes',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
    {!!Form::close()!!}

</div>
</div>

@endsection

@section('scriptJS')
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script type="text/javascript">

      $(document).ready(function(){
        if($("#Signos_vitales").is(":visible")){
            CKEDITOR.replace('Signos_vitales');
        }

        if($("#Pruebas_de_laboratorio").is(":visible")){
          CKEDITOR.replace('Pruebas_de_laboratorio');
        }

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
            // alert(result.variable);
            // CKEDITOR.instances['Signos_vitales'].setReadOnly(true);

            if(result.result == 'si'){
              $(div).next('.form-control').show();
              $(div).prev().css('color','#007bff');
              if(result.variable == 'Signos_vitales_show'){
                CKEDITOR.replace('Signos_vitales');
              }
              if(result.variable == 'Pruebas_de_laboratorio_show'){
                CKEDITOR.replace('Pruebas_de_laboratorio');
              }

            }else{
              if(result.variable == 'Pruebas_de_laboratorio_show'){
                if(CKEDITOR.instances.Pruebas_de_laboratorio){
                  CKEDITOR.instances.Pruebas_de_laboratorio.destroy(true);
                }
              }

              if(result.variable == 'Signos_vitales_show'){
                if(CKEDITOR.instances.Signos_vitales){
                  CKEDITOR.instances.Signos_vitales.destroy(true);
                }
              }

              $(div).next('.form-control').hide();
              $(div).prev().css('color','grey');
            }
            // $(result).next('.form-control').css({"height":"1px"}).attr("disabled","true");
          },
          error:function(error){
           console.log(error);
         },
      });
      }

</script>

@endsection
