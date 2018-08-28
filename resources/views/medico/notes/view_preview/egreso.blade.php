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
{{-- <div class="text-right">
  <a href="{{route('notes_patient',['m_id'=>$medico->id ,'p_id'=>$patient->id])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
</div> --}}
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
  <table>
      <tr>
           <td width="500px">
              <h6 class="font-title-blue">Fecha de ingreso:</h6>
              <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_ingreso)->format('d-m-Y')}}">
              {{$fecha_egreso}}
          </td>
           <td width="500px">
              <h6 class="font-title-blue">Fecha de egreso:</h6>
              <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_egreso)->format('d-m-Y')}}">
              {{$fecha_egreso}}
          </td>
      </tr>
  </table>
<hr>
  @if($note->Motivo_del_egreso_show == 'si')

  <div class="form-group mt-3">
    <h6 class="font-title-blue">Motivo del egreso:</h6>
    {{$note->Motivo_del_egreso}}
  </div>
  <hr>
  @endif

  @if($note->Diagnosticos_finales_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Diagnosticos finales:</h6>
    {{$note->Diagnosticos_finales}}
  </div>
  <hr>
@endif
  @if($note->Resumen_de_evolucion_y_estado_actual_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Resumen de evolucion y estado actual:</h6>
    {{$note->Resumen_de_evolucion_y_estado_actual}}
  </div>
  <hr>
@endif
  @if($note->Manejo_durante_la_estancia_hospitalaria_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Manejo durante la estancia hospitalaria:</h6>
    {{$note->Manejo_durante_la_estancia_hospitalaria}}
  </div>
  <hr>
@endif
  @if($note->Problemas_clinicos_pendientes_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Problemas clinicos pendientes:</h6>
    {{$note->Problemas_clinicos_pendientes}}
  </div>
  <hr>
@endif
  @if($note->Plan_de_manejo_y_tratamiento_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Plan de manejo y tratamiento:</h6>
    {{$note->Plan_de_manejo_y_tratamiento}}
  </div>
  <hr>
@endif
  @if($note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Recomendaciones para vigilancia ambulatoira:</h6>
    {{$note->Recomendaciones_para_vigilancia_ambulatoira}}
  </div>
  <hr>
@endif
@if($note->Otros_datos_show == 'si')
  <div class="form-group">
    <h6 class="font-title-blue">Otros datos:</h6>
    {{$note->Otros_datos}}
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

<div class="col-12 text-right">
    @if($expedient == Null)
        <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
    @else
        <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'ex_id'=>\Hashids::encode($expedient->id)])}}" class="btn btn-secondary my-2 ml-auto">atras</a>
    @endif

  <a href="{{route('download_pdf',$note->id)}}" class="btn btn-info ml-auto mr-3">Descargar en pdf</a>
</div>
</div>
</div>

@endsection
