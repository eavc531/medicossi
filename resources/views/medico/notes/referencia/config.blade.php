@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/switch.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Configurar Nota: "{{$note->title}}" </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header bg-warning text-white">
  <b>{{$note->title}}</b>
  </div>
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_config_store','method'=>'POST'])!!}
      {!!Form::hidden('note_id',$note->id)!!}
      {!!Form::hidden('title',$note->title)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      <div class="form-group">
         @if($note->Motivo_de_envio_show == 'si')
           <h5 class="font-title-blue float-left">Motivo de envio:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Motivo_de_envio_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @else
          <h5 class="float-left font-title" style="color:grey">Motivo de envio:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
            {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Motivo_de_envio_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @endif

        @if($note->Motivo_de_envio_show == 'si')
          {{Form::textarea('Motivo_de_envio',null,['class'=>'form-control','id'=>'Motivo_de_envio','style'=>''])}}
        @else
          {{Form::textarea('Motivo_de_envio',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
        @endif
      </div>

      <div class="form-group">
         @if($note->Establecimiento_que_envia_show == 'si')
           <h5 class="font-title-blue float-left">Establecimiento que envia:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Establecimiento_que_envia_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @else
          <h5 class="float-left font-title" style="color:grey">Establecimiento que envia:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
            {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Establecimiento_que_envia_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @endif

        @if($note->Establecimiento_que_envia_show == 'si')
          {{Form::textarea('Establecimiento_que_envia',null,['class'=>'form-control','id'=>'Establecimiento_que_envia','style'=>''])}}
        @else
          {{Form::textarea('Establecimiento_que_envia',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
        @endif
      </div>

      <div class="form-group">
         @if($note->Establecimiento_receptor_show == 'si')
           <h5 class="font-title-blue float-left">Establecimiento receptor:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
             {{Form::checkbox('name', 'value', true,['onclick'=>'toogle(this)','id'=>'Establecimiento_receptor_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @else
          <h5 class="float-left font-title" style="color:grey">Establecimiento receptor:</h5>
          <label class="switch" style="display:block;margin-left:auto;">
            {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>'Establecimiento_receptor_show'])}}
             <span class="slider round text-white"><span class="ml-1">on</span> of</span>
          </label>
        @endif

        @if($note->Establecimiento_receptor_show == 'si')
          {{Form::textarea('Establecimiento_receptor',null,['class'=>'form-control','id'=>'Establecimiento_receptor','style'=>''])}}
        @else
          {{Form::textarea('Establecimiento_receptor',null,['class'=>'form-control','id'=>'Exploracion Fisica','style'=>'display:none'])}}
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
  <input type="submit" class="btn btn-success" name="" value="Guardar">
    <a href="{{route('type_notes',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
  {!!Form::close()!!}



</div>
</div>

@endsection
