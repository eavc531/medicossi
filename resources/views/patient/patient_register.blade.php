@extends('layouts.app')

@section('content')
  <section class="box-register">

		<div class="container">
      <div class="row">
    		<div class="col-12 text-right">
    			<div class="btn-group " role="group" aria-label="Basic example">
    				<button type="button" class="btn btn-config-blue">1</button>
    				<button type="button" class="btn btn-secondary">2</button>
    				<button type="button" class="btn btn-secondary">3</button>
    			</div>
    		</div>
    	</div>
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Registro de Paciente</h2>
						<hr>
					</div>
				</div>
				{!!Form::open(['route'=>'patient_register','method'=>'POST'])!!}
					<div class="row">
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Cedula</label>
							<div class="form-group">
							   {!!Form::text('identification',null,['class'=>'form-control',])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="" class="font-title">Genero</label>
							<div class="form-group">
							    {!!Form::select('gender',['Masculino'=>'Masculino','Femenino'=>'Femenino'],null,['class'=>'form-control'])!!}
							 </div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="" class="font-title">Nombre</label>
							<div class="form-group">
							    {!!Form::text('name',null,['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="" class="font-title">Apellido</label>
							<div class="form-group">
							    {!!Form::text('lastName',null,['class'=>'form-control'])!!}
							 </div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="" class="font-title">Fecha de Nacimiento</label>
              <div class="form-group">
                  {!!Form::date('birthdate',null,['class'=>'form-control'])!!}
              </div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="" class="font-title">Teléfono</label>
              <div class="form-group">
                  {!!Form::number('phone1',null,['class'=>'form-control'])!!}
              </div>
						</div>
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Email</label>
							<div class="form-group">
							    {!!Form::email('email',null,['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="" class="font-title">Clave de Usuario</label>
							<div class="form-group">
							    {!!Form::password('password',['class'=>'form-control'])!!}
							</div>
						</div>
					</div>
				  <div class="row">
				  	<div class="col-lg-6 col-12 mt-2">
              <a href="{{route('patient.index')}}" class="btn-config-blue btn btn-block">Cancelar</a>

				  	</div>
				  	<div class="col-lg-6 col-12 mt-2">
				  		{!!Form::submit('Registrar',['class'=>'btn-config-green btn btn-block'])!!}
				  	</div>
				  </div>
				{!!Form::close()!!}
			</div>
		</div>
	</section>
@endsection
