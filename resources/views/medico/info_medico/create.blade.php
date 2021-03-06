@extends('layouts.app')

@section('content')

<div class="row mt-4">
  <div class="col-12">
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Tipo de Estudiosss</label>
      <div class="col-8">
        {!!Form::open(['route'=>'info_medico.store','method'=>'POST'])!!}
        <div class="m-3">
          <div class="form-group">
            xxxxxx
            {{Form::radio('type','Pregrado o  Carrera Profesional')}}
            <span for=""> Pregrado o  Carrera Profesional </span>
          </div>
          {{Form::radio('type','Post-Grado o Residencia Medica')}}
          <span for="">Post-Grado o Residencia Medica</span>

          {{Form::radio('type','Sub-Especialidad')}}
          <span for="">Sub-Especialidad</span>

          <div class="form-inline">
            {{Form::radio('type','other')}}
            <span for="">Otro, especifique:</span>{!!Form::text('other',null,['class'=>'form-control'])!!}
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Nombre de la institución</label>
      <div class="col-8">
        {!!Form::text('institution',null,['class'=>'form-control'])!!}
      </div>
    </div>
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Especialidad que cursó</label>
      <div class="col-8">
        {!!Form::text('specialty',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Estado del Estudio</label>
      <div class="col-8">
        {!!Form::select('state',['Culminado'=>'Culminado','En Curso'=>'En Curso'],null,['class'=>'form-control','placeholder'=>'Seleccione una opción'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-datetime-local-input" class="col-3 col-form-label">Periodo en que lo curso</label>
      <div class="col-4">
          {!!Form::date('from',null,['class'=>'form-control'])!!}
      </div>
        <label for="example-text-input" class="col-form-label">/</label>
      <div class="col-4">
          {!!Form::date('until',null,['class'=>'form-control'])!!}
      </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Información Adicional (Ocional)</label>
      <div class="col-8">
        {!!Form::text('aditional',null,['class'=>'form-control'])!!}
      </div>
        {!!Form::hidden('medico_id',$medico_id)!!}
    </div>
    <button type="submit" name="button">Regitrar</button>

    <button type="submit" name="button">Cancelar</button>
    {!!Form::close()!!}
  </div>
</div>
@endsection
