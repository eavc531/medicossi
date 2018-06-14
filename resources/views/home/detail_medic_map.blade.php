@extends('layouts.app')

@section('content')

	<section class="box-register">
		<div class="text-right">

			<button onclick="window.history.back();" type="button" name="button" class="btn btn-secondary">Volver</button>
		</div>
    <div class="row mb-4">

		<div class="container">
      {{-- <div class="row mb-3">
        <div class="col-6 text-left">
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
        </div>
      </div> --}}
      <hr>
      <div class="row">
				<div class="col-8 m-auto col-sm-3 col-lg-3">
					<div class="cont-img">
{{$medico['image']}}
						@isset($photo->path)
						<img src="{{asset($photo->path)}}" class="prof-img img-thumbnail" alt="..." >
						@else
						<img src="{{asset('img/profile.png')}}" class="prof-img img-thumbnail" alt="...">
						@endisset
					</div>
				</div>
          <div class="col-12 col-sm-5 col-lg-5">
           <div class="card-body p-2">
            <h5 class="card-title title-edit">{{$medico['name']}}</h5>
            <p>Cédula: {{$medico['identification']}}</p>
            <span>Especialidad:</span> <a href="#" class="outstanding mr-2"> {{$medico['specialty']}}</a>
            <div class="star-profile">
              <ul class="rating mt-1">
                <li class="star container-franchise__star li-config">&starf;</li>
                <li class="star container-franchise__star li-config">&starf;</li>
                <li class="star container-franchise__star li-config">&starf;</li>
                <li class="star container-franchise__star li-config">&starf;</li>
                <li class="star container-franchise__star li-config">&starf;</li>
              </ul>
            </div>
            <div class="row mt-3 align-self-end">
              <div class="col-12">
                <a href="{{route('detail_medic_map',$medico['id'])}}" class="btn btn-primary btn-sm text-white"><p class="card-text"><i class="fas fa-map-marker-alt mr-1"></i><b>{{$medico['state']}},{{$medico['city']}}</b></p></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-4 p-4">
          <div class="form-group">

            <a class="btn btn-success" href="{{route('medico.edit',$medico['id'])}}">Perfil</a>
          </div>
          <div class="form-group">
            <a href="" class="btn-icon"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</a>
          </div>
          <div class="form-group">
           <a href="" class="btn-icon"><i class="fa fa-phone mr-2"></i>Ver Telefono</a>
         </div>
         @isset($medico['dist'])
           <div class="form-group">
            <p>Distancia: {{$medico['dist']}}</p>
          </div>
         @endisset

       </div>
     </div>
     <hr>
     <div id="map" style="height:400px">

     </div>
		</div>
    </div>
	</section>
@endsection

@section('scriptJS')
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>

  <script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>
  <script type="text/javascript">

  </script>
  <script type="text/javascript">

  $('document').ready(function(){
    show_map();
  });
  function show_map(){
    $('#store_coordinates').attr('disabled', true);
    lat = '{{$medico->latitud}}';
    lng = '{{$medico->longitud}}';
    var map = new GMaps({
      el: '#map',
      lat: lat,
      lng: lng,
      zoom: 14,
    });
    map.addMarker({
      lat: lat,
      lng: lng,
      title: '{{$medico->name}} {{$medico->lastName}}',
      icon: "{{asset('img/marker-icon.png')}}",

  });//fin marker
  }
  </script>
@endsection
