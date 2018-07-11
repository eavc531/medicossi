<!DOCTYPE html>
<html>
<head>
	<title>Medicossi</title>
	<link rel="stylesheet" href="{{asset('tether/css/tether.min.css')}}">
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap_alpha_6.min.css')}}">
	<link rel="stylesheet" href="{{asset('fontawesome/css/fontawesome.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
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
						<span class="btn-block btn-lg btn-config-green d-block d-sm-none" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="border-radius:0;"><i class="fa fa-plus mr-2 mb-2"></i>Menu</span>
					</div>
					<div class="col-lg-2 col-12 col-sm-3 mb-2">
						<div class="collapse show" id="collapseExample">
							@include('layouts.dashboard')
						</div>
					</div>
					<div class="col-lg-8 col-12 col-sm-9 box-mesage">
						@include('notifications.alerts')
						{{-- <img src = "{{asset('img/botones-medicossi-01.jpg')}}" id = "share_button"> --}}
						<div id="fb-root"></div>
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

	<script src="{{asset('jquery/jquery.js')}}"></script>

	<script src="{{asset('tether/js/tether.min.js')}}"></script>
	{{-- <script src="{{asset('popper/js/popper.js')}}"></script> --}}

	{{-- <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script> --}}
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script src="{{asset('fontawesome/js/fontawesome.js')}}"></script>

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
		$('#Bloquear').show();
		$('#loaderx').show();
	}

	function stop_loader(){
		$('#Bloquear').FadeOut();
		$('#loaderx').FadeOut();
	}

	//facebook compartir
	window.fbAsyncInit = function() {
		FB.init({appId: '909330232583499', status: true, cookie: true,
		xfbml: true});
	};
	(function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol +
		'//connect.facebook.net/en_US/all.js';
		document.getElementById('fb-root').appendChild(e);
	}());
	//cuadro de dialogo compartir
	$(document).ready(function(){
		$('#share_button').click(function(e){
			e.preventDefault();
			FB.ui(
				{
					method: 'feed',
					name: 'This is the content of the "name" field.',
					link: 'https://132.148.140.54/medicossi/public/home',
					picture: 'http://www.groupstudy.in/img/logo3.jpeg',
					caption: 'Top 3 reasons why you should care about your finance',
					description: "What happens when you don't take care of your finances? Just look at our country -- you spend irresponsibly, get in debt up to your eyeballs, and stress about how you're going to make ends meet. The difference is that you don't have a glut of taxpayers…",
					message: ""
				});
			});
		});
		</script>

		@yield('scriptJS')
		</html>
