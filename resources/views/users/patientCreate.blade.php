@extends('layouts.app')

@section('content')

<h1>Registro Para Pacientes</h1>

<h4 style="float:left">Tu Registro en 2 pasos:</h4>
<div class="white-space:nowrap;">
      <div style="display:inline-block;background:blue;color:white;border:1px black solid">Paso 1</div>
      <div style="display:inline-block;border:1px black solid">Paso 2</div>
</div>

{!!Form::open(['route'=>'user.store', 'method'=>'POST'])!!}
   <div class="form-group">
      <label for="name"> <strong>Nombre:</strong></label>
      {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>
   <div class="form-group">
      <label for="lastName"> <strong>Apellido:</strong></label>
      {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Ingrese Apellido', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>
   <div class="form-group">
      <label for="gender"> <strong>Genero:</strong></label>
      {!!Form::select('gender',['Masculino'=>'Masculino','Femenino'=>'Femenino'],null,['class'=>'form-control','placeholder'=>'', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>

   <div class="form-group">
      <label for="email"> <strong>Correo:</strong></label>
      {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>
   <div class="form-group">
      <label for="password"> <strong>Clave:</strong></label>
      {!!Form::password('password',['class'=>'form-control','placeholder'=>'', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>

   <div class="form-group">
      <label for="phone"> <strong>teléfono Celular:</strong></label>
      {!!Form::text('cellPhone',null,['class'=>'form-control','placeholder'=>'', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>
   <div class="form-group">
      <label for="phone"> <strong>teléfono (Opcional):</strong></label>
      {!!Form::text('phone',null,['class'=>'form-control','placeholder'=>'', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
   </div>
   <div class="form-group col-sm-12">
      {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
      <a style=""class="btn btn-default" href="{{route('home')}}"><strong>Cancelar</strong>
      </a>
   </div>


{!!Form::close()!!}



@endsection
