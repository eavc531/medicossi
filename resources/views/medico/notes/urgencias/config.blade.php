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
    <h2 class="text-center font-title">Configurar: "{{$note->title}}</h2>

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
        @if($note->Signos_vitales_show == 'si')
          <h5 class="font-title-blue float-left">Signos vitales:</h5>
         <label class="switch" style="display:block;margin-left:auto;">
            {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Signos_vitales_show'])}}
            <span class="slider round text-white"><span class="ml-1">on</span> of</span>
         </label>
       @else
         <h5 class="float-left font-title" style="color:grey">Signos vitales:</h5>
         <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Signos_vitales_show'])}}
            <span class="slider round text-white"><span class="ml-1">on</span> of</span>
         </label>
       @endif

       @if($note->Signos_vitales_show == 'si')

           <div class="element" id="div_vital_signs">

           </div>
       @else
           <div class="element" id="div_vital_signs" style="display:none">

           </div>
       @endif
    </div>

    <div class="form-group">
       @if($note->Motivo_de_atencion_show == 'si')
         <h5 class="font-title-blue float-left">Motivo de atencion:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Motivo_de_atencion_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Motivo de atencion:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Motivo_de_atencion_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Motivo_de_atencion_show == 'si')
        {{Form::textarea('Motivo_de_atencion',null,['class'=>'form-control area element','id'=>'Motivo_de_atencion','style'=>''])}}
      @else
        {{Form::textarea('Motivo_de_atencion',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
       @if($note->Exploracion_fisica_show == 'si')
         <h5 class="font-title-blue float-left">Exploracion fisica:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Exploracion_fisica_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Exploracion fisica:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Exploracion_fisica_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Exploracion_fisica_show == 'si')
        {{Form::textarea('Exploracion_fisica',null,['class'=>'form-control area element','id'=>'Exploracion_fisica','style'=>''])}}
      @else
        {{Form::textarea('Exploracion_fisica',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
       @if($note->Estado_mental_show == 'si')
         <h5 class="font-title-blue float-left">Estado mental:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Estado_mental_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Estado mental:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Estado_mental_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Estado_mental_show == 'si')
        {{Form::textarea('Estado_mental',null,['class'=>'form-control area element','id'=>'Estado_mental','style'=>''])}}
      @else
        {{Form::textarea('Estado_mental',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
       @if($note->Resultados_relevantes_show == 'si')
         <h5 class="font-title-blue float-left">Resultados relevantes de los servicios auxiliares de diagnostico:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
           {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Resultados_relevantes_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @else
        <h5 class="float-left font-title" style="color:grey">Resultados relevantes de los servicios auxiliares de diagnostico:</h5>
        <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Resultados_relevantes_show'])}}
           <span class="slider round text-white"><span class="ml-1">on</span> of</span>
        </label>
      @endif

      @if($note->Resultados_relevantes_show == 'si')
        {{Form::textarea('Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico',null,['class'=>'form-control area element','id'=>'Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico','style'=>''])}}
      @else
        {{Form::textarea('Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico',null,['class'=>'form-control area element','id'=>'Exploracion Fisica','style'=>'display:none'])}}
      @endif
    </div>

    <div class="form-group">
      @if($note->Diagnostico_show == 'si')
        <h5 class="font-title-blue float-left">Diagnostico:</h5>
       <label class="switch" style="display:block;margin-left:auto;">
          {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Diagnostico_show'])}}
          <span class="slider round text-white"><span class="ml-1">on</span> of</span>
       </label>
     @else
       <h5 class="float-left font-title" style="color:grey">Diagnostico</h5>
       <label class="switch" style="display:block;margin-left:auto;">
         {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Diagnostico_show'])}}
          <span class="slider round text-white"><span class="ml-1">on</span> of</span>
       </label>
     @endif

     @if($note->Diagnostico_show == 'si')
       {{Form::textarea('Diagnostico',null,['class'=>'form-control area element',"id"=>"Diagnostico"])}}
     @else
       {{Form::textarea('Diagnostico',null,['class'=>'form-control area element',"id"=>"Diagnostico",'style'=>'display:none'])}}
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
       {{Form::textarea('Pronostico',null,['class'=>'form-control area element',"id"=>"Pronostico"])}}
     @else
       {{Form::textarea('Pronostico',null,['class'=>'form-control area element',"id"=>"Pronostico",'style'=>'display:none'])}}
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
    <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary mx-1 line">Cancelar</a>
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
             $('#vital_sign_div').html('Hubo un error al cargar este elemento, por favor recargue la pagina, si no funciona revise el estado de su internet.');
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
