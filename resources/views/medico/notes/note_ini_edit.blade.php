@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Editar Nota: "{{$note->title}} {{\Carbon\Carbon::parse($note->date_start)->format('m-d-Y')}}"</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header bg-success text-white">
   <b> {{$note->title}}</b>
 </div>
 <div class="card-body">
  {!!Form::model($note,['route'=>['note_update',$note],'method'=>'POST'])!!}
  {!!Form::hidden('note_id',$note->id)!!}
  {!!Form::hidden('title',$note->title)!!}
  {!!Form::hidden('medico_id',$medico->id)!!}
  {!!Form::hidden('date_edit',null)!!}
  <div class="text-right">

    <label for="" class="font-title-blue mb-5">Fecha:</label>
    {!!Form::date('date_start',\Carbon\Carbon::parse($note->date_start),['readOnly','style'=>'background:rgb(231, 231, 231)'])!!}
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
      {{Form::textarea('Exploracion_fisica',null,['class'=>'form-control','id'=>'Exploracion_fisica','style'=>''])}}
    @else
      {{Form::textarea('Exploracion_fisica',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
    @endif
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
     {{Form::textarea('Signos_vitales',null,['class'=>'form-control',"id"=>"Signos_vitales"])}}
   @else
     {{Form::textarea('Signos_vitales',null,['class'=>'form-control',"id"=>"Signos_vitales",'style'=>'display:none'])}}
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

     {{Form::textarea('Pruebas_de_laboratorio',null,['class'=>'form-control',"id"=>"Pruebas_de_laboratorio"])}}
   @else

     {{Form::textarea('Pruebas_de_laboratorio',null,['class'=>'form-control',"id"=>"Pruebas_de_laboratorio",'style'=>'display:none'])}}
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
  <div class="form-group">
    @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
      <h5 class="font-title-blue float-left">Afeccion principal o motivo de consulta:</h5>
     <label class="switch" style="display:block;margin-left:auto;">
        {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Afeccion_principal_o_motivo_de_consulta_show'])}}
        <span class="slider round text-white"><span class="ml-1">on</span> of</span>
     </label>
   @else
     <h5 class="float-left font-title" style="color:grey">Afeccion principal o motivo de consulta:</h5>
     <label class="switch" style="display:block;margin-left:auto;">
       {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Afeccion_principal_o_motivo_de_consulta_show'])}}
        <span class="slider round text-white"><span class="ml-1">on</span> of</span>
     </label>
   @endif

   @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
     {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control',"id"=>"Afeccion_principal_o_motivo_de_consulta"])}}
   @else
     {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control',"id"=>"Afeccion_principal_o_motivo_de_consulta",'style'=>'display:none'])}}
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
     {{Form::textarea('Afeccion_secundaria',null,['class'=>'form-control',"id"=>"Afeccion_secundaria"])}}
   @else
     {{Form::textarea('Afeccion_secundaria','este',['class'=>'form-control',"id"=>"Afeccion_secundaria",'style'=>'display:none'])}}
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
     {{Form::textarea('Pronostico',null,['class'=>'form-control',"id"=>"Pronostico"])}}
   @else
     {{Form::textarea('Pronostico','nullsd',['class'=>'form-control',"id"=>"Pronostico",'style'=>'display:none'])}}
   @endif
  </div>

  <div class="form-group">

    @if($note->Tratamiento_y_o_receta_show == 'si')
      <h5 class="font-title-blue float-left">Tratamiento y o receta:</h5>
     <label class="switch" style="display:block;margin-left:auto;">
        {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Tratamiento_y_o_recetas_show'])}}
        <span class="slider round text-white"><span class="ml-1">on</span> of</span>
     </label>
   @else
     <h5 class="float-left font-title" style="color:grey">Tratamiento y o receta:</h5>
     <label class="switch" style="display:block;margin-left:auto;">
       {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Tratamiento_y_o_recetas_show'])}}
        <span class="slider round text-white"><span class="ml-1">on</span> of</span>
     </label>
   @endif

   @if($note->Pronostico_show == 'si')
     {{Form::textarea('Tratamiento_y_o_recetas',null,['class'=>'form-control',"id"=>"Tratamiento_y_o_recetas"])}}
   @else
     {{Form::textarea('Tratamiento_y_o_recetas',null,['class'=>'form-control',"id"=>"Tratamiento_y_o_recetas",'style'=>'display:none'])}}
   @endif

  </div>
  <div class="form-group">
    @if($note->Indicaciones_terapeuticas_show == 'si')
      <h5 class="font-title-blue float-left">Indicaciones terapeuticas:</h5>
     <label class="switch" style="display:block;margin-left:auto;">
        {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Indicaciones_terapeuticas_show'])}}
        <span class="slider round text-white"><span class="ml-1">on</span> of</span>
     </label>
   @else
     <h5 class="float-left font-title" style="color:grey">Indicaciones terapeuticas:</h5>
     <label class="switch" style="display:block;margin-left:auto;">
       {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Indicaciones_terapeuticas_show'])}}
        <span class="slider round text-white"><span class="ml-1">on</span> of</span>
     </label>
   @endif

   @if($note->Indicaciones_terapeuticas_show == 'si')
     {{Form::textarea('Indicaciones_terapeuticas',null,['class'=>'form-control',"id"=>"Indicaciones_terapeuticas"])}}
   @else
     {{Form::textarea('Indicaciones_terapeuticas',null,['class'=>'form-control',"id"=>"Indicaciones_terapeuticas",'style'=>'display:none'])}}
   @endif
  </div>

  @if($expedient != Null)

    <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
      <input type="submit" class="btn btn-success line mx-1" name="boton_submit" value="Guardar">
  @else

      <input type="submit" class="btn btn-success line mx-1" name="boton_submit" value="guardar">

  @endif
<input type="hidden" name="patient_id" value="{{$patient->id}}">
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
