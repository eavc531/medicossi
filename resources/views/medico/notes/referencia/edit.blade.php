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
      <h2 class="text-center font-title">Editar Nota: "{{$note->title}} {{\Carbon\Carbon::parse($note->created_at)->format('m-d-Y H:i')}}" </h2>

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
    {!!Form::hidden('patient_id',$patient->id)!!}

    <div class="form-group">
      <h5 class="font-title-blue">Motivo de envio:</h5>
      {{Form::textarea('Motivo_de_envio',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
    </div>

    <div class="form-group">
      <h5 class="font-title-blue">Establecimiento que envia:</h5>
      {{Form::textarea('Establecimiento_que_envia',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
    </div>
    <div class="form-group">
      <h5 class="font-title-blue">Establecimiento receptor:</h5>
      {{Form::textarea('Establecimiento_receptor',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
    </div>

    <div class="form-group">
      <h5 class="font-title-blue">Diagnostico:</h5>
      {{Form::textarea('Diagnostico',null,['class'=>'form-control','id'=>'pruebas_labs'])}}
    </div>
    <input type="submit" class="btn btn-success" name="" value="Guardar">
    <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
    {!!Form::close()!!}
    {!!Form::close()!!}

  </div>
</div>

@endsection
