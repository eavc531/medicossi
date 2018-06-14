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
    <h2 class="text-center font-title">Vista previa: "{{$note->title}}" para el Paciente: {{$patient->name}} {{$patient->lastName}}</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header">
  {{$note->title}}
  </div>
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!}
      {!!Form::hidden('note_id',$note->id)!!}
      {!!Form::hidden('title',$note->title)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
        {!!Form::hidden('patient_id',$patient->id)!!}
        <div class="form-group">
          <h5>Exploracion fisica</h5>
          <p>{{$note->Exploracion_fisica}}</p>
          
        </div>
        <div class="form-group">
          <h5>Signos vitales</h5>
          {{Form::textarea('Signos_vitales',null,['class'=>'form-control','id'=>'signos_vitales'])}}
        </div><div class="form-group">
          <h5>Pruebas de laboratorio</h5>
          {{Form::textarea('Pruebas_de_laboratorio',null,['class'=>'form-control','id'=>'pruebas_labs'])}}
        </div><div class="form-group">
          <h5>Diagnostico</h5>
          {{Form::textarea('Diagnostico',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div><div class="form-group">
          <h5>Afección principal o motivo de consulta</h5>
          {{Form::textarea('Afeccion_principal_o_motivo_de_consulta',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>
        <div class="form-group">
          <h5>Afeccion secundaria</h5>
          {{Form::textarea('Afeccion_secundaria',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>
        <div class="form-group">
          <h5>Pronostico</h5>
          {{Form::textarea('Pronostico',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>
        <div class="form-group">
          <h5>Tratamiento y o receta</h5>
          {{Form::textarea('Tratamiento_y_o_recetas',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>
        <div class="form-group">
          <h5>Indicaciones terapeuticas</h5>
          {{Form::textarea('Indicaciones_terapeuticas',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>

    <input type="submit" name="" value="Guardar">
    <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
    {!!Form::close()!!}
      {!!Form::close()!!}




  </div>
</div>



@endsection

@section('scriptJS')
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script type="text/javascript">

        $(document).ready(function(){

          CKEDITOR.replace('Signos_vitales');
          CKEDITOR.replace('Pruebas_de_laboratorio');
        });


  </script>

@endsection
