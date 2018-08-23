@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="row mb-3">
    <div class="col-12 col-lg-8 col-sm-9">
      <h3 class="font-title text-center mb-3">Editar datos de centros médicos</h3>
    </div>
    <div class="col text-right">
      <a class="btn btn-primary" href="{{route('medicalCenter.edit',\Hashids::encode(request()->id))}}">Atras</a>
    </div>
  </div>
  {!!Form::model($medicalCenter,['route'=>['medical_center_edit_data_update',\Hashids::encode($medicalCenter)],'method'=>'update'])!!}
  <div class="row">
    <div class="col-lg-6 col-sm-6 m-sm-auto col-12">
      <div class="form-group">
        <label for="" class="font-title">Nombre de la Institución o Centro Medico</label>
        {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Centro Medico'])}}
      </div>
      <div class="form-group">
        <label for="" class="font-title">Nombre del Administrador</label>
        {{Form::text('nameAdmin',null,['class'=>'form-control','placeholder'=>'Nombre del Administrador'])}}
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 m-sm-auto col-12">
      <div class="form-group">
        <div class="form-group">
          <label for="" class="font-title">Email de la institución (opcional)</label>
          {{Form::text('email_institution',null,['class'=>'form-control'])}}
        </div>
      </div>
      <div class="form-group">
        <label for="" class="font-title">Teléfono del Administrador</label>
        {{Form::text('phone_admin',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Licencia sanitaria</label>
        {{Form::text('sanitary_license',null,['class'=>'form-control'])}}
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Id del Centro Medico</label>
        {{Form::text('id_medicalCenter',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Telefono de Oficina 1</label>
        {{Form::text('phone',null,['class'=>'form-control'])}}
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="" class="font-title">Telefono de Oficina 2</label>
        {{Form::text('phone2',null,['class'=>'form-control'])}}
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        <a href="{{route('medicalCenter.edit',\Hashids::encode($medicalCenter->id))}}" class="btn btn-primary btn-block">Cancelar</a>
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-12">
      <div class="form-group">
        {{Form::submit('Guardar',['class'=>'btn btn-config-green btn-block'])}}
      </div>
    </div>
  </div>
  {!!Form::close()!!}

</div>
</section>
@endsection
