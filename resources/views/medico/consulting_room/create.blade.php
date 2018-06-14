@extends('layouts.app')

@section('content')
  <h4>Agregar Consultorio</h4>
  <div class="row mt-4">
    <div class="col-12">
      <div class="form-group row text-left">
        <label for="example-text-input" class="col-3 col-form-label">Tipo de Consultorio</label>
        <div class="col-8">
          {!!Form::open(['route'=>'consulting_room.store','method'=>'POST'])!!}
          <ul class="nav flex-column">
            <li class="nav-item">
              {{Form::radio('type','Medicina General o Familiar', ['class' => 'custom-control-input'])}}
              <span for="radio1"> Medicina General o Familiar </span>
            </li>
            <li class="nav-item">
              {{Form::radio('type','Consultorio de Especialidades')}}
              <span for="">Consultorio de Especialidades</span>
            </li>
            <li class="nav-item">
              {{Form::radio('type','Consultorio Odontologia')}}
              <span for="">Consultorio Odontologia</span>
            </li>
            <li class="nav-item">

              <div class="row">
                <div class="form-inline">
                  {{Form::radio('type','other')}}
                  <span for="">Otro, especifique: </span>{!!Form::text('other',null,['class'=>'form-control'])!!}
                </div>

              </li>
            </ul>
            <!--<div class="" style="display:list-item;">
            {{Form::radio('type','Medicina General o Familiar')}}

            {{Form::radio('type','Consultorio de Especialidades')}}
            <span for="">Consultorio de Especialidades</span>

            {{Form::radio('type','Consultorio Odontologia')}}
            <span for="">Consultorio Odontologia</span>

            <div class="form-inline">

            <span for="">Otro tipo de Consulta Especifique: </span>
          </div>
        </div> -->
      </div>
    </div>
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Nombre Comercial (Opcional)</label>
      <div class="col-8">
        {!!Form::text('name',null,['class'=>'form-control'])!!}
      </div>
    </div>
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Dirección</label>
      <div class="col-8">
        {!!Form::text('addres',null,['class'=>'form-control'])!!}

      </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Numero Ext (Opcional)</label>
      <div class="col-8">
        {!!Form::text('numberExt',null,['class'=>'form-control'])!!}

      </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Numero Int (Opcional)</label>
      <div class="col-8">
        {!!Form::text('numberInt',null,['class'=>'form-control'])!!}

      </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Colonia</label>
      <div class="col-8">
        {!!Form::text('colony',null,['class'=>'form-control'])!!}

      </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Ciudad</label>
      <div class="col-8">
        {!!Form::text('city',null,['class'=>'form-control'])!!}

      </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Estado</label>
      <div class="col-8">
        {!!Form::text('state',null,['class'=>'form-control'])!!}

      </div>
    </div>

    {!!Form::hidden('medico_id',$medico_id)!!}

    <div class="row my-4 mb-2">
      <div class="col-6">
        <button type="submit" name="button" class="btn-config-blue btn btn-block">Registrar</button>
      </div>
      <div class="col-6">
        <a href="{{route('medico.edit',$medico_id)}}" class="btn-config-green btn btn-block">Cancelar</a>

      </div>
    </div>

    {!!Form::close()!!}
  </div>
</div>

<div class="" style="height:50px;margin-bottom:30px;backgroun:red">

</div>
</div>
@endsection
