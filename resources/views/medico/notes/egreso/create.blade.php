@extends('layouts.app')
@section('css')
  <style media="screen">
  .input-control{
    height: 100px;
  }

  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 55px;
    height: 24px;
  }

  /* Hide default HTML checkbox */
  .switch input {display:none;}

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

  </style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Crear Nota: "{{$note->title}}" para el Paciente: {{$patient->name}} {{$patient->lastName}}</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header card-edit">
  <b>{{$note->title}}</b>
</div>
  {{-- <h5 class="font-title-blue">Fecha de elaboracion::</h5>
  {{Form::date('fecha_ingreso',\Carbon\Carbon::now(),['class'=>'form-control input-control','id'=>'signos_vitales'])}}
  </div> --}}
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!}
      {!!Form::hidden('note_id',$note->id)!!}
      {!!Form::hidden('title',$note->title)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
        {!!Form::hidden('patient_id',$patient->id)!!}

        <div class="row mb-3">
          <div class="col-lg-6 col-sm-6 col-12">
            <h5 class="font-title-blue">Fecha de ingreso:</h5>
            {{Form::date('fecha_ingreso',null,['class'=>'form-control','id'=>'Motivo_del_egreso'])}}
          </div>
          <div class="col-lg-6 col-sm-6 col-12">
            <h5 class="font-title-blue">Fecha de egreso:</h5>
            {{Form::date('fecha_egreso',null,['class'=>'form-control','id'=>'Motivo_del_egreso'])}}
          </div>
        </div>

        <div class="form-group">
          @if($note->Motivo_del_egreso_show == 'si')
            <h5 class="font-title-blue float-left">Motivo del egreso</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Motivo_del_egreso_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
         @else
           <h5 class="float-left font-title" style="color:grey">Motivo del egreso:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Motivo_del_egreso_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
         @endif

         @if($note->Motivo_del_egreso_show == 'si')
           {{Form::textarea('Motivo_del_egreso',null,['class'=>'form-control input-control','id'=>'Motivo_del_egreso','style'=>''])}}
         @else
           {{Form::textarea('Motivo_del_egreso',null,['class'=>'form-control input-control','id'=>'Motivo_del_egreso','style'=>'display:none'])}}
         @endif
        </div>
          <div class="form-group">
             @if($note->Diagnosticos_finales_show == 'si')
               <h5 class="font-title-blue float-left">Diagnosticos finales:</h5>
              <label class="switch" style="display:block;margin-left:auto;">
                 {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Diagnosticos_finales_show'])}}
                 <span class="slider round text-white"><span class="ml-1">on</span> of</span>
              </label>
            @else
              <h5 class="float-left font-title" style="color:grey">Diagnosticos finales:</h5>
              <label class="switch" style="display:block;margin-left:auto;">
                {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Diagnosticos_finales_show'])}}
                 <span class="slider round text-white"><span class="ml-1">on</span> of</span>
              </label>
            @endif

            @if($note->Diagnosticos_finales_show == 'si')
              {{Form::textarea('Diagnosticos_finales',null,['class'=>'form-control input-control','id'=>'Diagnosticos_finales','style'=>''])}}
            @else
              {{Form::textarea('Diagnosticos_finales',null,['class'=>'form-control input-control','id'=>'Diagnosticos_finales','style'=>'display:none'])}}
            @endif
          </div>


        <div class="form-group">
          @if($note->Resumen_de_evolucion_y_estado_actual_show == 'si')
            <h5 class="font-title-blue float-left">Resumen de evolucion y estado actual:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Resumen_de_evolucion_y_estado_actual_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @else
           <h5 class="float-left font-title" style="color:grey">Resumen de evolucion y estado actual:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Resumen_de_evolucion_y_estado_actual_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @endif

          @if($note->Resumen_de_evolucion_y_estado_actual_show == 'si')
           {{Form::textarea('Resumen_de_evolucion_y_estado_actual',null,['class'=>'form-control input-control','id'=>'Resumen_de_evolucion_y_estado_actual','style'=>''])}}
          @else
           {{Form::textarea('Resumen_de_evolucion_y_estado_actual',null,['class'=>'form-control input-control','id'=>'Resumen_de_evolucion_y_estado_actual','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">
          @if($note->Manejo_durante_la_estancia_hospitalaria_show == 'si')
            <h5 class="font-title-blue float-left">Manejo durante la estancia hospitalaria</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Manejo_durante_la_estancia_hospitalaria_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @else
           <h5 class="float-left font-title" style="color:grey">Manejo durante la estancia hospitalaria</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Manejo_durante_la_estancia_hospitalaria_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @endif

          @if($note->Manejo_durante_la_estancia_hospitalaria_show == 'si')
           {{Form::textarea('Manejo_durante_la_estancia_hospitalaria',null,['class'=>'form-control input-control','id'=>'Manejo_durante_la_estancia_hospitalaria','style'=>''])}}
          @else
           {{Form::textarea('Manejo_durante_la_estancia_hospitalaria',null,['class'=>'form-control input-control','id'=>'Manejo_durante_la_estancia_hospitalaria','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">

          @if($note->Problemas_clinicos_pendientes_show == 'si')
            <h5 class="font-title-blue float-left">Problemas clinicos pendientes:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Problemas_clinicos_pendientes_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @else
           <h5 class="float-left font-title" style="color:grey">Problemas clinicos pendientes:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Problemas_clinicos_pendientes_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @endif

          @if($note->Problemas_clinicos_pendientes_show == 'si')
           {{Form::textarea('Problemas_clinicos_pendientes',null,['class'=>'form-control input-control','id'=>'Problemas_clinicos_pendientes','style'=>''])}}
          @else
           {{Form::textarea('Problemas_clinicos_pendientes',null,['class'=>'form-control input-control','id'=>'Problemas_clinicos_pendientes','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">
          @if($note->Plan_de_manejo_y_tratamiento_show == 'si')
            <h5 class="font-title-blue float-left">Plan de manejo y tratamiento:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Plan_de_manejo_y_tratamiento_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @else
           <h5 class="float-left font-title" style="color:grey">Plan de manejo y tratamiento:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Plan_de_manejo_y_tratamiento_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @endif

          @if($note->Plan_de_manejo_y_tratamiento_show == 'si')
           {{Form::textarea('Plan_de_manejo_y_tratamiento',null,['class'=>'form-control input-control','id'=>'Plan_de_manejo_y_tratamiento','style'=>''])}}
          @else
           {{Form::textarea('Plan_de_manejo_y_tratamiento',null,['class'=>'form-control input-control','id'=>'Plan_de_manejo_y_tratamiento','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">

          @if($note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si')
            <h5 class="font-title-blue float-left">Recomendaciones para vigilancia ambulatoira:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Recomendaciones_para_vigilancia_ambulatoira_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @else
           <h5 class="float-left font-title" style="color:grey">Recomendaciones para vigilancia ambulatoira:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Recomendaciones_para_vigilancia_ambulatoira_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @endif

          @if($note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si')
           {{Form::textarea('Recomendaciones_para_vigilancia_ambulatoira',null,['class'=>'form-control input-control','id'=>'Recomendaciones_para_vigilancia_ambulatoira','style'=>''])}}
          @else
           {{Form::textarea('Recomendaciones_para_vigilancia_ambulatoira',null,['class'=>'form-control input-control','id'=>'Recomendaciones_para_vigilancia_ambulatoira','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">

          @if($note->Otros_datos_show == 'si')
            <h5 class="font-title-blue float-left">Otros datos:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Otros_datos_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @else
           <h5 class="float-left font-title" style="color:grey">Otros datos:</h5>
           <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Otros_datos_show'])}}
              <span class="slider round text-white"><span class="ml-1">on</span> of</span>
           </label>
          @endif

          @if($note->Otros_datos_show == 'si')
           {{Form::textarea('Otros_datos',null,['class'=>'form-control input-control','id'=>'Otros_datos','style'=>''])}}
          @else
           {{Form::textarea('Otros_datos',null,['class'=>'form-control input-control','id'=>'Otros_datos','style'=>'display:none'])}}
          @endif
        </div>



    <input type="submit" class="btn btn-success" name="" value="Guardar">
      <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
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
