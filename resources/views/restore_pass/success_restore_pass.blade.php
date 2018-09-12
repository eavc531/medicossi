@extends('layouts.app')

@section('content')

	<div class="container">
		{{-- //ALERT/ --}}
		@if(Session::Has('warning2'))
		   <div class="div-alert p-1">
			  <div class="alert alert-warning alert-dismissible" role="alert">
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				 {{Session::get('warning2')}}
			  </div>
			  </div>
		   @endif

		<div class="register col-8 m-auto">
			<div class="row">
				<div class="col-12 mb-3">
					<h2 class="text-center font-title">Solicitud de cambio de Contraseña Enviada</h2>
				</div>
			</div>

      <div class="form-group mt-5">
        <p class="font-bold"><strong>Se a enviado un mensaje de confirmación al correo: <span class="text-success">"{{request()->email}}"</span>, que le permitira aceptar y realizar el cambio de la contraseña de su cuenta MédicosSi</strong></p>
      </div>
      <div class="text-center">
          <a href="{{route('home')}}" class="btn btn-azul">Volver a Inicio</a>
      </div>



		</div>
	</section>
	<!-- Modal -->

	{{-- <img src="{{asset('img\spinner\ajax-loader.gif')}}" alt="">
	<button type="button" name="button" onclick="mostrar()"></button> --}}
	@endsection
