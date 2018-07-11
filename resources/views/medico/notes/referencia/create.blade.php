@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
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
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!}
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
           @if($note->Motivo_de_envio_show == 'si')
             <h5 class="font-title-blue float-left">Motivo de envio:</h5>
            <label class="switch" style="display:block;margin-left:auto;">
               {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Motivo_de_envio_show'])}}
               <span class="slider round text-white"><span class="ml-1">on</span> of</span>
            </label>
          @else
            <h5 class="float-left font-title" style="color:grey">Motivo de envio:</h5>
            <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Motivo_de_envio_show'])}}
               <span class="slider round text-white"><span class="ml-1">on</span> of</span>
            </label>
          @endif

          @if($note->Motivo_de_envio_show == 'si')
            {{Form::textarea('Motivo_de_envio',null,['class'=>'form-control','id'=>'Motivo_de_envio','style'=>''])}}
          @else
            {{Form::textarea('Motivo_de_envio',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">
           @if($note->Establecimiento_que_envia_show == 'si')
             <h5 class="font-title-blue float-left">Establecimiento que envia:</h5>
            <label class="switch" style="display:block;margin-left:auto;">
               {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Establecimiento_que_envia_show'])}}
               <span class="slider round text-white"><span class="ml-1">on</span> of</span>
            </label>
          @else
            <h5 class="float-left font-title" style="color:grey">Establecimiento que envia:</h5>
            <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Establecimiento_que_envia_show'])}}
               <span class="slider round text-white"><span class="ml-1">on</span> of</span>
            </label>
          @endif

          @if($note->Establecimiento_que_envia_show == 'si')
            {{Form::textarea('Establecimiento_que_envia',null,['class'=>'form-control','id'=>'Establecimiento_que_envia','style'=>''])}}
          @else
            {{Form::textarea('Establecimiento_que_envia',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
          @endif
        </div>

        <div class="form-group">
           @if($note->Establecimiento_receptor_show == 'si')
             <h5 class="font-title-blue float-left">Establecimiento receptor:</h5>
            <label class="switch" style="display:block;margin-left:auto;">
               {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Establecimiento_receptor_show'])}}
               <span class="slider round text-white"><span class="ml-1">on</span> of</span>
            </label>
          @else
            <h5 class="float-left font-title" style="color:grey">Establecimiento receptor:</h5>
            <label class="switch" style="display:block;margin-left:auto;">
              {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Establecimiento_receptor_show'])}}
               <span class="slider round text-white"><span class="ml-1">on</span> of</span>
            </label>
          @endif

          @if($note->Establecimiento_receptor_show == 'si')
            {{Form::textarea('Establecimiento_receptor',null,['class'=>'form-control','id'=>'Establecimiento_receptor','style'=>''])}}
          @else
            {{Form::textarea('Establecimiento_receptor',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
           {{Form::textarea('Diagnostico',null,['class'=>'form-control',"id"=>"Diagnostico"])}}
         @else
           {{Form::textarea('Diagnostico',null,['class'=>'form-control',"id"=>"Diagnostico",'style'=>'display:none'])}}
         @endif
        </div>

        @if($expedient != Null)

          <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
            <input type="submit" class="btn btn-success line mx-1" name="boton_submit" value="Guardar Nota en Expediente">
        @endif
        <input type="submit" class="btn btn-primary line mx-1" name="boton_submit" value="Guardar Nota">



      {!!Form::close()!!}
      @if($expedient != Null)
        <a href="{{route('expedient_open',['m_id'=>$medico->id,'p_id'=>$patient->id,'ex_id'=>$expedient->id])}}" class="btn btn-secondary line" >Cancelar</i></a>
      @else
        <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary mx-1 line">Cancelar</a>
      @endif
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
