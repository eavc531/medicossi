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
						<h2 class="text-center font-title">Editar datos Personales</h2>
						<hr>
					</div>
				</div>
				{!!Form::model($patient,['route'=>['patient_update',\Hashids::encode($patient->id)],'method'=>'POST'])!!}
					<div class="row">
            <div class="col-lg-6 col-12">
							<div class="form-group">
                <label for="">Cedula</label>
							   {!!Form::text('identification',null,['class'=>'form-control','placeholder'=>'Cedula'])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="">Genero</label>
							<div class="form-group">
							    {!!Form::select('gender',['Masculino'=>'Masculino','Femenino'=>'Femenino'],null,['class'=>'form-control','placeholder'=>'Genero'])!!}
							 </div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="">Nombre</label>
							<div class="form-group">
							    {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="">Apellido</label>
							<div class="form-group">
							    {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Apellido'])!!}
							 </div>
						</div>
						<div class="col-lg-6 col-12">
              <label for="">Fecha de Nacimiento</label>
              <div class="form-group">
                  {!!Form::date('birthdate',null,['class'=>'form-control','placeholder'=>'Fecha de Nacimiento'])!!}
              </div>
						</div>
						<div class="col-lg-6 col-12">

              <div class="form-group">
                <label for="">Numero de teléfono 1</label>
                  {!!Form::number('phone1',null,['class'=>'form-control','placeholder'=>'Teléfono 1'])!!}
              </div>
						</div>
            <div class="col-lg-6 col-12">
              <label for="">Numero de teléfono 2</label>
              {!!Form::number('phone2',null,['class'=>'form-control','placeholder'=>'Teléfono 2'])!!}
						</div>
						<div class="col-lg-6 col-12">

						</div>
					</div>
				  <div class="row">
				  	<div class="col-lg-6 col-12 mt-2">
              <a href="{{route('patient_profile',\Hashids::encode($patient->id))}}" class="btn-config-blue btn btn-block">Cancelar</a>
				  	</div>
				  	<div class="col-lg-6 col-12 mt-2">
				  		{!!Form::submit('Guardar',['class'=>'btn-config-green btn btn-block'])!!}
				  	</div>
				  </div>
				{!!Form::close()!!}
			</div>
		</div>
	</section>
@endsection
