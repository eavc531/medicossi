@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
@endsection
@section('content')
  <div class="row">
    <div class="col-12 mb-3">
      <h2 class="text-center font-title">Vista previa: {{$note->title}} "{{$note->created_at}}" </h2>

    </div>
  </div>

  <div class="text-right">
      <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
  </div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">


  <div class="card-body">
    <div class="text-center mb-3">
      <h4>{{$note->title}}</h4>
    </div>
    @include('medico.notes.include_data_patient')


    <div class="form-group" style="margin-top:90px">
      <hr>
      <h5 class="font-title-blue">Signos vitales</h5>
      <p>{!!$note->Signos_vitales!!}</p>

    </div>
    <hr>
    <div class="form-group">
      <h5 class="font-title-blue">Motivo_de_atencion</h5>
      <p>{{$note->Motivo_de_atencion}}</p>
    </div>
<hr>
    <div class="form-group">
      <h5 class="font-title-blue">Estado mental</h5>
      <p>{{$note->Estado_mental}}</p>
    </div>
<hr>
    <div class="form-group">
      <h5 class="font-title-blue">Resultados relevantes de los servicios auxiliares de diagnostico</h5>
      <p>{{$note->Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico}}</p>
    </div>
<hr>
    <div class="form-group">
      <h5 class="font-title-blue">Diagnostico</h5>
      <p>{{$note->Diagnostico}}</p>
    </div>
<hr>
    <div class="form-group">
      <h5 class="font-title-blue">Pronostico</h5>
      <p>{{$note->Pronostico}}</p>
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

  <div class="text-right">
    <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id) ,'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
    <a href="{{route('download_pdf',\Hashids::encode($note->id))}}" class="btn btn-info ml-auto mr-3">Descargar en pdf</a>
  </div>

</div>



@endsection
