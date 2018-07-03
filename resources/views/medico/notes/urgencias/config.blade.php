@extends('layouts.app')
@section('css')
  <style media="screen">
    .form-control{
      height: 100px;
    }
  </style>
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
<p style="color:rgb(156, 156, 156)">Puedes Configurar el campo "Signos vitales" para que almacenen de forma predefinida, el texto o preguntas que uses frecuentemente en este tipo de notas, solo tienes que editar su contenido en esta pantalla, y presionar el boton guardar.</p>
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
        <h5 class="font-title-blue">Signos vitales:</h5>
        {{Form::textarea('Signos_vitales',null,['class'=>'form-control','id'=>'signos_vitales'])}}
      </div>
      <div class="form-group">
        <h5 class="font-title-blue">Motivo_de_atencion:</h5>
        {{Form::textarea('Motivo_de_atencion',null,['class'=>'form-control','id'=>'pruebas_labs','disabled'])}}
      </div>

      <div class="form-group">
        <h5 class="font-title-blue">Exploracion fisica:</h5>
        {{Form::textarea('Exploracion_fisica',null,['class'=>'form-control','id'=>'pruebas_labs','disabled'])}}
      </div>

      <div class="form-group">
        <h5 class="font-title-blue">Estado mental:</h5>
        {{Form::textarea('Estado_mental',null,['class'=>'form-control','id'=>'Exploracion Fisica','disabled'])}}
      </div>


      <div class="form-group">
        <h5 class="font-title-blue">Resultados relevantes de los servicios auxiliares de diagnostico:</h5>
        {{Form::textarea('Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico',null,['class'=>'form-control','id'=>'Exploracion Fisica','disabled'])}}
      </div>

      <div class="form-group">
        <h5 class="font-title-blue">Diagnostico:</h5>
        {{Form::textarea('Diagnostico',null,['class'=>'form-control','id'=>'Exploracion Fisica','disabled'])}}
      </div>

      <div class="form-group">
        <h5 class="font-title-blue">Pronostico:</h5>
        {{Form::textarea('Pronostico',null,['class'=>'form-control','id'=>'Exploracion Fisica','disabled'])}}
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

        CKEDITOR.replace('Signos_vitales');
        // CKEDITOR.replace('Pruebas_de_laboratorio');
      });


</script>

@endsection
