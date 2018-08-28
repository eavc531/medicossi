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

{{-- <div class="text-right">
  <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
</div> --}}
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="row">
    <div class="col-8">
     <img style="float:left;width: 50%;" src="http://127.0.0.1:8000/img/Medicossi-Marca original-01.png" alt="">
   </div>
    <div class="col-4">
      {{-- <p style="float:right;padding: 10px;">Fecha: {{\Carbon\Carbon::parse($note->date_start)->format('d-m-Y')}}</p> --}}
    </div>
 </div>
 <div class="card-body">
   @include('medico.notes.include_data_consultorio')
   <div class="text-center mb-3">
     <h4 style="text-decoration: underline;">{{$note->title}}</h4>
   </div>

   @include('medico.notes.include_data_patient')
  @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
   <div class="form-group">
    <h5 class="font-title-blue">Afección principal o motivo de consulta</h5>
    <p>{{$note->Afeccion_principal_o_motivo_de_consulta}}</p>

  </div>
  <hr>
@endif
  @if($note->Afeccion_secundaria_show == 'si')
  <div class="form-group">
    <h5 class="font-title-blue">Afección secundaria</h5>
    <p>{{$note->Afeccion_secundaria}}</p>
  </div>
  <hr>
@endif
@if($note->Pronostico_show == 'si')
  <div class="form-group">
    <h5 class="font-title-blue">Pronostico</h5>
    <p>{{$note->Pronostico}}</p>

  </div>
  <hr>
@endif

@if($note->Pruebas_de_laboratorio_show == 'si')
<div class="form-group">
  <h5 class="font-title-blue">Pruebas de laboratorio</h5>
  @include('medico.notes.view_preview.test_labs')
</div>
<hr>
@endif
@if($note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
  <div class="form-group">
    <h5 class="font-title-blue">Evolución y actualización del cuadro clinico</h5>
    <p>{{$note->Evolucion_y_actualizacion_del_cuadro_clinico}}</p>

  </div>
  <hr>
@endif
@if($note->Sugerencias_y_tratamiento_show == 'si')
  <div class="form-group">
    <h5 class="font-title-blue">Sugerencias y tratamiento</h5>
    <p>{{$note->Sugerencias_y_tratamiento}}</p>
    <hr>
@endif

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
    @if($expedient == Null)
        <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
    @else
        <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'ex_id'=>\Hashids::encode($expedient->id)])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
    @endif


  <a href="{{route('download_pdf',\Hashids::encode($note->id))}}" class="btn btn-info ml-auto mr-3">Descargar en pdf</a>
</div>


</div>


@endsection
