@extends('layouts.app')
@section('css')
<style media="screen">
.form-control{
  height: 100px;
}

</style>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 mb-3">
      <h2 class="text-center font-title">Vista previa: "{{$note->title}} {{\Carbon\Carbon::parse($note->created_at)->format('m-d-Y H:i')}}"</h2>

    </div>
  </div>

  <div class="text-right">
      <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
  </div>

<div class="card">
 <div class="card-body">
   <div class="text-center mb-3">
     <h4>{{$note->title}}</h4>
   </div>

   @include('medico.notes.include_data_patient')
  {{-- {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!} --}}

  <div class="form-group mt-3">
    <h5 class="font-title-blue">Exploracion fisica</h5>
    <p>{{$note->Exploracion_fisica}}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Signos vitales</h5>
    <p>{!!$note->Signos_vitales!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Pruebas de laboratorio</h5>
    <p>{!!$note->Pruebas_de_laboratorio!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Diagnostico</h5>
    <p>{!!$note->Diagnostico!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Afección principal o motivo de consulta</h5>
    <p>{!!$note->Afeccion_principal_o_motivo_de_consulta!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Afeccion secundaria</h5>
    <p>{!!$note->Afeccion_secundaria!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Pronostico</h5>
    <p>{!!$note->Pronostico!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Tratamiento y o receta</h5>
    <p>{!!$note->Tratamiento_y_o_recetas!!}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Indicaciones terapeuticas</h5>
    <p>{!!$note->Indicaciones_terapeuticas!!}</p>
  </div>


  <hr>
  <div class="mt-5">

    <div class="" style="width:50%;float:left">
      <p class="font-title-grey"><strong>Médico Tratante:</strong> {{$medico->name}} {{$medico->lastName}}</p>
      <p class="font-title-grey"><strong>Cedula profesional:</strong> {{$medico->identification}}</p>
    </div>

    <div class="" style="width:50%;float:right">

        <div class="text-center">
          <p>_________________________________</p>
        </div>

        <div class="text-center">
          <p>             <b> Firma </b>              </p>
        </div>

    </div>
  </div>
</div>
</div>


  <div class="text-right">
      <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
      <a href="{{route('download_pdf',$note->id)}}" class="btn btn-info ml-auto mr-3">Descargar en pdf</a>
  </div>

</div>

@endsection
