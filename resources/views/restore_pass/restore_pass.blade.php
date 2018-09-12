@extends('layouts.app')
@section('css')

@endsection
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
					<h2 class="text-center font-title">Solicitud de cambio de Contraseña</h2>
				</div>
			</div>
			{!!Form::open(['route'=>'restore_pass_send','method'=>'POST'])!!}
      <div class="form-group mt-5">
        <p class="font-bold"><strong>Ingresa el correo electronico asociado a tu cuenta MedicosSí, que deseas recuperar, para enviar el mensaje de confirmacion requerido y poder reestablecer tu contraseña.</strong></p>
      </div>
      <div class="form-group">
        <label for="" class="font-title">Correo:</label>
          {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'ejemplo@mail.com'])!!}
      </div>

			<div class="row">
				<div class="col-lg-6 col-12 mt-2">
					<a href="{{route('home')}}" class="btn-green btn btn-block">Cancelar</a>
				</div>
				<div class="col-lg-6 col-12 mt-2">
					<button onclick="loader();this.form.submit()" type="submit" class="btn btn-block btn-azul">Enviar Solicitud</button>
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

	@section('scriptJS')
		<script type="text/javascript">
		$(document).ready(function() {
			var longitud = false,
			minuscula = false,
			numero = false,
			mayuscula = false;
			$('input[type=password]').keyup(function() {
				var pswd = $(this).val();
				if (pswd.length < 8) {
					$('#length').removeClass('valid').addClass('invalid');
					longitud = false;
				} else {
					$('#length').removeClass('invalid').addClass('valid');
					longitud = true;
				}

				//validate letter
				if (pswd.match(/[A-z]/)) {
					$('#letter').removeClass('invalid').addClass('valid');
					minuscula = true;
				} else {
					$('#letter').removeClass('valid').addClass('invalid');
					minuscula = false;
				}

				//validate capital letter
				if (pswd.match(/[A-Z]/)) {
					$('#capital').removeClass('invalid').addClass('valid');
					mayuscula = true;
				} else {
					$('#capital').removeClass('valid').addClass('invalid');
					mayuscula = false;
				}

				//validate number
				if (pswd.match(/\d/)) {
					$('#number').removeClass('invalid').addClass('valid');
					numero = true;
				} else {
					$('#number').removeClass('valid').addClass('invalid');
					numero = false;
				}
			}).focus(function() {
				$('#pswd_info').show();
			}).blur(function() {
				$('#pswd_info').hide();
			});

			$("#registro").submit(function(event) {
				alert("hola");
				if(longitud && minuscula && numero && mayuscula){
					alert("password correcto");
					$("#registro").submit();

				}else{
					alert("Password invalido.");
					event.preventDefault();
				}

			});
		});
		</script>
	@endsection
