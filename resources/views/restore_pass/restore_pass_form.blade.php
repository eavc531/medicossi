@extends('layouts.app')
{{-- @section('css')
	<style media="screen">
		.invalid{

			border:#f22424 solid 1px */
		}

		.valid{
			border:rgb(24, 199, 26) solid 1px */
		}
	</style>
@endsection --}}
@section('content')



	<div class="container">
		{{-- //ALERT/ --}}
				<div class="register col-8 m-auto">
			<div class="row">
				<div class="col-12 mb-3">
					<h2 class="text-center font-title">Reestablecimiento de Contraseña</h2>
				</div>
			</div>
			{!!Form::open(['route'=>'restore_pass_store','method'=>'POST'])!!}
            <input type="hidden" name="user_id" value="{{$user->id}}">
      <div class="form-group mt-5">
        <p class="font-bold"><strong>Ingresa tu nueva Contraseña para la Cuenta: "{{$user->email}}"</strong></p>
        <p class="text-danger">La contraseña debe tener una longitud minima de 8 caracteres,almenos una letra minuscula, una letra mayuscula y un numero.</p>
      </div>
      <div class="form-group">
          <input type="password" name="password" value="" class="form-control invalid" id="pass_one" maxlength="12">

      </div>
      <p class="font-bold"><strong>Ingresa nuevamente la Contraseña:
      <div class="form-group">
          <input type="password" name="password2" value="" class="form-control" id="pass_two" maxlength="12">

      </div>
			<div class="row">
				<div class="col-lg-6 col-12 mt-2">
					<a href="{{route('home')}}" class="btn-green btn btn-block">Cancelar</a>
				</div>
				<div class="col-lg-6 col-12 mt-2">
					<button onclick="loader();this.form.submit()" type="submit" class="btn btn-block btn-azul" id="btn_guardar" disabled>Guardar Contraseña</button>
				</div>
			</div>
			<div class="row">

				{!!Form::close()!!}
			</div>
		</div>
	</section>
	<!-- Modal -->
    <input type="hidden" name="" value="" id="input_uno">
    <input type="hidden" name="" value="" id="input_dos">

	{{-- <img src="{{asset('img\spinner\ajax-loader.gif')}}" alt="">
	<button type="button" name="button" onclick="mostrar()"></button> --}}
	@endsection

	@section('scriptJS')
		<script type="text/javascript">
		$(document).ready(function() {
            input_uno = false,
            input_dos = false,
			longitud = false,
			minuscula = false,
			numero = false,
			mayuscula = false;
            longitud2 = false,
			minuscula2 = false,
			numero2 = false,
			mayuscula2 = false;

            $("#pass_one").on('keyup',function(){
                $(this).css("background","rgb(255, 214, 214)");
                pswd = $(this).val();
            	if (pswd.length < 8) {
                    $('#btn_guardar').attr('disabled', true);
                    return false;
            	} else {
            		longitud = true;
                }

                if (pswd.match(/[A-z]/)) {
    					minuscula = true;
    				} else {
    					minuscula = false;
                        $('#btn_guardar').attr('disabled', true);
    				}

                if (pswd.match(/[A-Z]/)) {
    					mayuscula = true;
    				} else {
    					mayuscula = false;
                        $('#btn_guardar').attr('disabled', true);
    				}

                	if (pswd.match(/\d/)) {

    					numero = true;
    				} else {

    					numero = false;
                        $('#btn_guardar').attr('disabled', true);
    				}

                    if(longitud == true & minuscula == true & numero == true & mayuscula == true){
                        $(this).css("background","rgb(214, 255, 215)")
                        $('#input_uno').val('si');
                    }else{
                        $(this).css("background","rgb(255, 214, 214)")
                        $('#input_uno').val('no');
                    }

                    valida_ambos();
            });

            $("#pass_two").on('keyup',function(){
                $(this).css("background","rgb(255, 214, 214)");
                pswd2 = $(this).val();

                if (pswd2.length < 8) {

                    $('#btn_guardar').attr('disabled', true);
                    longitud2 = false;
                } else {
                    longitud2 = true;
                }
                if (pswd2.match(/[A-z]/)) {
                        minuscula2 = true;
                    } else {
                        minuscula2 = false;
                        $('#btn_guardar').attr('disabled', true);
                    }

                if (pswd2.match(/[A-Z]/)) {
                        mayuscula2 = true;
                    } else {
                        mayuscula2 = false;
                        $('#btn_guardar').attr('disabled', true);

                    }

                    if (pswd2.match(/\d/)) {

                        numero2 = true;
                    } else {

                        numero2 = false;
                        $('#btn_guardar').attr('disabled', true);

                    }

                    if(longitud2 == true & minuscula2 == true & numero2 == true & mayuscula2 == true){
                        $(this).css("background","rgb(214, 255, 215)")
                        $('#input_dos').val('si');
                    }else{
                        $(this).css("background","rgb(255, 214, 214)")
                        $('#input_dos').val('no');
                    }
                    valida_ambos();
            });


            function valida_ambos(){
                input_uno = $('#input_uno').val();
                input_dos = $('#input_dos').val();
                if(input_uno == 'si' & input_dos == 'si'){
                    $('#btn_guardar').attr('disabled', false);
                }else{
                    $('#btn_guardar').attr('disabled', true);
                }
            }


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

		//EVITAR COPIAR

		$("#pass_two").on('paste', function(e){
			e.preventDefault();
			alert('Esta acción está bloqueada');
		})

		$("#pass_two").on('copy', function(e){
			e.preventDefault();
			alert('Esta acción está bloqueada');
		})

		$("#pass_one").on('paste', function(e){
			e.preventDefault();
			alert('Esta acción está bloqueada');
		})

		$("#pass_one").on('copy', function(e){
			e.preventDefault();
			alert('Esta acción está bloqueada');
		})
		</script>
	@endsection
