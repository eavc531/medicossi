 @extends('layouts.app')
 @section('css')
 <link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
 @endsection
@section('content')

<div class="row">
  <div class="col-12">
    <h2 class="font-title text-center" id="title">Perfil Profesional Médico</h2>
  </div>
</div>
@if (Auth::check() and Auth::user()->role == 'medico' and Auth::user()->medico_id == $medico->id)

@else
    <div class="text-right">
        <button onclick="window.history.back();" type="button" name="button" class="btn btn-secondary">Volver</button>
    </div>
@endif

@if(Session::Has('successComplete'))
<div class="div-alert" style="padding:20px; max-width: 100%;">
 <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div class="row mt-4">
   <div class="col-12 mb-3">
    {{-- <h5 class="text-center font-title">Ya eres miembro de la mejor red de médicos y profesionales de la salud</h5> --}}
  </div>
</div>
<h5>Registro Completado. Le invitamos a completar de forma (opcional),los datos de su perfil, para poder brindar la mayor información a sus clientes. </h5>
</div>
</div>
@endif

<div class="col-12">
  <h4 class="font-title-blue">Datos del Profesional: {{$medico->name}} {{$medico->lastName}}</h4>
</div>
{{-- <p>La información que se registra en su cuenta,le permite ser ubicado con mayor facilidad por sus clientes a travez del sistema, ademas le permite brindar, una mejor descripción de su profesión.</p> --}}
<section class="box-register">
  <div class="container">
   <div class="register">

    <div class="row mt-3">
     <div class="col-lg-6 col-12">

      @isset($photo->path)
      <div class="cont-img my-2">
        <img src="{{asset($photo->path)}}" class="prof-img" alt="" id="img">
      </div>
      @else
      <div class="cont-img my-2">
        <img src="{{asset('img/profile.png')}}" class="prof-img" alt="" id="img">
      </div>
      @endisset

      {!!Form::open(['route'=>'photo.store','method'=>'POST','files'=>true])!!}
      {!!Form::hidden('email',$medico->email)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      {!!Form::file('image')!!}
      {!!Form::submit('Subir')!!}
      {!!Form::close()!!}
    </div>
    @if(Auth::check() and Auth::user()->role == 'medico' and Auth::user()->medico_id == $medico->id)
    <div class="col-lg-6">
      <h3>Calificación:</h3>
      <span class="">@include('home.star_rate')</span>
      <h3><span> de "{{$medico['votes']}}" voto(s).</span></h3>
      @if($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
      <div class="">
        <h4>
          <a href="{{route('calification_medic',['id'=>\Hashids::encode($medico->id),'back'=>\Request::route()->getName()])}}" class="btn btn-primary mt-2">Calificaciones y Comentarios</a>
        </h4>
        {{-- <p style="color:rgb(156, 141, 146)">Sección Disponible para los planes Profesional o Platino</p> --}}
      </div>

      @else
      <div class="">
        <h4>
          <a href="" class="btn btn-primary mt-2 disabled">Opinion de los Usuarios</a>
        </h4>
        <p style="color:rgb(156, 141, 146)">Sección Disponible para los planes Profesional o Platino</p>
      </div>
      @endif
    </div>
@else
    <div class="col-lg-6 text-center">
      <h3>Calificación:</h3>
      <span class="">@include('home.star_rate')</span>
      <h3><span> de "{{$medico['votes']}}" voto(s).</span></h3>
      <div class="">
        <h4>

            <button onclick="show_califications()" type="button" name="button" class="btn btn-success btn-block">Calificaciones y Comentarios</button>

        </h4>
      </div>

      <div class="form-group mt-5">

      @if ($medico['plan'] != 'plan_profesional' and $medico['plan'] != 'plan_platino')

        <a href="{{route('stipulate_appointment',$medico['id'])}}" class="btn btn-block btn-lg disabled" style="background:rgb(151, 156, 159);color:white"><i class="fa fa-envelope-open mr-2" ></i>Agendar cita</a>

      @else
        @if(Auth::check() and Auth::user()->role == 'Paciente')
            @if(request()->get('search') != Null)
                <a href="{{route('stipulate_appointment',[\Hashids::encode($medico['id']),'search'=>Request::fullUrl()])}}" class="btn btn-info btn-block btn-lg"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</a>

            @else
                <a href="{{route('stipulate_appointment',\Hashids::encode($medico['id']))}}" class="btn btn-info btn-block btn-lg"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</a>
            @endisset

        @else
        <button onclick="verifySession()" class="btn btn-block btn-lg"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</button>
        @endif
      @endif
      </div>
    </div>
    @endif

  </div>
  <hr>

  <div class="m-2">
    <div class="row my-2">
      <div class="col-12">
        <h4 class="font-title-blue text-center">Datos personales:</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <ul>
          <li><b>Nombres</b>:&nbsp;{{$medico->name}}</li>
          <li><b>Apellidos</b>:&nbsp;{{$medico->lastName}}</li>
          <li><b>Cedula</b>:&nbsp;{{$medico->identification}}</li>
          <li><b>Sexo</b>:&nbsp;{{$medico->gender}}</li>

        </ul>
      </div>
      <div class="col-6">
        <ul>
          <li><b>Especialidad:&nbsp;</b>{{$medico->specialty}}</li>
          @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
            @if ($medico->showNumber == 'si')
            <li><b>Teléfono celular</b>: {{$medico->phone}}</li>
            @endif
          @endif

          @if ($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
            @if ($medico->showNumberOffice == 'si' and $medico->phoneOffice1 != Null)
            <li><b>Telefono de oficina 1:</b>{{$medico->phoneOffice1}}</li>
            @endif
            @if ($medico->showNumberOffice == 'si' and $medico->phoneOffice2 != Null)
            <li><b>Telefono de oficina 2:</b>{{$medico->phoneOffice2}}</li>
            @endif
          @endif

          @if($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
            <li><b>Mostrar Numero Personal:&nbsp;</b><span style="color:rgb(215, 141, 15)">{{$medico->showNumber}}</span></li>
            <li><b>Mostrar Numeros de oficina:&nbsp;</b><span style="color:rgb(215,141,15)">{{$medico->showNumberOffice}}</span></li>
          @else
            <li><b>Mostrar Numero Personal:&nbsp;</b><span style="color:rgb(215, 141, 15)">No</span></li>
            <li><b>Mostrar Numeros de oficina:&nbsp;</b><span style="color:rgb(215,141,15)">No</span></li>
          @endif
        </ul>
        <a href="{{route('data_primordial_medico',\Hashids::encode($medico->id))}}" class="btn btn-block btn-success">Editar</a>
      </div>
    </div>
  </div>
  <hr>
  <div class="row mt-3">
    <div class="col-12">
     <h4 class="font-title-blue text-center">Redes sociales</h4>

     <hr>
   </div>
 </div>
 @if(Auth::check() and Auth::user()->role == 'medico' and Auth::user()->medico->plan != 'plan_profesional' and Auth::user()->medico->plan != 'plan_platino')
 <div class="text-center">
  <p style="color:rgb(156, 141, 146)">Sección Disponible para los planes Profesional o Platino</p>
</div>
@endif
<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-3 col-12">
        <div class="form-group">
          @if(Auth::check() and Auth::user()->role == 'medico')
            @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
              {!!Form::select('name',['Facebook'=>'Facebook','Twiter'=>'Twiter','Instagram'=>'Instagram'],null,['class'=>'form-control','placeholder'=>'Red Social','id'=>'name_social'])!!}
              @else
              {!!Form::select('name',['Facebook'=>'Facebook','Twiter'=>'Twiter','Instagram'=>'Instagram'],null,['class'=>'form-control','placeholder'=>'Red Social','id'=>'name_social','disabled'])!!}
            @endif

          @endif
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="form-group">
          @if(Auth::check() and Auth::user()->role == 'medico')
            @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
              {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Dirección Url del perfil de su Red Social','id'=>'link_social'])!!}
              {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
              @else
                {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Dirección Url del perfil de su Red Social','id'=>'link_social','disabled'])!!}
                {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
            @endif
          @endif

        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="form-group">
          @if(Auth::check() and Auth::user()->role == 'medico')
            @if(Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
            <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button>
            @else
            <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success" disabled>Agregar</button>
            @endif
          @endif
        </div>
      </div>
      {{-- alert error  --}}
      <div class="col-12">
        <div id="alert_error_s" class="alert alert-warning  alert-dismissible fade show" role="alert" style="display:none">
          <button type="button" name="button" class="close" onclick="cerrar_alert()">x</button>
          <p id="text_error_s"></p>
        </div>
      </div>
      {{-- {!! $errors->first('name','<span class="help-block">:message</span>') !!} --}}
    </div>
    {{-- BOTONES QUE SE MUESTRAN CON AJAX DESDE LISTA-Social --}}
    @if($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
    <div id="list_social_ajax">
    </div>
    @else
      <div class="">
        <div class="">
          <p class="text-center">Sin Direcciones de Redes Sociales que Mostrar</p>

        </div>
      </div>
    @endif
  </div>
</div>
<hr>


<div class="row my-4">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Dirección de Trabajo Principal</h4>
  </div>
</div>
<div class="row text-left">
  <div class="col-6">
    <ul>
      <li><strong>Nombre Comercial del Consultorio:</strong> @if($medico->name_comercial != Null){{$medico->name_comercial}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
      <li><strong>Tipo de Consultorio:</strong> @if($medico->type_consulting_room != Null){{$medico->type_consulting_room}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
      <li><strong>Clave unica:</strong> @if($medico->password_unique != Null) {{$medico->password_unique}} @else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
      <li><strong>Pais:</strong> {{$medico->country}}</li>
      <li><strong>Estado:</strong> {{$medico->state}}</li>
    </ul>
  </div>
  <div class="col-6">
    <ul>
      <li><strong>Ciudad:</strong> {{$medico->city}}</li>
      <li><strong>Codigo POSTal:</strong> {{$medico->POSTal_code}}</li>
      <li><strong>Colonia:</strong>
        {{$medico->colony}}
      </li>
      <li><strong>Calle/av:</strong>{{$medico->street}}</li>
      <li><strong>Numero Externo:</strong> {{$medico->number_ext}}</li>
      <li><strong>Numero Interno:</strong> {{$medico->number_int}}</li>
    </ul>
  </div>
</div>
<div class="row">
  <div class="col-6">
    @if($consulting_room->first() == Null)
      <a class="btn btn-primary btn-block"href="{{route('consulting_room_create',\Hashids::encode($medico->id))}}">Agregar Consultorio</a>
    @endif
  </div>
  <div class="col-6">
    <a class="btn btn-success btn-block"href="{{route('medico_edit_address',\Hashids::encode($medico->id))}}">Editar</a>
  </div>
</div>
@if($consulting_room->first() != Null)
<hr>
<div class="row my-4">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Otros Consultorios</h4>
  </div>
</div>
<div class="" style="max-height:500px;overflow:scroll;overflow-x:hidden;">
@foreach ($consulting_room as $value)
  <div class="card mt-2" style="border-radius:15px">
    <div class="card-body">
      <div class="row text-left">
        <div class="col-6">
          <ul>
            <li><strong>Nombre Comercial del Consultorio:</strong> @if($value->name != Null){{$value->name}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
            <li><strong>Tipo de Consultorio:</strong> @if($value->type != Null){{$value->type}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
            <li><strong>Clave unica:</strong> @if($value->passwordUnique != Null) {{$value->passwordUnique}} @else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
            <li><strong>Pais:</strong> {{$medico->country}}</li>
            <li><strong>Estado:</strong> {{$value->state}}</li>
          </ul>
        </div>
        <div class="col-6">
          <ul>
            <li><strong>Ciudad:</strong> {{$value->city}}</li>
            <li><strong>Codigo POSTal:</strong> @if($value->POSTal_code != Null){{$value->POSTal_code}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
            <li><strong>Colonia:</strong>
              {{$value->colony}}
            </li>
            <li><strong>Calle/av:</strong>{{$value->street}}</li>
            <li><strong>Numero Externo:</strong> @if($value->numberExt != Null){{$value->numberExt}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>
              <li><strong>Numero Interno:</strong> @if($value->numberInt != Null){{$value->numberInt}}@else <span style="color:rgb(187, 187, 187)">No especifica</span> @endif</li>

          </ul>
        </div>
        <div class="col-6">

        </div>
        <div class="col-6 text-right">
          <a href="{{route('consulting_room_edit',\Hashids::encode($value->id))}}" class="btn btn-primary"><i class="far fa-edit"></i></a>
          <a href="{{route('consulting_room_delete',\Hashids::encode($value->id))}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
        </div>
      </div>
    </div>

  </div>

@endforeach
</div>
<div class="row">
  <div class="col-6">

  </div>
  <div class="col-6">
  <a class="btn btn-success btn-block mt-3"href="{{route('consulting_room_create',\Hashids::encode($medico->id))}}">Agregar Consultorio</a>
  </div>
</div>
@endif
<hr>
{{-- section mapa --}}
<div class="row my-4">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Ubicacion en el mapa</h4>
  </div>

  <!-- Button trigger modal -->



</div>
<div class="m-2">
  <div class="form-inline">
   <input type="text" name="" value="" class="form-control" id="address">
   <button onclick="searchInMap()" type="button" class="btn btn-primary" name="button">Buscar</button>
   <button type="button" class="btn btn-info ml-auto" data-toggle="modal" data-target="#exampleModal222">
     Ayuda
   </button>
   @include('medico.includes_perfil.modals')
 </div>

</div>
<div class="mt-3">
  {{-- //div que muestra el mapa --}}
  <div class="m-1" id="map" style="height:300px;width:auto">

  </div>
  <button id="store_coordinates" type="button" name="button" class="btn btn-primary" onclick="store_coordinates()" disabled>Guardar Ubicacion</button>
  <button type="button" name="button"  class="btn btn-secondary" onclick="show_map()">Restablecer Marcador</button>
  <input type="hidden" name="latitudSave" value="" id="latitudSave">
  <input type="hidden" name="longitudSave" value="" id="longitudSave">
</div>
</div>

 <hr>
 <div class="row mt-3">
   <div class="col-12">
     <h4 class="font-title-blue text-center">Especialidad/Estudios Realizados</h4>
     <hr>

   </div>
 </div>
 <div class="" style="max-height:500px;overflow:scroll;overflow-x:hidden;">


 @foreach ($medico_specialty as $info)
   <div class="card mt-2">
     <div class="card-body">
       <div class="row">
         <div class="col-6">
           <li><strong class="text-primary">Especialidad:</strong> {{$info->specialty}}</li>
           <li><strong>Tipo:</strong> {{$info->type}}</li>
           <li><strong>Institución:</strong> {{$info->institution}}</li>
           <li><strong>Desde:</strong> {{\Carbon\Carbon::parse($info->from)->format('m-d-Y')}}</li>
         </div>
         <div class="col-6">
           <li><strong>Hasta:</strong> {{\Carbon\Carbon::parse($info->until)->format('m-d-Y')}}</li>
           <li><strong>Estado del estudio:</strong>{{$info->state}}</li>
           <li><strong>información Adicional:</strong> @isset($info->aditional)
           {{$info->aditional}}
           @else
           <span style="color:rgb(173, 173, 173)">No especifica</span>
           @endisset </li>
           <div class="text-right">
             <a href="{{route('medico_specialty_edit',\Hashids::encode($info->id))}}" class="btn btn-primary"><i class="far fa-edit"></i></a>
             <a href="{{route('medico_specialty_delete',\Hashids::encode($info->id))}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
           </div>


         </div>
       </div>
     </div>

   </div>


 @endforeach
 </div>



 <div class="row">
   <div class="col-12 text-right mt-3">
     <a href="{{route('medico_specialty_create',\Hashids::encode($medico->id))}}" class="btn btn-success">Agregar Especialidad/Estudios Realizados</a>
   </div>
 </div>
 <hr>
 <div class="row">
  <div class="col-12 mb-1">
   <h4 class="font-title-blue text-center">Servicios otorgados</h4>

 </div>
</div>

<div id="list_service_ajax">
</div>

<div class="row my-3">
  <div class="col-12 text-right">
   <button onclick="modal_service2()" class="btn btn-success">Agregar servicio</button>
   <hr>
 </div>
</div>
<div class="roww">
  <div class="col-12">
    <h4 class="font-title-blue text-center mb-3">Experiencia en transtornos o enfermedades</h4>
  </div>
</div>
<div id="medico_experience_ajax" style="text-align:justify">

</div>
<div class="row my-3">
  <div class="col-lg-12 col-12 text-right">
    <div class="form-group">
      <button onclick="modal_experience()" type="button" href="" class="btn btn-success">Agregar Experiencia</button>
    </div>
  </div>
</div>

<hr>
<div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Imagenes</h4>
 </div>
</div>
<div class="text-right">
  <div class="row">
    <div class="col-12">
     <div class="form-group">

       <div class="row mt-5" id="">
         @foreach ($images as $image)
  			 {{-- div que encierra cada imagen --}}

  			 <div class="col-4 card">
  				 <div class="card-body">
  					 <img onclick="expandir(this)" id="myImg" src="{{asset($image->path)}}" width="auto" height="150px" alt="">

  				 </div>
  				 <div class="card-footer text-center">
  				 	<p>{{$image->name}}</p>
  				 </div>
  			 </div>
  			 <!-- The Modal -->
  			 <div id="myModal-img" class="modal-img">
  				 <span class="cerrar">&times;</span>
  				 <img class="modal-content-img" id="img01">
  				 <div id="caption"></div>
  			 </div>
  			 @endforeach
      </div>
      <hr>

    </div>
  </div>
  </div>
  <a href="{{'add_image',\Hashids::encode($medico->id)}}" class="btn btn-success">Agregar/Eliminar Imagenes</a>

</div>
{{-- //videos --}}
<hr>
<div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Videos</h4>
 </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-3 col-12">
        {!!Form::open(['route'=>'video_store','method'=>'POST','id'=>'form_video'])!!}
        <div class="form-group">
          {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del video','id'=>'name_video'])!!}
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="form-group">
          {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Url del video de youtube ejemplo: https://www.youtube.com/watch?v=Xwm5xoGo','id'=>'link_social'])!!}
          {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="form-group">
          {{-- <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button> --}}
          <button type="submit" name="button" class="btn btn-block btn-success">Agregar</button>
        </div>
      </div>
      {!!Form::close()!!}
      {{-- alert error  --}}

    </div>
  </div>
</div>
<div id="alert_error_video" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
  <button type="button" name="button" class="close" onclick="cerrar()">x</button>
  <p id="text_error_video"></p>
</div>
<div class="row mt-5" id="list_videos">

</div>

<hr>
<div class="row mt-3">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Aseguradoras</h4>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-12 my-3">
   <label><b>Clasificación de servicios profesionales otorgados</b></label>
 </div>
</div>

<div class="row my-3">
  <div class="col-lg-9 col-12 m-auto">
    <div class="custom-control custom-radio">
      {{-- {{Form::radio('type_patient_service','Solo pacientes privados',['class'=>'custom-control-input','id'=>'radio'])}} --}}

      @if($medico->type_patient_service == "Solo pacientes privados")
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="solo medicos privados" checked="checked" id="radio" onclick="select_insurrances('Solo pacientes privados')">
      @else
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="Solo pacientes privados" id="radio" onclick="select_insurrances('Solo pacientes privados')">
      @endif
      <label class="" for="show-question1" id="radio"  >Solo pacientes privados</label>
    </div>

    <div class="custom-control custom-radio">

      @if($medico->type_patient_service == "solo pacientes de aseguradoras")

      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="solo pacientes de aseguradora" checked="checked" id="radio2" onclick="select_insurrances('solo pacientes de aseguradoras')">
      @else
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="solo pacientes de aseguradora" id="radio2" onclick="select_insurrances('solo pacientes de aseguradoras')">
      @endif
      <label class="" for="show-question1" id="radioxxx" >solo pacientes de aseguradoras</label>
      <label class="" for="show-question2"></label>
    </div>

    <div class="custom-control custom-radio">

      @if($medico->type_patient_service == "Pacientes por aseguradoras, convenios y privados")

      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="Pacientes por aseguradoras, convenios y privados" checked="checked" id="radio2" onclick="select_insurrances('Pacientes por aseguradoras, convenios y privados')">
      @else
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="Pacientes por aseguradoras, convenios y privados" id="radio2" onclick="select_insurrances('Pacientes por aseguradoras, convenios y privados')">
      @endif
      <label class="" for="show-question1" id="radio">Pacientes por aseguradoras, convenios y privados</label>
      <label class="" for="show-question2"></label>
    </div>

    {{-- <div class= "p-3 mt-3" id="panel-insurance" style="display:none;">
      <a href="{{route('create_add_insurrances',\Hashids::encode($medico->id))}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
    </div> --}}
    @if($medico->type_patient_service == "Solo pacientes privados")
        <div class="aseguradoras" id="aseguradoras" style="display:none">
    @else
        <div class="aseguradoras" id="aseguradoras">
    @endif

      <div class="card">
        <div class="card-body">
            <div class="text-center my-3">
                <h5 class="font-title-blue">Aseguradoras</h5>
            </div>
          <div class="row">
            @foreach ($insurance_carrier as $key => $value)
            <div class="col-6">
              <li>{{$value->name}}</li>
            </div>
            @endforeach
          </div>
          <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6 mt-2">
              <a href="{{route('medico_create_add_insurrances',\Hashids::encode($medico->id))}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="row my-2">
  <div class="col-12 text-center">
    <a href="#title" class="btn btn-primary">Ir a Inicio de Pagina</a>

  </div>
</div>
</section>


{{-- //////////////////Modals///////////////////////////////////////MODALS//////////////// --}}
<!-- Modal insurance-->
<div class="modal fade" id="modal-insurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header col-12">
        <h4 class="modal-title font-title text-center" id="exampleModalLabel">Agregar una aseguradora</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal add experience-->
<div class="modal fade" id="modal-experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_experience" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_experience"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agrega el nombre del trastorno o enfermedad, en la que tengas mas experiencia.</h4>
     </div>

     <div class="col-12 mt-3">
      {!!Form::text('name',null,['class'=>'form-control','id'=>'name_experience'])!!}
      {!!Form::hidden('medico_id',$medico->id,['class'=>'form-control','id'=>'medico_id'])!!}
    </div>

  </div>
  <div class="row mt-3">
    <div class="col-12">

      <button onclick="service_medico_experience()" name="button" class="btn btn-block btn-primary">Agregar</button>
    </div>
  </div>
</div>
</div>
</div>
</div>

<!-- Modal add service-->
<div class="modal fade" id="modal-service2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_service" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_service"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agregar Servicio o Terapia que atiendas</h4>
     </div>

     <div class="col-12 mt-3">


       {!!Form::text('name',null,['class'=>'form-control','id'=>'input_service'])!!}
       {!!Form::hidden('medico_id',$medico->id,['class'=>'form-control','id'=>'medico_id'])!!}

     </div>

   </div>
   <div class="row mt-3">
    <div class="col-12">

     <button onclick="service_medico_store()" name="button" class="btn btn-block btn-primary">Agregar</button>
   </div>
 </div>
</div>
</div>
</div>
</div>


<!-- Modal calification-->
<div class="modal fade" id="modal-calification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="" id="content_calification">
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-secondary" type="button" name="button" onclick="cerrar_calificaciones()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MODAL vierify session --}}

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
            <a href="{{route('inicar_home')}}" class="btn btn-primary">Iniciar Session</a>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
{{-- FIN MODAL vierify session --}}

<input type="hidden" name="medico_id_id" value="{{$medico->id}}" id="medico_id_id">
<input type="hidden" name="calification_medic_show_patient" value="{{route('calification_medic_show_patient')}}" id="calification_medic_show_patient">
<input type="hidden" name="delete_video" value="{{route('delete_video')}}" id="delete_video">
<input type="hidden" name="medico_list_videos" value="{{route('medico_list_videos')}}" id="medico_list_videos">
<input type="hidden" name="medico_experience_list" value="{{route('medico_experience_list')}}" id="medico_experience_list">
<input type="hidden" name="medico_experience_store" value="{{route('medico_experience_store')}}" id="medico_experience_store">
<input type="hidden" name="social_network_list" value="{{route('social_network_list')}}" id="social_network_list">
<input type="hidden" name="select_insurrances2" value="{{route('select_insurrances2')}}" id="select_insurrances2">
<input type="hidden" name="inner_cities_select" value="{{route('inner_cities_select')}}" id="inner_cities_select">
<input type="hidden" name="medico_service_list" value="{{route('medico_service_list')}}" id="medico_service_list">
<input type="hidden" name="medico_social_network_store" value="{{route('medico_social_network_store')}}" id="medico_social_network_store">
<input type="hidden" name="medico_experience_delete" value="{{route('medico_experience_delete')}}" id="medico_experience_delete">
<input type="hidden" name="medicoBorrar" value="{{route('medicoBorrar')}}" id="medicoBorrar">
<input type="hidden" name="borrar_social" value="{{route('borrar_social')}}" id="borrar_social">
<input type="hidden" name="service_medico_store" value="{{route('service_medico_store')}}" id="service_medico_store">

<input type="hidden" name="medico_update" value="{{route('medico.update',\Hashids::encode($medico->id))}}" id="medico_update">
<input type="hidden" name="lat" value="{{$medico->latitud}}" id="lat">
<input type="hidden" name="lng" value="{{$medico->longitud}}" id="lng">
<input type="hidden" name="img_marker" value="{{asset('img/marker-icon.png')}}" id="img_marker">
<input type="hidden" name="medico_store_coordinates" value="{{route('medico_store_coordinates',\Hashids::encode($medico->id))}}" id="medico_store_coordinates">
<input type="hidden" name="verifySession" value="{{route('verifySession')}}" id="verifySession">






@endsection

@section('scriptJS')
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>
  <script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>
<script type="text/javascript">

var modal = document.getElementById('myModal-img');
// Get the image and insert it inside the modal - use its "alt" text as a caption
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

function expandir(result){
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  modal.style.display = "block";
  modalImg.src = result.src;
  captionText.innerHTML = result.alt;
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cerrar")[0];

// When the user clicks on <span> (x), close the modal
if ( $(".cerrar")[0] ) {
  span.onclick = function(){
      modal.style.display = "none";
  }
}

  function cerrar_calificaciones(){
    $('#modal-calification').modal('hide');
  }
  ///////////////////////////////CALIFICATIONS
  function toogle(result){
      if( $(result).parent('.id_label').parent('.este').next('.div_detail').css('display') == 'none'){
          result = $(result).parent('.id_label').parent('.este').next('.div_detail').show();
      }else{
          result = $(result).parent('.id_label').parent('.este').next('.div_detail').hide();

      }
  }

  function show_califications(result){
   route = $('#calification_medic_show_patient').val();
   medico_id = $('#medico_id_id').val();

   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'POST',
     url: route,
     data:{medico_id:medico_id},
     success:function(result){
       $('#modal-calification').modal('show');
       $('#content_calification').empty().html(result);
        console.log(result);
     },
     error:function(error){
       console.log(error);
     },
   });
 }

  function show_more(result){

      element = result;
      route = $('#calification_medic_show_patient').val();
      medico_id = result.id;
      skip = result.name;

      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route,
        data:{skip:skip,medico_id:medico_id},
        success:function(result){
        $(element).parent('.padre').next('.sig').empty().html('Cargando...');
          $(element).parent('.padre').next('.sig').empty().html(result);

          $(element).hide();
           console.log(result);
        },
        error:function(error){
          console.log(error);
        },
      });
  }
  function cerrar_calificaciones(){
    $('#modal-calification').modal('hide');
  }

 function volver(){
  window.history.back();
}

function delete_video(request){
  question = confirm('¿Esta segur@ de Eliminar este video?')
  if(question == false){
    return false;
  }
  video_id = request;
  route = $('#delete_video').val();
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'POST',
   url:route,
   data:{video_id:video_id},
   error:function(error){
     console.log(error);
   },
   success:function(result){
    cerrar();
    list_videos();
  }
});
}

$('#form_video').submit(function(){
  errormsj = '';
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'POST',
   url: $(this).attr('action'),
   data: $(this).serialize(),
   error:function(error){
     cerrar();
     console.log(error);
     $.each(error.responseJSON.errors, function(index, val){
       errormsj+='<li>'+val+'</li>';
     });
     $('#text_error_video').html('<ul>'+errormsj+'</ul>');
     $('#alert_error_video').fadeIn();
     console.log(errormsj);
   },
   success:function(result){
    cerrar();

    if(result == 'invalida'){
      $('#text_error_video').html('La Url es invalida, o esta mal escrita, solo puede ingresar urls de videos de youtube,para realizar esta opcion, busque en la pagina de youtube el video que desea insertar, etando en la ventana de reproduccion del mismo, seleccione la url de youtube en ese momento: ejemplo: https://www.youtube.com/watch?v=YxC9UB49x04');
      $('#alert_error_video').fadeIn();
    }else if(result == 'limite'){
      $('#text_error_video').html('imposible realizar acción,Haz agregado el numero maximo de videos admitidos.');
      $('#alert_error_video').fadeIn();

    }else if(result == 'ok'){
      cerrar();
      list_videos();
      $("#form_video")[0].reset();
    }
  }

});
  return false;
});

  function list_videos(){
   route = $('#medico_list_videos').val();
   medico_id = $('#medico_id').val();
   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'POST',
     url: route,
     data:{medico_id:medico_id},
     success:function(result){
       $('#list_videos').empty().html(result);

     },
     error:function(error){
       console.log(error);
       $('#list_videos').empty().html('<p style="color:rgb(213, 17, 58)">Hubo un problema al cargar este elemento por favor recargue la pagina para solucionar el problema</p>');
     },
   });
  }



   function list_experience(){
     route = $('#medico_experience_list').val();
     medico_id = $('#medico_id').val();

     $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'POST',
       url: route,
       data:{medico_id:medico_id},
       success:function(result){
         $('#medico_experience_ajax').empty().html(result);
       },
       error:function(error){
         $('#medico_experience_ajax').empty().html('<p style="color:rgb(213, 17, 58)">Hubo un problema al cargar este elemento por favor recargue la pagina para solucionar el problema</p>');
       },
     });
   }


   function service_medico_experience(){
     name = $('#name_experience').val();
     medico_id = $('#medico_id').val();
     route = $('#medico_experience_store').val();
     errormsj = '';
     $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      url:route,
      data:{name:name,medico_id:medico_id},
      error:function(error){
       $.each(error.responseJSON.errors, function(index, val){
         errormsj+='<li>'+val+'</li>';
       });
       $('#text_error_experience').html('<ul>'+errormsj+'</ul>');
       $('#alert_error_experience').fadeIn();
       console.log(errormsj);
     },
     success:function(result){

       $('#modal-experience').modal('toggle');
       list_experience();
     }
   });
   }


  function list_social(){
    route = $('#social_network_list').val();
    medico_id = $('#medico_id').val();
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      url: route,
      data:{medico_id:medico_id},
      success:function(result){
        $('#list_social_ajax').empty().html(result);
      },
      error:function(error){
        $('#list_social_ajax').empty().html('<p style="color:rgb(213, 17, 58)">Hubo un problema al cargar este elemento por favor recargue la pagina para solucionar el problema</p>');
      },
    });
  }
 //fin document ready



function select_insurrances(result){
  // type_patient_service = $('#radio2').val();
  medico_id = $('#medico_id').val();
  type_patient_service = result;
  route = $('#select_insurrances2').val();
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'POST',
   url:route,
   data:{type_patient_service:type_patient_service,medico_id:medico_id},
   error:function(error){
   },
   success:function(result){
       if(result == 'Solo pacientes privados'){
           $('#aseguradoras').hide();
       }else{
           $('#aseguradoras').show();
       }
  }
});

}


function modal_service2(){
  $('#modal-service2').modal('toggle');
  $('#modal-service2').on('shown.bs.modal', function() {
    $('#input_service').val('');
    $('#input_service').focus();
  });
}

function modal_experience(){
  $('#modal-experience').modal('toggle');
  $('#modal-experience').on('shown.bs.modal', function() {
    $('#name_experience').val('');
    $('#name_experience').focus();
  });
}


$('#stateMedic').on('change', function(){
 state_id = $('#stateMedic').val();

 route = $('#inner_cities_select').val();
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'POST',
  url: route,
  data:{state_id:state_id},
  success:function(result){
    $("#cityMedic").empty();
    $('#cityMedic').append($('<option>', {
      value: null,
      text: 'Ciudad'
    }));
    $.each(result,function(key, val){
     $('#cityMedic').append($('<option>', {
      value: key,
      text: val
    }));
   });
  },
  error:function(error){
   console.log(error);
 },
});
});



function list_service(){
  route = $('#medico_service_list').val();
  medico_id = $('#medico_id').val();
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type:'POST',
    url: route,
    data:{medico_id:medico_id},
    success:function(result){
      $('#list_service_ajax').empty().html(result);
    },
    error:function(error){
      $('#list_service_ajax').empty().html('<p style="color:rgb(213, 17, 58)">Hubo un problema al cargar este elemento por favor recargue la pagina para solucionar el problema</p>');
    },
  });
}

function storeSocial(){
  medico_id = $('#medico_id').val();
  name = $('#name_social').val();
  link = $('#link_social').val();


  route = $('#medico_social_network_store').val();
  errormsj = '';

  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type:'POST',
    url:route,
    data:{name:name,link:link,medico_id:medico_id},
    error:function(error){
     $.each(error.responseJSON.errors, function(index, val){
       errormsj+='<li>'+val+'</li>';
     });
     $('#text_error_s').html('<ul>'+errormsj+'</ul>');
     $('#alert_error_s').fadeIn();
     console.log(errormsj);
   },
   success:function(result){

     $('#alert_error_s').fadeOut();
     name = $('#name_social').val('');
     link = $('#link_social').val('');
     list_social();
   }
 });
}


function medico_experience_delete(service_id){
  id = service_id;
  errormsj = '';
  question = confirm('¿Esta seguro de Borrar este Servicio?');
  if(question == false){
   return false;
 }
 route = $('#medico_experience_delete').val();
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'POST',
  url:route,
  data:{medico_id:id},
  error:function(error){
   $.each(error.responseJSON.errors, function(index, val){
     errormsj+='<li>'+val+'</li>';
   });
   console.log(errormsj);
 },
 success:function(result){

   list_experience();
 },
});
}

function medico_service_delete(service_id){
  id = service_id;
  errormsj = '';
  question = confirm('¿Esta seguro de Borrar este Servicio?');
  if(question == false){
    return false;
 }

 route = $('#medicoBorrar').val();
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'POST',
  url:route,
  data:{medico_id:id},
  error:function(error){
   $.each(error.responseJSON.errors, function(index, val){
     errormsj+='<li>'+val+'</li>';
   });
   $('#text_error_s').html('<ul>'+errormsj+'</ul>');
   $('#alert_error_s').fadeIn();
   console.log(errormsj);
 },
 success:function(result){
   list_service();
 },
});
}

function social_network_delete(social_id){
  id = social_id;
  errormsj = '';
  question = confirm('¿Esta seguro de Borrar esta Red Social?');
  if(question == false){
    return false;
 }

 route = $('#borrar_social').val();
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  method:'POST',
  url:route,
  data:{id:id},
  error:function(error){
   $.each(error.responseJSON.errors, function(index, val){
     errormsj+='<li>'+val+'</li>';
   });
   $('#text_error_s').html('<ul>'+errormsj+'</ul>');
   $('#alert_error_s').fadeIn();
   console.log(errormsj);
 },
 success:function(result){
   list_social();
 },
});

}

function service_medico_store(){
  name = $('#input_service').val();
  medico_id = $('#medico_id').val();
  route = $('#service_medico_store').val();
  errormsj = '';
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'POST',
   url:route,
   data:{name:name,medico_id:medico_id},
   error:function(error){
    $.each(error.responseJSON.errors, function(index, val){
      errormsj+='<li>'+val+'</li>';
    });
    $('#text_error_service').html('<ul>'+errormsj+'</ul>');
    $('#alert_error_service').fadeIn();
    console.log(errormsj);
  },
  success:function(result){
    $('#modal-service2').modal('toggle');
    list_service();
  }
});

$(document).ready(function(){
  list_social();
  list_service();
  list_experience();
  list_videos();
  show_map();
  });

}

function updateMedic(){
  nameMedic =  $('#nameMedic').val();
  lastNameMedic = $('#lastNameMedic').val();
  genderMedic = $('#genderMedic').val();
  cityMedic = $('#cityMedic').val();
  stateMedic = $('#stateMedic').val();
  phoneMedic = $('#phoneMedic').val();
  phoneOffice1Medic = $('#phoneOffice1Medic').val();
  phoneOffice2Medic = $('#phoneOffice2Medic').val();
  identificationMedic = $('#identificationMedic').val();
  specialtyMedic = $('#specialtyMedic').val();
  sub_specialtyMedic = $('#sub_specialtyMedic').val();
  errormsj = '';
  route = $('#medico_update').val();

  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   method:'put',
   url:route,
   data:{name:nameMedic,lastName:lastNameMedic,gender:genderMedic,city_id:cityMedic,state_id:stateMedic,phone:phoneMedic,phoneOffice1:phoneOffice1Medic,phoneOffice2:phoneOffice2Medic,identification:identificationMedic,specialty:specialtyMedic,sub_specialty:sub_specialtyMedic},
   error:function(error){
    $.each(error.responseJSON.errors, function(index, val){
      errormsj+='<li>'+val+'</li>';
    });
    $('#alert_success_update').fadeOut();
    $('#text_error_medic').html('<ul>'+errormsj+'</ul>');
    $('#alert_error_update').fadeIn();
    console.log(errormsj);
  },
  success:function(result){
    $('#alert_error_update').fadeOut();
    $('#text_success_service').html('Cambios Guardados con Exito');
    $('#alert_success_update').fadeIn();

  }
});

}

function cerrar(){
  $('#alert_error_update').fadeOut();
  $('#alert_success_update').fadeOut();
  $('#alert_error_video').fadeOut();

}

function show_map(){
  $('#store_coordinates').attr('disabled', false);
  lat = $('#lat').val();
  lng = $('#lng').val();
  var map = new GMaps({
    el: '#map',
    lat: lat,
    lng: lng,
    zoom: 5,
  });
  map.addMarker({
    lat: lat,
    lng: lng,
    title: 'Tu Ubicacion',
    icon: $('#img_marker').val(),
    draggable: true,
    dragend: function(event) {
     var lat = event.latLng.lat();
     var lng = event.latLng.lng();
     $('#latitudSave').val(lat);
     $('#longitudSave').val(lng);
     $('#store_coordinates').attr('disabled', false);
   },
});//fin marker
}

function searchInMap(){
  $('#store_coordinates').attr('disabled', false);
  var map = new GMaps({
   el: '#map',
   zoom: 5,

 });

  GMaps.geocode({
    address: $('#address').val(),
    callback: function(results, status) {
     if (status == 'OK') {
      var latlng = results[0].geometry.location;
      var lat = latlng.lat();
      var lng = latlng.lng();
      $('#latitudSave').val(lat);
      $('#longitudSave').val(lng);
      map.  setCenter(latlng.lat(), latlng.lng());
      map.addMarker({
       lat: latlng.lat(),
       lng: latlng.lng(),
       title: 'Tu Ubicacion',
       icon: $('#img_marker').val(),
       draggable: true,
       dragend: function(event) {
         var lat = event.latLng.lat();
         var lng = event.latLng.lng();
         $('#latitudSave').val(lat);
         $('#longitudSave').val(lng);
         $('#store_coordinates').attr('disabled', false);
       },

      });//fin marker
    }
  }
});
}//fin searchInMap

function store_coordinates(){
  route = $('#medico_store_coordinates').val();
  latitud = $('#latitudSave').val();
  longitud = $('#longitudSave').val();

  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type:'POST',
    url:route,
    data:{latitud:latitud,longitud:longitud},
    error:function(error){
      console.log(error);
    },
    success:function(result){
      }
    });
}
function cerrar_alert(){
  $('#alert_error_s').hide();
}

function verifySession(){

  route = $('#verifySession').val();

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

  route = $('#verifySession').val();

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

$(document).ready(function(){
  list_social();
  list_service();
  list_experience();
  list_videos();
  show_map();
  });
</script>

@endsection
