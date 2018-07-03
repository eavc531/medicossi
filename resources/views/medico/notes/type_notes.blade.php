@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Crear nota para: {{$patient->name}} {{$patient->lastName}} </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
@include('medico.includes.main_medico_patients')
<div class="text-right">
  <a class="btn btn-secondary my-2" href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id,])}}">Atras</a>
</div>
<div class="mb-5">
  <div class="text-center">
    <h4 class="font-title-blue">Tipos de notas</h4>
  </div>
</div>
<ul class="list-group">
@foreach ($notes_pre as $note)
  <li class="list-group-item d-flex justify-content-between align-items-sm-start align-items-end"><span class="mr-auto">{{$note->title}}</span>
    @if($note->title == 'Nota Médica Inicial')
    <a href="{{route('note_medic_ini_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
    <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a></li>
    @elseif($note->title == 'Nota Médica de Evolucion')
    <a href="{{route('note_evo_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
    <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a></li>
    @elseif($note->title == 'Nota de Interconsulta')
    <a href="{{route('note_inter_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
    <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a></li>
    @elseif($note->title == 'Nota médica de Urgencias')
    <a href="{{route('note_urgencias_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
    <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a></li>
    @elseif($note->title == 'Nota médica de Egreso')
      <a href="{{route('note_egreso_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>

    @elseif($note->title == 'Nota de Referencia o traslado')
      <a href="{{route('note_referencia_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
    @endif

@endforeach
</ul>


@endsection
