@extends('layouts.app')

@section('content')
  <section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Registrar Administrador</h2>
						<hr>
					</div>
				</div>
				{!!Form::open(['route'=>'administrators.store','method'=>'POST'])!!}
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="form-group">
							    {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="form-group">
							    {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Apellido'])!!}
							 </div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="form-group">
							    {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'email'])!!}
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="form-group">
							    {!!Form::password('password',['class'=>'form-control','placeholder'=>'password'])!!}
							</div>
						</div>
					</div>
				  <div class="row">
				  	<div class="col-lg-6 col-12 mt-2">
              <a href="{{route('administrators.index')}}" class="btn-config-blue btn btn-block">Cancelar</a>
				  		
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
