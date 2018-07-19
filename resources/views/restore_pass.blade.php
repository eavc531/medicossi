@extends('layouts.app')

@section('content')


<section class="box-register">

	<div class="container">
		<div class="register col-8 m-auto">
			<div class="row">
				<div class="col-12 mb-3">
					<h2 class="text-center font-title">Solicitud de cambio de Contraseña</h2>
				</div>
			</div>
			{!!Form::open(['route'=>'restore_pass_email','method'=>'POST'])!!}
      <div class="form-group mt-5">
        <p class="font-bold"><strong>Ingresa el correo electronico asociado a tu ceunta MedicosSí, a donde se enviara una clave aleatoria, que necesitaras para confirmar tu solicitud de cambio de Contraseña.</strong></p>
      </div>
      <div class="form-group">
        <label for="" class="font-title">Correo:</label>
          {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'ejemplo@mail.com'])!!}
      </div>

			<div class="row">
				<div class="col-lg-6 col-12 mt-2">
					<a href="" class="btn-config-blue btn btn-block">Cancelar</a>
				</div>
				<div class="col-lg-6 col-12 mt-2">
					<button onclick="loader();this.form.submit()" type="submit" class="btn-config-green btn btn-block">Enviar Solicitud</button>
				</div>
			</div>
			<div class="row">

				{!!Form::close()!!}
			</div>
		</div>
	</section>
	<!-- Modal -->

	{{-- <img src="{{asset('img\spinner\ajax-loader.gif')}}" alt="">
	<button type="button" name="button" onclick="mostrar()"></button> --}}
	@endsection

	{{-- @section('scriptJS')
		<script type="text/javascript">
		function mostrar(){
			alert('sdxxx');
				$('.spinner-wrapper').show;
		}

		</script>
	@endsection --}}
