@extends('layouts.app')
@section('css')
<style media="screen">
textarea.form-control{
  height: 100px;
}
</style>
@endsection
@section('content')
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

      <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
          <h5 class="font-title-blue">Fecha de ingreso:</h5>

          <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_ingreso)->format('d-m-Y')}}">
          {{$fecha_egreso}}
        </div>
        <div class="col-lg-6 col-sm-6 col-12">
          <h5 class="font-title-blue">Fecha de egreso:</h5>
          <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_egreso)->format('d-m-Y')}}">
          {{$fecha_egreso}}
        </div>
      </div>
<hr>
      <div class="form-group mt-3">
        <h5 class="font-title-blue">Motivo del egreso</h5>
        {{$note->Motivo_del_egreso}}
      </div>
<hr>
<div class="form-group">
        <h5 class="font-title-blue">Diagnosticos finales</h5>
        {{$note->Diagnosticos_finales}}
      </div>
<hr>
      <div class="form-group">
        <h5 class="font-title-blue">Resumen de evolucion y estado actual</h5>
        {{$note->Resumen_de_evolucion_y_estado_actual}}
      </div>
<hr>
      <div class="form-group">
        <h5 class="font-title-blue">Manejo durante la estancia hospitalaria</h5>
        {{$note->Manejo_durante_la_estancia_hospitalaria}}
      </div>
<hr>
      <div class="form-group">
        <h5 class="font-title-blue">Problemas clinicos pendientes</h5>
        {{$note->Problemas_clinicos_pendientes}}
      </div>
<hr>
      <div class="form-group">
        <h5 class="font-title-blue">Plan de manejo y tratamiento</h5>
        {{$note->Plan_de_manejo_y_tratamiento}}
      </div>
<hr>
      <div class="form-group">
        <h5 class="font-title-blue">Recomendaciones para vigilancia ambulatoira</h5>
        {{$note->Recomendaciones_para_vigilancia_ambulatoira}}
      </div>
<hr>
      <div class="form-group">
        <h5 class="font-title-blue">Otros Datos</h5>

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


</div>
<div class="text-right">
    <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
    <a href="{{route('download_pdf',$note->id)}}" class="btn btn-info ml-auto mr-3">Descargar en pdf</a>
</div>



  @endsection
