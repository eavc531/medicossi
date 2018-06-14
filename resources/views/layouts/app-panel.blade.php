<!DOCTYPE html>
<html>
<head>
	<title>Medicossi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	{{-- <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}"> --}}

	{{-- <link href="{{asset('font-awesome/font-awesome.css')}}" rel="stylesheet"> --}}

	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


	@yield('css')
	<style media="screen">

	#loaderx {
		position: fixed;
		left: 50%;
		top: 50%;
		z-index: 1;
		width: 150px;
		height: 150px;
		margin: -75px 0 0 -75px;
		border: 16px solid #82cf2b;
		border-radius: 50%;
		border-top: 16px solid #0176c4;
		width: 120px;
		height: 120px;
		-webkit-animation: spin 2s linear infinite;
		animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(390deg); }
	}

	/* Add animation to "page content" */
	.animate-bottom {
		position: relative;
		-webkit-animation-name: animatebottom;
		-webkit-animation-duration: 1s;
		animation-name: animatebottom;
		animation-duration: 1s
	}

	@-webkit-keyframes animatebottom {
		from { bottom:-100px; opacity:4 }
		to { bottom:0px; opacity:1 }
	}

	@keyframes animatebottom {
		from{ bottom:-100px; opacity:0 }
		to{ bottom:0; opacity:1 }
	}

	#myDiv {
		display: none;
		text-align: center;
	}

	#Bloquear{
		 background:rgb(255, 255, 255);
		 width: 100%;
		 height: 100%;
		 filter:alpha(opacity=10);
		 opacity:0.7;
			margin: 0px;
		 position: absolute;
		 left: 0px;
		 top: 0px;
		 right: 0px;
		 z-index:1000;
		 cursor: wait;
		 margin: 0px;
		 padding: 0px;
		 /* display: none;*/
	 }

	 html
	{
			padding: 0;
			margin: 0;
			height: 100%;
			width: 100%;
	}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	{{-- LOADER --}}
	<div class="" id="Bloquear">
		<div id="loaderx"></div>
	</div>
<!-- 	<nav class="navbar navbar-toggleable-md navbar-config">
		@if(Auth::check())
		<a class="navbar-brand pl-3" id="show" href="#"><i class="fas fa-bars"></i></a>
		@endif
			<ul class="navbar-nav nav">
				<div class="dropdown text-center">
					@if(Auth::check())
					<li class=""  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="" class="font-navbar text-center">{{Auth::user()->name}}</a></li>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
					    <a href="#" class="btn-block my-1 btn-config-login btn">Editar perfil</a>
							<form action="{{route('logout')}}" method="POST">
								{{csrf_field()}}
								<button type="submit" name="button" class="btn-block btn-config-login btn my-1">Cerrar sesión</button>
							</form>
					  </div>
					@endif
				</div>

				<li class="font-navbar"> Servicios profesionales para tu salud</li>
			</ul>
		<a href="{{route('home')}}" class="position-img-navbar"><img src="{{asset('img/Medicossi-Marca original-01.png')}}" alt="" class="img-navbar"></a>
	</nav> -->
	<nav class="navbar navbar-expand-lg navbar-config">
		@if(Auth::check())
		<!-- 		<a class="navbar-brand mr-auto" id="show" href="#" style="position: absolute; left: 2%; top: 30%;"><i class="fas fa-bars"></i></a> -->
		@endif
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span><i class="fa fa-bars"></i></span>
		</button>
		<div class="collapse navbar-collapse ml-lg-auto" id="navbarSupportedContent">
			<div class="row">
				<div class="col-12 text-navbar">
					<h4 class="font-navbar">¡Siempre encontrarás tu mejor opción!</h4>
				</div>
			</div>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					@if(Auth::check())
					<a class="nav-link dropdown-toggle font-navbar" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						@if(Auth::user()->role == 'Administrador')
							<strong>Administrador:</strong> {{Auth::user()->administrator->name}} {{Auth::user()->administrator->lastName}}
						@elseif (Auth::user()->role == 'Paciente')
							<strong>Paciente:</strong> {{Auth::user()->patient->name}} {{Auth::user()->patient->lastName}}
						@elseif (Auth::user()->role == 'medico')
							<strong>Medico:</strong> {{Auth::user()->medico->name}} {{Auth::user()->medico->lastName}}
						@elseif (Auth::user()->role == 'Asistente')
							<strong>Asistente:</strong> {{Auth::user()->asistant->name}} {{Auth::user()->asistant->lastName}}
						@elseif (Auth::user()->role == 'Promotor')
							<strong>Promotor:</strong> {{Auth::user()->promoter->name}} {{Auth::user()->promoter->lastName}}
						@endif
					</a>
					<div class="dropdown-menu bg-transparent" style="border:none"; aria-labelledby="navbarDropdown">
						<a href="#" class="btn-block my-1 btn-config-login btn">Editar perfil</a>
						<form action="{{route('logout')}}" method="POST">
							{{csrf_field()}}
							<button type="submit" name="button" class="btn-block btn-secondary btn my-1">Cerrar sesión</button>
						</form>
					</div>
					@endif
				</ul>
				<form class="form-inline mb-2">
					<a href="{{route('home')}}"><img src="{{asset('img/Medicossi-Marca original-01.png')}}" alt="" class="img-navbar"></a>
				</form>
			</div>
		</nav>
		<section class="section-dashboard mb-3">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 text-center">
						<span class="btn-block btn-lg d-block d-sm-none" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="border-radius:0;"><i class="fa fa-plus mb-2 mr-2"></i>Menu</span>
					</div>
					<div class="col-lg-2 col-sm-3 col-12 ">
						<div class="collapse show" id="collapseExample">
						@include('layouts.dashboard')
						</div>
					</div>
					<div class="col-lg-10 col-sm-9 col-12">
						@include('notifications.alerts')
						@yield('content')
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="section-footer sticky-bottom">
				<div class="row align-items-center nomargin p-1">
					<div class="col-lg-6 col-sm-6 col-12 text-center nopadding">
						<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-13.png')}}" alt=""></a>
						<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-14.png')}}" alt=""></a>
						<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-15.png')}}" alt=""></a>
						<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-16.png')}}" alt=""></a>
					</div>
					<div class="col-lg-6 col-sm-6 col-12 text-center nopadding">
						<span class="font-footer"><b>MedicosSi</b> siempre encontrarás tu mejor opción.</span>
					</div>
				</div>
			</div>
		</footer>

	</body>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>

	<script src="https://use.fontawesome.com/7886bdfbdc.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	{{-- flata fint awesome js --flata fint awesome js -flata fint awesome js --}}

	{{-- <script type="text/javascript" src="{{asset('jquery\jquery.js ')}}"></script> --}}
	{{-- <script src="{{asset('bootstrap\js\bootstrap.js')}}"></script> --}}


	<script type="text/javascript" src="{{asset('js/main.js')}}"></script>


	<script type="text/javascript">

	$(window).on("load", function() {
			preloaderFadeOutTime = 400;
			function hidePreloader() {
					var preloader = $('#Bloquear');
					preloader.fadeOut(preloaderFadeOutTime);
					var preloader = $('#loaderx');
					preloader.fadeOut(preloaderFadeOutTime);
			}
			hidePreloader();
	});

	function loader(){
	  $('#Bloquear').show()
	  $('#loaderx').show()
	}

	function stop_loader(){
		$('#Bloquear').hide();
	  $('#loaderx').hide();
	}
	</script>
	@yield('scriptJS')
	</html>
