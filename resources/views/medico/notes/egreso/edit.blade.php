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
    </style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Editar Nota: "{{$note->title}}"</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header card-edit bg-success text-white">
  <b>{{$note->title}}</b>
</div>
  {{-- <h5 class="font-title-blue">Fecha de elaboracion::</h5>
  {{Form::date('fecha_ingreso',\Carbon\Carbon::now(),['class'=>'form-control area element input-control','id'=>'signos_vitales'])}}
  </div> --}}
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_update','method'=>'POST'])!!}
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

        <div class="row mb-3">
          <div class="col-lg-6 col-sm-6 col-12">
            <h5 class="font-title-blue">Fecha de ingreso:</h5>
            {{Form::date('fecha_ingreso',null,['class'=>'form-control element','id'=>'Motivo_del_egreso'])}}
          </div>
          <div class="col-lg-6 col-sm-6 col-12">
            <h5 class="font-title-blue">Fecha de egreso:</h5>
            {{Form::date('fecha_egreso',null,['class'=>'form-control element','id'=>'Motivo_del_egreso'])}}
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
           {{Form::textarea('Motivo_del_egreso',null,['class'=>'form-control area element input-control','id'=>'Motivo_del_egreso','style'=>''])}}
         @else
           {{Form::textarea('Motivo_del_egreso',null,['class'=>'form-control area element input-control','id'=>'Motivo_del_egreso','style'=>'display:none'])}}
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
              {{Form::textarea('Diagnosticos_finales',null,['class'=>'form-control area element input-control','id'=>'Diagnosticos_finales','style'=>''])}}
            @else
              {{Form::textarea('Diagnosticos_finales',null,['class'=>'form-control area element input-control','id'=>'Diagnosticos_finales','style'=>'display:none'])}}
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
           {{Form::textarea('Resumen_de_evolucion_y_estado_actual',null,['class'=>'form-control area element input-control','id'=>'Resumen_de_evolucion_y_estado_actual','style'=>''])}}
          @else
           {{Form::textarea('Resumen_de_evolucion_y_estado_actual',null,['class'=>'form-control area element input-control','id'=>'Resumen_de_evolucion_y_estado_actual','style'=>'display:none'])}}
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
           {{Form::textarea('Manejo_durante_la_estancia_hospitalaria',null,['class'=>'form-control area element input-control','id'=>'Manejo_durante_la_estancia_hospitalaria','style'=>''])}}
          @else
           {{Form::textarea('Manejo_durante_la_estancia_hospitalaria',null,['class'=>'form-control area element input-control','id'=>'Manejo_durante_la_estancia_hospitalaria','style'=>'display:none'])}}
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
           {{Form::textarea('Problemas_clinicos_pendientes',null,['class'=>'form-control area element input-control','id'=>'Problemas_clinicos_pendientes','style'=>''])}}
          @else
           {{Form::textarea('Problemas_clinicos_pendientes',null,['class'=>'form-control area element input-control','id'=>'Problemas_clinicos_pendientes','style'=>'display:none'])}}
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
           {{Form::textarea('Plan_de_manejo_y_tratamiento',null,['class'=>'form-control area element input-control','id'=>'Plan_de_manejo_y_tratamiento','style'=>''])}}
          @else
           {{Form::textarea('Plan_de_manejo_y_tratamiento',null,['class'=>'form-control area element input-control','id'=>'Plan_de_manejo_y_tratamiento','style'=>'display:none'])}}
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
           {{Form::textarea('Recomendaciones_para_vigilancia_ambulatoira',null,['class'=>'form-control area element input-control','id'=>'Recomendaciones_para_vigilancia_ambulatoira','style'=>''])}}
          @else
           {{Form::textarea('Recomendaciones_para_vigilancia_ambulatoira',null,['class'=>'form-control area element input-control','id'=>'Recomendaciones_para_vigilancia_ambulatoira','style'=>'display:none'])}}
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
           {{Form::textarea('Otros_datos',null,['class'=>'form-control area element input-control','id'=>'Otros_datos','style'=>''])}}
          @else
           {{Form::textarea('Otros_datos',null,['class'=>'form-control area element input-control','id'=>'Otros_datos','style'=>'display:none'])}}
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


@endsection

@section('scriptJS')
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
