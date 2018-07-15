@extends('layouts.app')

@section('css')

{{-- <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css"> --}}
<link rel="stylesheet" href="{{asset('jqueryui/jquery-ui.css')}}">

@endsection
@section('content')

  {{-- {{ Form::open(['action' => ['HomeController@autocomplete_specialty'], 'method' => 'GET']) }}
    {{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter name'])}}
    {{ Form::submit('Search', array('class' => 'button expand')) }}
{{ Form::close() }} --}}

  @if(!isset(Auth::user()->id))
  <div class="row">
    <div class="col-5">
      <div class="text-center">
        <h5 class="font-title-index">¿Ya eres un profesional registrado?</h5>
          <a class="mr-3" href="" data-toggle="modal" data-target="#modal-register"><img width="130px" height="50px" class="box-shadox" src="{{asset('img/botones-medicossi-18.png')}}"></a>
      </div>
    </div>
    <div class="col-5">
      <div class="text-center">
       <h5 class="font-title-index">¿Eres paciente? Registrate aqui</h5>
     </div>
     <div class="text-center">
      <a class="mr-3" href="{{route('patient_register_view')}}"><img width="130px" height="50px" class="box-shadox" src="{{asset('img/botones-medicossi-18.png')}}"></a>
    </div>
    </div>
    <div class="col-2">
      <div class="" style="margin-top:23px">
        <a href="" data-toggle="modal" data-target="#modal-login"><img width="130px" height="50px" class="box-shadox mt-4" src="{{asset('img/botones-medicossi-20.png')}}"></a>
      </div>
    </div>
  </div>
@endif
<div class="row box-index mt-4">
  <div class="col-12">
    <div id="flip">
      <div class="col-lg-12">
        {{Form::model(Request::all(),['route'=>'tolist2','method'=>'get'])}}
        <div class="input-group search">
          <span class="mr-2 white" id="filter"><i class="fas fa-filter fa-2x" data-toggle="tooltip" data-placement="top" title="Busqueda Avanzada"></i></span>
          {{Form::select('typeSearch',['Centro Medico'=>'Nombre del Centro Médico','Especialidad Medica'=>'Especialidad Médica','Nombre/Cedula del Medico'=>'Nombre/Cedula del Medico',],null,['placeholder'=>'Buscar Por:','id'=>'typeSearch'])}}
          {{Form::text('search',null,['class'=>'form-control','placeholder'=>'Ingresar termino de Busqueda','id'=>'search'])}}
          <input type="hidden" name="lat" value="" id="lat">
          <input type="hidden" name="lng" value="" id="lng">
          {{-- {{Form::hidden('city',null,['id'=>'city'])}}
          {{Form::hidden('state',null,['id'=>'state'])}} --}}
          <button type="submit" class="ml-2 white"><span id="filter"><i class="fas fa-search fa-2x"></i></span></button>
        </div>
      </div>
    </div>
    <div id="panel">
      <div class="box-filter">
        <div class="row">
          <div class="col-4">
            <div class="col-12 mt-3">
              <div class="form-group">
                  <label class="custom-control-description">Ordenar por Puntaje</label>
                  <div class="text-center">
                  {{Form::select('filter_ranking',['no'=>'no','si'=>'si'],null,['class'=>'form-control','id'=>'filter_ranking','style'=>'width:100px'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-8">
            <div class="col-12 mt-3">
                @if(request()->dist == Null)
                  <div class="form-inline">
                    <p class="mr-4"><strong>Filtrar por:</strong></p>
                    <button type="button" name="button" onclick="ubicacion()" id="btn-ubicacion" class="btn btn-primary" disabled>Ubicación</button>
                    <button type="button" name="button" onclick="distancia()" id="btn-distancia" class="btn btn-secondary" style="color:black">Distancia</button>
                  </div>
                  <div class="tab-content" id="myTabContent">
                <div class="" id="div_ubicacion">
                  <div class="row mt-3">
                    <div class="form-group col-6">
                      {!!Form::select('state',$states,request()->state,['class'=>'form-control','id'=>'stateMedic','placeholder'=>'estado'])!!}
                    </div>
                    <div class="form-group col-6">
                      {!!Form::select('city',$cities,request()->city,['class'=>'form-control','id'=>'cityMedic','placeholder'=>'ciudad'])!!}
                    </div>
                  </div>
                </div>
                <div class="" id="div_distancia"  aria-labelledby="profile-tab" style="display:none">
                  <div class="form-group mt-3">
                    <div class="col-12 mt2-">
                      {{Form::select('dist',[50=>'50 Km',100=>'100 Km',200=>'200 Km',400=>'400 Km',800=>'800 Km',1000=>'1000 Km',2000=>'2000 Km',10000=>'10000 Km',15000=>'15000 Km',50000=>'50000 Km'],null,['class'=>'form-control','id'=>'dist','placeholder'=>'seleccione una opcion'])}}
                    </div>
                  </div>
                </div>
              </div>
              @else
                <div class="form-inline">
                  <p class="mr-4"><strong>Filtrar por:</strong></p>
                <button type="button" name="button" onclick="ubicacion()" id="btn-ubicacion" class="btn btn-primary">Ubicación</button>
                <button type="button" name="button" onclick="distancia()" id="btn-distancia" class="btn btn-secondary" disabled style="color:black">Distancia</button>
                </div>
                <div class="tab-content" id="myTabContent">
                <div class="" id="div_ubicacion" style="display:none">
                  <div class="row mt-3">
                    <div class="form-group col-6">
                      {!!Form::select('state',$states,request()->state,['class'=>'form-control','id'=>'stateMedic','placeholder'=>'estado'])!!}
                    </div>
                    <div class="form-group col-6">
                      {!!Form::select('city',$cities,request()->city,['class'=>'form-control','id'=>'cityMedic','placeholder'=>'ciudad'])!!}
                    </div>
                  </div>
                </div>
                <div class="" id="div_distancia"  aria-labelledby="profile-tab">
                  <div class="form-group mt-3">
                    <div class="col-12 mt2-">
                      {{Form::select('dist',[50=>'50 Km',100=>'100 Km',200=>'200 Km',400=>'400 Km',800=>'800 Km',1000=>'1000 Km',2000=>'2000 Km',10000=>'10000 Km',15000=>'15000 Km',50000=>'50000 Km'],null,['class'=>'form-control','id'=>'dist','placeholder'=>'seleccione una opcion'])}}
                    </div>
                  </div>
                </div>
              </div>
              @endif
              {{Form::close()}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-justify mt-3">
      {{-- //PANTALLA ESPECIALIDADES POR CATEGORIA//PANTALLA ESPECIALIDADES POR CATEGORIA --}}
      @if(isset($specialtiesCount) and $specialtiesCount != 0)
      <div class="card">
        <div class="card-header">
          Especialidades de la Categoria: {{$category}}
          <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
          @foreach ($specialties as $specialty)
          <div class="float-left p-3">
            {{Form::open(['route'=>'tolist2','method'=>'get'])}}
            {{Form::hidden('search',$specialty->name)}}
            {{Form::hidden('typeSearch2','Especialidad Medica')}}
            <button onclick="geolocation2()" type="submit" class="btn-primary btn-link" style="cursor: pointer"><strong>{{$specialty->name}}</strong></button>
            {{Form::close()}}
          </div>
          @endforeach
        </div>
      </div>
      @endif
      {{-- //FIN PANTALLA ESPECIALIDADES POR CATEGORIA --}}
      @if(isset($medicalCenterCount) and $medicalCenterCount != 0)
      <div class="row">
        <div class="col-12 content-profile">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Centros Médicos</a>
            </li>
            <li class="nav-item">
              <a onclick="show_map2()" class="nav-link" id="profile-tab" data-toggle="tab" href="" role="tab" aria-controls="profile" aria-selected="false">Mapa</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
              <input type="hidden" name="" value="{{$medicalCenterCount}}" id="medicalCenterCount">
              <div class="card-header">
                <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                <input type="hidden" name="" value="{{$distRequest = request()->get('dist')}}">
                <input type="hidden" name="" value="{{$typeSearch = request()->get('typeSearch')}}">
                <input type="hidden" name="" value="{{$requestCity = request()->get('city')}}">
                <input type="hidden" name="" value="{{$requestState = request()->get('state')}}">
                <h4>Busqueda de Centro Medico: {{$search}}</h4>
                <h5>Filtros:</h5>

                @isset($typeSearch)
                <p>Tipo de Busqueda: <strong>{{$typeSearch}}</strong></p>
                @endisset
                @isset($search)
                <p>Nombre: <strong>{{$search}}</strong></p>
                @endisset

                @isset($distRequest)
                <p>Diametro: <strong>{{request()->get('dist')}} Km</strong></p>
                @endisset
                @if(isset($requestCity) and request()->get('city') != 'ciudad')
                <p>Ciudad: <strong>{{request()->get('city')}}</strong></p>
                @endif
                @if(!isset($requestCity) or $requestCity == 'ciudad')
                @isset($requestState)
                <p>Estado: <strong>{{request()->get('state')}}<strong></p>
                @endisset
                @endif
                </div>
                @foreach ($medicalCenter as $mc)
                <hr>
                <div class="row">
                  <div class="col-8 m-auto col-sm-3 col-lg-3">
                    <picture>
                      <source srcset="" type="image/svg+xml">
                        <img src="{{asset('img/botones-medicossi-01.png')}}" class="img-fluid img-thumbnail" alt="...">
                      </picture>
                    </div>
                    <div class="col-12 col-sm-5 col-lg-5">
                     <div class="card-body p-2">
                      <h5 class="card-title title-edit">{{$mc['name']}}</h5>
                      <a href="{{route('medicalCenter.edit',$mc['id'])}}" class="outstanding mr-2">Ver Perfil</a><span></span>
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
                          <a href=""><p class="card-text"><i class="fas fa-map-marker-alt mr-1"></i><b>{{$mc['state']}},{{$mc['city']}}</b> </a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4 col-lg-4 p-4">
                    <div class="form-group">
                      {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
                    </div>
                    <div class="form-group">
                      {{Form::open(['route'=>'tolist2','method'=>'get'])}}
                      {{Form::hidden('typeSearch2','Medicos de la Institucion')}}
                      {{Form::hidden('search',null)}}
                      {{Form::hidden('medicalCenter_id',$mc['id'])}}
                      {{Form::submit('Médicos', ['class' => 'btn btn-primary'])}}

                      {{Form::close()}}


                      {{-- <a href="{{route('medicos_of_the_medical_center',$mc['id'])}}" class="btn-icon"><i class="fas fa-user-md"></i> Ver Profesionales Médicos</a> --}}
                    </div>
                    <div class="form-group">
                     {{-- <a href="" class="btn-icon"><i class="fa fa-phone mr-2"></i>Ver Teléfonos</a> --}}
                   </div>
                 </div>
               </div>
               <hr>
               @endforeach
               <div class="card-footer">
                 {{$medicalCenter->appends(Request::all())->links()}}
               </div>
             </div>


             <div class="tab-pane fade" id="mapa2" role="tabpanel" aria-labelledby="profile-tab">
               <div id="map" class="mb-4 p-4" style="width:600;height:800px;">
               </div>
             </div>
           </div>
         </div>
       </div>
       @elseif(isset($medicalCenterCount) and $medicalCenterCount == 0)

       <div class="card">
        <div class="card-body">
          <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
          <h5>No se Encontraron Resultados para la Busqueda</h5>
          <div class="card-body">

            <input type="hidden" name="" value="{{$distRequest = request()->get('dist')}}">
            <input type="hidden" name="" value="{{$typeSearch = request()->get('typeSearch')}}">
            <input type="hidden" name="" value="{{$requestCity = request()->get('city')}}">
            <input type="hidden" name="" value="{{$requestState = request()->get('state')}}">
            <h4>Busqueda de Centro Medico: {{$search}}</h4>
            <h5>Filtros:</h5>

            @isset($typeSearch)
            <p>Tipo de Busqueda: <strong>{{$typeSearch}}</strong></p>
            @endisset
            @isset($search)
            <p>Nombre: <strong>{{$search}}</strong></p>
            @endisset

            @isset($distRequest)
            <p>Diametro: <strong>{{request()->get('dist')}} Km</strong></p>
            @endisset
            @if(isset($requestCity) and request()->get('city') != 'ciudad')
            <p>Ciudad: <strong>{{request()->get('city')}}</strong></p>
            @endif
            @if(!isset($requestCity) or $requestCity == 'ciudad')
            @isset($requestState)
            <p>Estado: <strong>{{request()->get('state')}}<strong></p>
            @endisset
            @endif
            </div>

          </div>
        </div>
        @endif
        {{-- FIn CENTROS MEDICOS   FIn CENTROS MEDICOS  --}}

        @if(isset($medicosCercCount) and $medicosCercCount != 0)

        <div class="row">
          <div class="col-12 content-profile">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true" onclick="hide_map()">Médicos</a>
              </li>
              <li class="nav-item">

                <a onclick="show_map2()" class="nav-link" id="profile-tab" data-toggle="tab" href="" role="tab" aria-controls="profile" aria-selected="false">Mapa</a>
              </li>

            </ul>


            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
               <input type="hidden" name="" value="{{$medicosCercCount}}" id="medicosCercCount">
               <div class="card-header">
                 <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                 <input type="hidden" name="" value="{{$distRequest = request()->get('dist')}}">
                 <input type="hidden" name="" value="{{$typeSearch = request()->get('typeSearch')}}">
                 <input type="hidden" name="" value="{{$requestCity = request()->get('city')}}" id="cityRequest">
                 <input type="hidden" name="" value="{{$requestState = request()->get('state')}}"id="stateRequest">
                 @isset($typeSearch)
                 <p>Tipo de Busqueda: <strong>{{$typeSearch}}</strong></p>
                 @endisset
                 @isset($search)
                 <p>Nombre: <strong>{{$search}}</strong></p>
                 @endisset
                 @isset($distRequest)
                 <p>Diametro: <strong>{{request()->get('dist')}} Km</strong></p>
                 @endisset
                 @if(isset($requestCity) and request()->get('city') != 'ciudad')
                 <p>Ciudad: <strong>{{request()->get('city')}}</strong></p>
                 @endif
                 @if(!isset($requestCity) or $requestCity == 'ciudad')
                       @isset($requestState)
                       <p>Estado: <strong>{{request()->get('state')}}</strong></p>
                        @endisset
                  @endif
                 </div>
                 <input type="hidden" name="" value="{!!$position = 0!!}">
                 @foreach ($medicosCerc as $medico )
                   <input type="hidden" name="" value="{!!$position = $position + 1!!}">
                 <hr>
                 <div class="row">
                  <div class="col-8 m-auto col-sm-3 col-lg-3">
                    <div class="cont-img">
                      @isset($medico['image'])
                      <img src="{{asset($medico['image'])}}" class="prof-img2 img-thumbnail" alt="..." >
                      @else
                      <img src="{{asset('img/profile.png')}}" class="prof-img2 img-thumbnail" alt="...">
                      @endisset
                    </div>
                  </div>
                  <div class="col-12 col-sm-5 col-lg-5">
                   <div class="card-body p-2">
                    <h5 class="card-title title-edit">{{$medico['name']}} {{$medico['lastName']}}</h5>
                    <p>Cédula: {{$medico['identification']}}</p>
                    <span>Especialidad:</span> <a href="#" class="outstanding mr-2"> {{$medico['specialty']}}</a>
                    <div class="star-profile">
                      <div class="form-inline">
                        Calificación:
                        <span class="ml-2 mr-2">@include('home.star_rate')</span>
           						 @if($medico['calification'] != Null)
           						 	<span> de "{{$medico['votes']}}" voto(s).</span>
           					  	@endif
                      </div>
                      {{-- <button onclick="show_calification(this)" type="button" name="{{$medico['id']}}">test</button>
                      <a href"{{route('list_calification_medico',['medico_id'=>$medico['id']])}}">Opiniones de los usuarios</a> --}}
                    </div>
                    <div class="row mt-3 align-self-end">
                      <div class="col-12">
                        <a href="{{route('detail_medic_map',$medico['id'])}}" class="btn btn-primary btn-sm text-white"><p class="card-text">({{$position}}) - <i class="fas fa-map-marker-alt mr-1"></i><b>{{$medico['state']}},{{$medico['city']}}</b></p></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-4 p-4">
                  <div class="form-group">
                    {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
                    <a class="btn btn-primary" href="{{route('medico.edit',$medico['id'])}}"><i class="fas fa-cogs mr-2"></i>Ver perfíl</a>
                  </div>
                  <div class="form-group">
                  @if ($medico['plan'] != 'plan_profesional' and $medico['plan'] != 'plan_platino')

                    <a href="{{route('stipulate_appointment',$medico['id'])}}" class="btn" style="background:rgb(151, 156, 159);color:white"><i class="fa fa-envelope-open mr-2" ></i>Agendar citas</a>
                  @else
                    @if(Auth::check() and Auth::user()->role == 'Paciente')
                    <a href="{{route('stipulate_appointment',$medico['id'])}}" class="btn btn-info"><i class="fa fa-envelope-open mr-2"></i>Agendar citas</a>
                    @else
                    <button onclick="return verifySession()" class="btn"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</button>
                    @endif
                  @endif
                  </div>

                  <div class="form-group">
                    @if(Auth::check() and Auth::user()->role == 'Paciente')
                    <a onclick="return confirm('¿Esta Segur@ de añadir a este Médico a su lista?')" href="{{route('patient_add_medic',$medico['id'])}}" class="btn btn-secondary"><i class="fas fa-plus mr-2"></i>Agregar a mi Lista</a>
                    @else
                    <button onclick="return verifySession2()" class="btn btn-info"></i>Agregar a mi Lista</button>
                    @endif

                  </div>
                  @isset($medico['dist'])
                  <div class="form-group">
                    <p>Distancia: {{$medico['dist']}}</p>
                  </div>
                  @endisset

                </div>
              </div>
              <hr>
              @endforeach
              <div class="card-footer">
               {{$medicosCerc->appends(Request::all())->links()}}
             </div>
           </div>

           <div class="tab-pane fade" id="mapa2" role="tabpanel" aria-labelledby="profile-tab">
             <div id="map" class="mb-4 p-4" style="width:600;height:800px">

             </div>
           </div>
         </div>
       </div>
     </div>
     @elseif(isset($medicosCercCount) and $medicosCercCount == 0)

     <div class="card">
      <div class="card-body">
        <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
        <h5>No se Encontraron Resultados para la Busqueda</h5>
        <div class="card-body">

          <input type="hidden" name="" value="{{$distRequest = request()->get('dist')}}">
          <input type="hidden" name="" value="{{$typeSearch = request()->get('typeSearch')}}">
          <input type="hidden" name="" value="{{$requestCity = request()->get('city')}}">
          <input type="hidden" name="" value="{{$requestState = request()->get('state')}}">
          <h4>Busqueda Medico: {{$search}}</h4>
          {{-- <h5>Filtros:</h5> --}}

          @isset($typeSearch)
          <p>Tipo de Busqueda: <strong>{{$typeSearch}}</strong></p>
          @endisset
          @isset($search)
          <p>Nombre: <strong>{{$search}}</strong></p>
          @endisset

          @isset($distRequest)
          <p>Diametro: <strong>{{request()->get('dist')}} Km</strong></p>
          @endisset
          @if(isset($requestCity) and request()->get('city') != 'ciudad')
          <p>Ciudad: <strong>{{request()->get('city')}}</strong></p>
          @endif
          @if(!isset($requestCity) or $requestCity == 'ciudad')
          @isset($requestState)
          <p>Estado: <strong>{{request()->get('state')}}<strong></p>
            @endisset
            @endif
          </div>
        </div>
      </div>
      @endif
      {{-- ////////// --}}

      {{-- //map-fin  //map-fin  //map-fin  //map-fin  //map-fin --}}

      @if(!isset($medicosCercCount) and !isset($medicalCenterCount))
      <div class="row my-5">
        <div class="col-6 col-lg">
          <div class="box-img">
            {{Form::open(['route'=>'tolist2','method'=>'get'])}}
            {{Form::hidden('typeSearch','Centro Medico')}}
            <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-01.jpg')}}" alt="" width="100%" class="img-responsive"></button>
            {{Form::close()}}

          </div>
        </div>
        <div class="col-6 col-lg">
          <div class="box-img">
            {{Form::open(['route'=>'specialtyList1','method'=>'post'])}}
            {{Form::hidden('typeSearch','Medicos y Especialistas')}}
            <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-05.jpg')}}" alt="" width="100%" class="img-responsive"></button>
            {{Form::close()}}
          </div>
        </div>
        <div class="col-6 col-lg">
          <div class="box-img">
            {{Form::open(['route'=>'specialtyList2','method'=>'post'])}}
            {{Form::hidden('typeSearch','Dentistas')}}
            <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-03.jpg')}}" alt="" width="100%" class="img-responsive"></button>
            {{Form::close()}}
          </div>
        </div>
        <div class="col-6 col-lg">
          <div class="box-img">
            {{Form::open(['route'=>'specialtyList3','method'=>'post'])}}
            {{Form::hidden('typeSearch','Terapeutas y Nutricion')}}
            <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-10.jpg')}}" alt="" width="100%" class="img-responsive"></button>
            {{Form::close()}}
          </div>
        </div>
        <div class="col-6 col-lg">
          <div class="box-img">
            {{Form::open(['route'=>'specialtyList4','method'=>'post'])}}
            {{Form::hidden('typeSearch','Medicina Alternativa')}}
            <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-11.jpg')}}" alt="" width="100%" class="img-responsive"></button>
            {{Form::close()}}

          </div>
        </div>
      </div>
      @endif

    </div>
    {{-- // --}}
  </div>
  <div class="row mt-3">
  </div>
  <!-- Modal Login-->
  <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="alert alert-warning" role="alert" id="alert" style="display:none;margin:10px; ">

          <button type="button" class="close" onclick="$(this).parent().hide()"><span aria-hidden="true">&times;</span></button>
          <div id="text-alert">
          </div>
        </div>
        <div class="alert alert-success" role="alert" id="alert-success-confirm" style="display:none;margin:10px; ">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div >
            <h5>Bienvenid@</h5>
            <p id="text-success-confirm"></p>
          </div>
        </div>
        <div class="modal-header text-white" style="background:rgb(93, 152, 230)">

          <h5 class="modal-title" id="exampleModalLongTitle">Ingresar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <img width="100%" height="100%" src="{{asset('img/Medicossi-Marca original-01.png')}}">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <a href="#" class="btn btn-config-blue btn-block" style="background-color: #4267b2;">Conectarse con facebook</a>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12">
              <div class="form-group">
                <input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" placeholder="email" name="email">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <input type="password" class="form-control" id="passwordLogin" aria-describedby="emailHelp" placeholder="password" name="password">
              </div>
            </div>
            {{Form::hidden('solicitud_cita',null,['id'=>'solicitud_cita'])}}
            <div class="col-12">
              <div class="form-group">
                <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                  <input type="checkbox" class="custom-control-input">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Recordar contraseña</span>
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button class="btn btn-config-blue btn-block" onclick="login()">Iniciar sesión</button>
            </div>
            <div class="col-12">
              <a href="{{route('restore_pass')}}" class=" btn btn-config-green btn-block mt-2">Olvido su contraseña</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal-verify-patient -->
  <div class="modal fade" id="modal_verify_patient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="text_modal"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <p>Crear una cuenta para Pacientes</p>
              <a href="{{route('patient_register_view')}}" class="btn btn-success">Crear Cuenta</a>
            </div>
            <div class="col-6">
              <p>¿Ya tienes cuenta de Pacientes?</p>
              <button id="call_modal_login" type="button" name="button" class="btn btn-primary" >Iniciar Session</button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>


  @isset($currentPage)
  <input type="hidden" name="" value="{{$currentPage}}" id="numberPageNow">
  @endisset
  @isset($specialtiesCount)
  <input type="hidden" name="" value="{{$specialtiesCount}}" id="specialtiesCount">
  @endisset
  @isset($typeSearch2)
  <input type="hidden" name="" value="{{$typeSearch2 = request()->get('typeSearch2')}}" id="typeSearch2">
  @endisset
  @isset($typeSearch2)
  <input type="hidden" name="" value="{{$medicalCenter_id = request()->get('medicalCenter_id')}}" id="medicalCenter_id">
  @endisset
  {{-- @isset(request()->get('typeSearch'))
  <input type="hidden" name="" value="{{$typeSearch = request()->get('typeSearch')}}" id="typeSearch2">
  @endisset --}}
  @include('home.modals')

  @section('scriptJS')
  @if(Session::Has('confirmMedico'))


  <script type="text/javascript">

    $(document).ready(function(){
      $('#modal-login').modal('show');

      $('#text-success-confirm').html('Su Cuenta ha sido Confirmada con exito, ya es posible iniciar sesión con sus Credenciales');
      $('#alert-success-confirm').fadeIn();
    });
  </script>
  @endif

  {{-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY&callback=initMap"></script> --}}
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>
  <script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>

  {{-- <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> --}}
  <script src="{{asset('jqueryui/jquery-ui.js')}}"></script>

  <script type="text/javascript">

  function cerrar_a(result){
    $(result).parent().hide();

  }

  $(function()
  {
    $("#search").autocomplete({
      source: "{{route('autocomplete_specialty')}}",
      minLength: 2,
      select: function(event, ui) {
        $('#q').val(ui.item.value);
      }
    });
  });


    $("#typeSearch").change(function() {
        if($("#typeSearch").val() == 'Especialidad Medica'){
          $("#panel").slideUp(200);
        }

    });

    function distancia(){
      $("#stateMedic").val('');
      $("#cityMedic").val('');
      $("#div_distancia").show();
      $("#div_ubicacion").hide();
      $("#btn-ubicacion").prop('disabled',false);
      $("#btn-distancia").prop('disabled',true);
    }



    function ubicacion(){
      $("#div_distancia").hide();
      $("#div_ubicacion").show();
      $("#dist").val('');
      $("#btn-ubicacion").prop('disabled',true);
      $("#btn-distancia").prop('disabled',false);
    }
    $(document).ready(function(){

      if($('#search').val().length > 0){
        $("#panel").slideToggle(200);
      }

      // if($('#stateRequest').(length > 0){
      //   $("#state").val($('#stateRequest').val());
      //
      // }
      //
      // if($('#cityRequest').length > 0){
      //   $("#city").val($('#stateRequest').val());
      // }


    });

        typeSearch2 =$('#typeSearch2').val();

        if(typeof typeSearch2 !== "undefined"){
          $('#typeSearch').val('Especialidad Medica');
        }
        specialtiesCount = $('#specialtiesCount').val();
        if(typeof specialtiesCount !== "undefined"){
          $('#typeSearch').val('Especialidad Medica');
        }
        medicosCercCount = $('#medicosCercCount').val();


          function login(){
            route = "{{route('login2')}}";
            email = $('#emailLogin').val();
            password = $('#passwordLogin').val();
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type:'post',
              url: route,
              data:{email:email,password:password},
              success:function(result){
                if(result == 'true'){
                  //location.reload();
                  window.location.href = '{{route("loginRedirect")}}';
                }else{
                  $('#text-alert').html('Email o Contraseña Invalida');
                  $('#alert').fadeOut();
                  $('#alert').fadeIn();
                }
              },
              error:function(result){
                errores ='';
                $.each(result.responseJSON.errors, function( index, value ) {
                  errores += '<li>'+value+'</li>';
                });
                console.log(errores);
                $('#text-alert').html('<ul>'+errores+'</ul>');
                $('#alert').fadeIn();
              // $error += '<li>result.message</li>';
              //  console.log(result.message);
            }
          });
          }

        //Esto me permitio MOSTRAR EL MAPA DIRECTAMENTE EN LA EPSTAÑA
        function hide_map(){
          $("#map").hide();

        }

        function show_map2(){

          $('.tab-content div.active').removeClass('active');
          $('#mapa2').tab('show');
          $("#map").show();
          map();
        }


        //UBICA LOS PUNTOS EN EL MAPA  //UBICA LOS PUNTOS EN EL MAPA


        function map(){

          search = $('#search').val();
          typeSearch = $('#typeSearch').val();
          typeSearch2 = $('#typeSearch2').val();
          medicalCenter_id = $('#medicalCenter_id').val();
          lat = $('#lat').val();
          lng = $('#lng').val();
          city = $('#cityRequest').val();
          state = $('#stateRequest').val();
          dist = $('#dist').val();
          numberPageNow = $('#numberPageNow').val();
          filter_ranking = $('#filter_ranking').val();
          route = "{{route('ajax_map')}}";
          var number = 0;

          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url: route,
            data:{search:search,typeSearch:typeSearch,typeSearch2:typeSearch2,lat:lat,lng:lng,city:city,state:state,dist:dist,numberPageNow:numberPageNow,medicalCenter_id:medicalCenter_id,filter_ranking:filter_ranking},
            success:function(result){
              console.log(result);

              var map = new GMaps({
                el: '#map',
                lat: lat,
                lng: lng,
                zoom: 5,
              });

              map.addMarker({
                lat: lat,
                lng: lng,
                title: 'Tu',
                  //icon: "{{asset('img/marker-icon.png')}}",
                  draggable: true,
                  dragend: function(event) {
                   var lat = event.latLng.lat();
                   var lng = event.latLng.lng();
                 },
              });//fin marker
              $.each(result, function(index,value){

                number = number + 1;
                if(number == 1){
                  icon = "{{asset('img/markers/marker_green1.png')}}";

                }else if(number == 2){
                  icon = "{{asset('img/markers/marker_green2.png')}}";
                }else if(number == 3){
                  icon = "{{asset('img/markers/marker_green3.png')}}";
                }else if(number == 4){
                  icon = "{{asset('img/markers/marker_green4.png')}}";
                }else if(number == 5){
                  icon = "{{asset('img/markers/marker_green5.png')}}";
                }else if(number == 6){
                  icon = "{{asset('img/markers/marker_green6.png')}}";
                }else if(number == 7){
                  icon = "{{asset('img/markers/marker_green7.png')}}";
                }else if(number == 8){
                  icon = "{{asset('img/markers/marker_green8.png')}}";
                }else if(number == 9){
                  icon = "{{asset('img/markers/marker_green9.png')}}";
                }else if(number == 10){
                  icon = "{{asset('img/markers/marker_green10.png')}}";
                }
                if(value.lastName == 'undefined'){
                  map.addMarker({
                    lat: value.latitud,
                    lng: value.longitud,
                    title: value.name,
                    icon: icon,
                    infoWindow : {content :'<p>'+value.name+'</p>'}

                });//fin marker
              }else{
                map.addMarker({
                  lat: value.latitud,
                  lng: value.longitud,
                  title: value.name,
                  icon: icon,
                  infoWindow : {content :'<p>'+value.name+' '+value.lastName+'</p>'}

              });//fin mark
              }


              });
            },//fin success

            error:function(error){
              console.log(error);
            },
          });
        }




        $('#stateMedic').on('change', function() {
         state_id = $('#stateMedic').val();
         $('#dist').val(null);
         route = "{{route('inner_cities_select3')}}";

         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:'post',
          url: route,
          data:{name:state_id},
          success:function(result){
            //  console.log(result);
            $("#cityMedic").empty();
            $('#cityMedic').append($('<option>', {
             value: null,
             text: 'ciudad'
           }));
            $.each(result,function(key, val){
              $('#cityMedic').append($('<option>', {
                value: val,
                text: val
              }));
            });
          },
          error:function(error){
           console.log(error);
         },
       });
       })

         //selec dist unselect city and state
         $('#dist').on('change', function() {

           $('#stateMedic').val(null);
           $('#cityMedic').val(null);
         });

         $('#cityMedic').on('change', function() {
           $('#dist').val(null);
         });



         function enviarForm(result){
          $('typeSearch').val(result);

        }

         // function geolocation(){
         //   if (!navigator.geolocation){
         //     alert('La Geolocalozación no es compatible con en este navegador');
         //     return;
         //   }
         //
         //   function success(position) {
         //     latitude = position.coords.latitude;
         //     $('#lat').val(latitude);
         //
         //
         //
         //     longitude = position.coords.longitude;
         //     $('#lng').val(longitude);
         //
         //   };
         //
         //   function error() {
         //     alert("Error, hubo un problema al recuperar su ubicación, por favor recargue la pagina e intente nuevamente");
         //   };
         //   navigator.geolocation.getCurrentPosition(success, error);
         // }


         GMaps.geolocate({
           success: function(position) {
             $('#lat').val(position.coords.latitude);
             $('#lng').val(position.coords.longitude);
             vari = $('#lat').val();

           },
           error: function(error) {
             alert('Geolocation failed: '+error.message);

           },
           not_supported: function() {
             alert("Your browser does not support geolocation");
           },
           // always: function() {
           //
           // }
         });


         function verifySession(){
           route = "{{route('verifySession')}}";

           $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type:'post',
             url: route,
             // data:{verifySession:verifySession},
             success:function(result){
               if(result == 'session_of'){
                 $("#text_modal").html('Debes Iniciar Session como paciente para poder agendar Citas');
                 $('#modal_verify_patient').modal('show');
                 return;
                 // $('#text-alert').html('Debes Iniciar session como Paciente para poder agendar cita.');
                 // $('#alert').fadeIn();
               }else if(result == 'no_patient'){
                 $("#text_modal").html('Debes Iniciar Session como paciente para poder agendar Citas');
                 $('#modal_verify_patient').modal('show');
                 return;
               }
             },
             error:function(result){
               console.log(result);
             }
           });
         }

         function verifySession2(){
           route = "{{route('verifySession')}}";

           $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type:'post',
             url: route,
             // data:{verifySession:verifySession},
             success:function(result){
               if(result == 'session_of'){
                 $("#text_modal").html('Debes Iniciar Session como paciente para poder agregar médicos a tu cuenta.');
                 $('#modal_verify_patient').modal('show');
                 return;
                 // $('#text-alert').html('Debes Iniciar session como Paciente para poder agendar cita.');
                 // $('#alert').fadeIn();
               }else if(result == 'no_patient'){
                 $('#modal_verify_patient').modal('show');
                 return;
               }
             },
             error:function(result){
               console.log(result);
             }
           });
         }

         $('#call_modal_login').click(function(){
           $('#modal_verify_patient').modal('hide');
           $('#modal-login').modal('show');
         });


       </script>

       @endsection

       @endsection
