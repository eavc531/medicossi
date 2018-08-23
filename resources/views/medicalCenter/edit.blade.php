@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="container">
          <div class="row mt-3">
           <div class="col-lg-6 col-12">
            {{-- @isset($photo)
            <div class="cont-img my-2">
              <img src="{{asset('img/profile.png')}}" class="prof-img" alt="" id="img">
            </div>
            @endisset
            <div class="input-group mt-3 col-xs-12">
              <span class="btn btn-config-blue"><i class="fas fa-images"></i></span>
              <input type="text" class="form-control input-lg" disabled placeholder="Imagen">
              <span class="input-group-btn">
                <button class="browse btn btn-config-blue input-lg" type="button"> Agrega una imagen</button>
              </span>
            </div> --}}
          </div>
          <div class="col-lg-6 col-sm-6 col-12 text-center">
            <label for="">Barra de progreso</label>
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%; vertical-align: center;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <hr>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <h4 class="font-title-blue text-center">Datos de la institución o Centro Médico</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-12 my-2">
            <ul>
              <li><strong>Nombre de la Institución:</strong> {{$medicalCenter->name}}</li>
              <li><strong>Nombre del Administrador:</strong> {{$medicalCenter->nameAdmin}}</li>
              <li><strong>Licencia Sanitaria:</strong> {{$medicalCenter->sanitary_license}}</li>
              <li><strong>Telefono de Oficina 1:</strong> {{$medicalCenter->phone}}</li>
            </ul>
          </div>
          <div class="col-lg-6 col-12 my-2">
            <ul>
              <li><strong>Email de la institución:</strong> @isset($medicalCenter->email_institution)
                {{$medicalCenter->email_institution}}
                @else <span style="color:green">No especificado</span>@endisset</li>
                <li><strong>Teléfono del Administrador:</strong>{{$medicalCenter->phone_admin}}</li>
                <li><strong>Id del Centro Medico:</strong> {{$medicalCenter->id_medicalCenter}}</li>
                <li><strong>Telefono de Oficina 2:</strong> {{$medicalCenter->phone2}}</li>
              </ul>
              <a class="btn btn-success btn-block" href="{{route('medical_center_edit_data',\Hashids::encode($medicalCenter->id))}}">Editar</a>
            </div>
          </div>
          <hr>
          <div class="row mt-4">
            <div class="col-12">
              <h4 class="font-title-blue text-center">Dirección</h4>
            </div>
          </div>
          <div class="row text-left">
            <div class="col-lg-6 col-12">
              <ul>
                <li><strong>Pais:</strong> {{$medicalCenter->country}}</li>
                <li><strong>Estado:</strong> {{$medicalCenter->state}}</li>
                <li><strong>Ciudad:</strong> {{$medicalCenter->city}}</li>
                <li><strong>Codigo Postal:</strong> {{$medicalCenter->postal_code}}</li>
              </ul>
            </div>
            <div class="col-lg-6 col-12">
              <ul>
                <li><strong>Colonia:</strong>
                  {{$medicalCenter->colony}}
                </li>
                <li><strong>Calle/av:</strong>{{$medicalCenter->street}}</li>
                <li><strong>Numero Externo:</strong> {{$medicalCenter->number_ext}}</li>
                <li><strong>Numero Interno:</strong> {{$medicalCenter->number_int}}</li>
              </ul>

              <a class="btn btn-success btn-block" href="{{route('medical_center_edit_address',\Hashids::encode($medicalCenter->id))}}">Editar</a>
            </div>
          </div>
          <hr>
          {{-- section mapa --}}
          <div class="row my-4">
            <div class="col-12">
              <h4 class="font-title-blue text-center">Ubicacion en el mapa</h4>
            </div>
            <p class="text-justify">La Ubicación exacta permite que el usuario pueda ubicar su Centro Medico, o institución con mayor facilidad, a travez de las busquedas de filtros, en el menu principal</p>

            <p class="text-justify">Cuando añade los datos de Dirección, automaticamente el sistema ubicara esta direccion en el mapa sin embargo, muchas veces no suele ser preciso, debido a que la dirección registrada,no concuerda con la base de datos de google maps, esto se puede corregir manualmente.</p>

            <p><strong>Ubicar dirección Manualmente.</strong></p>

            <p class="text-justify">acceda al mapa a continuacion, realize la busqueda rellenado el campo 'direccion/ciudad/pais' y/o arrastre el marcador al punto de la dirección deseada, luego presione el boton "Guardar Ubicacion"</p>
          </div>
          <div class="m-2">
            <div class="form-inline">
              <input type="text" name="" class="form-control" value="" id="address">
              <button onclick="searchInMap()" class="btn btn-primary" type="button" name="button">Buscar</button>
            </div>

          </div>
          <div class="mt-3">
            {{-- //div que muestra el mapa --}}
            <div class="m-1" id="map" style="height:300px;width:auto">

            </div>
            <div class="row">
              <div class="col-lg-6">
                <button id="store_coordinates" type="button" class="btn btn-primary btn btn-block my-1" name="button" onclick="store_coordinates()" disabled>Guardar Ubicacion </button>
              </div>
              <div class="col-lg-6">
                <button type="button" class="btn btn-primary btn btn-block my-1" name="button" onclick="show_map()">Restablecer Marcador</button>
              </div>
            </div>
            <input type="hidden" name="latitudSave" value="" id="latitudSave">
            <input type="hidden" name="longitudSave" value="" id="longitudSave">
          </div>
        </div>
        <hr>
        <div class="row my-4">
          <div class="col-12">
            <h4 class="font-title-blue text-center">Horario de atención</h4>
          </div>
        </div>
        <div class=" mt-3">
          <table class="table table-bordered table-responsive table-config">
            <thead>
              <tr>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sabado</th>
                <th>Domingo</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  @foreach ($lunes as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>

                    <hr>
                  </ul>
                  @endforeach
                </td>
                <td>
                  @foreach ($martes as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>

                    <hr>
                  </ul>
                  @endforeach
                </td>
                <td>
                  @foreach ($miercoles as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>

                    <hr>
                  </ul>
                  @endforeach
                </td>
                <td>
                  @foreach ($jueves as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>

                    <hr>
                  </ul>
                  @endforeach
                </td>
                <td>
                  @foreach ($viernes as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>

                    <hr>
                  </ul>
                  @endforeach
                </td>
                <td>
                  @foreach ($sabado as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>

                    <hr>
                  </ul>
                  @endforeach
                </td>
                <td>
                  @foreach ($domingo as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                      a
                      {{$day->hour_end}}

                    </li>
                    <hr>
                  </ul>
                  @endforeach
                </td>
              </tr>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 offset-sm-6 col-lg-6 offset-lg-6">
            <a class="btn btn-success btn-block" href="{{route('medical_center_edit_schedule',\Hashids::encode($medicalCenter->id))}}">Editar Horario</a>
          </div>
        </div>
        <hr>
        <div class="row my-3">
         <div class="col-12">
           <h4 class="font-title-blue text-center">Descripción</h4>
         </div>
       </div>
       <div class="row mb-3">
        <div class="col-lg-12">
          <div id="div_descripion"> </div>
        </div>
      </div>
      <div class="row">
<!--         <div class="col-12 col-sm-6 col-lg-6">
         <a href="" data-toggle="modal" data-target="#modal-service2" class="btn btn-success btn-block"><i class="fas fa-plus"></i>Agregar</a>
       </div> -->
     </div>
     <hr>
     <div class="row my-3">
      <div class="col-12 mb-1">
       <h4 class="font-title-blue text-center">Especialidades</h4>
     </div>
   </div>
   <div class="" id="div_list_specialty">
   </div>
  <div class="row my-3">
    <div class="col-12 col-sm-6 offset-sm-6 col-lg-6 offset-lg-6">
     <button onclick="modal_specialty()" class="btn btn-success btn-block"><i class="fas fa-plus"></i>Agregar</button>
   </div>
 </div>
 <hr>
 <div class="row">
  <div class="col-12">
    <h4 class="font-title-blue text-center mb-3">Profesionales de la salud</h4>
  </div>
</div>
<div class="row">
</div>
<div class="row my-3">
  <div class="col-12 col-sm-6 offset-sm-6 col-lg-6 offset-lg-6">

   <a href="{{route('medical_center_manage_medicos',\Hashids::encode($medicalCenter->id))}}" data-target="#modal-service2" class="btn btn-success btn-block">Ver/Administrar</a>
 </div>
</div>
<hr>
  <!-- <div id="medico_experience_ajax" style="text-align:justify">
  </div> -->
  <div class="row">
    <div class="col-12">
     <h4 id="imgs" class="font-title-blue text-center">Experiencias en trastornos o enfermedades</h4>
   </div>
 </div>
 <hr>

 <div id="div_list_experience" style="text-align:justify">

 </div>
 <div class="row my-3">
  <div class="col-12 col-sm-6 offset-sm-6 col-lg-6 offset-lg-6">

   <button onclick="modal_experience()" class="btn btn-success btn-block" type="button">Agregar</button>
 </div>
</div>
<hr>
<div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Imagenes</h4>
 </div>
</div>
<div class="row">
  <div class="col-12">
   <div class="form-group">
     {{-- @include('medico.alert2.alert2') --}}
     <div class="row" id="">
      @foreach ($images as $image)
      {{-- div que encierra cada imagen --}}
      <div class="col my-2">
        <img src="{{asset($image->path)}}" width="auto" height="80px" alt="">
        <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')"href="{{route('photo_delete',\Hashids::encode($image->id))}}">x</a>
      </div>
      @endforeach
    </div>
    {!!Form::open(['route'=>'image_store_medical_center','method'=>'POST','files'=>true])!!}
    {!!Form::hidden('medicalCenter',$medicalCenter->id)!!}
    {!!Form::hidden('email',$medicalCenter->email)!!}
    {!!Form::hidden('medicalCenter_id',$medicalCenter->id)!!}
    <div class="form-group col-lg-6 col-12">
      <input type="file" name="image" class="file">
      <div class="input-group col-xs-12">
        <span class="btn btn-config-blue"><i class="fas fa-images"></i></span>
        <input type="text" class="form-control input-lg" disabled placeholder="Imagen">
        <span class="input-group-btn">
          <button class="browse btn btn-config-blue input-lg" type="button"> Agrega una imagen</button>
        </span>
      </div>
    </div>
    <div class="col-12 col-sm-6 offset-sm-6 col-lg-6 offset-lg-6">
      {!!Form::submit('Subir Imagen',['class'=>'btn btn-success btn-block mt-2'])!!}
      {!!Form::close()!!}
    </div>
  </div>
</div>
</div>
<hr>
<div class="row my-3">
  <div class="col-12">
   <h4 class="font-title-blue text-center">Mis redes sociales</h4>
 </div>
</div>
<div class="row">
  <div class="col-lg-3 col-sm-3 col-12">
    <div class="form-group">
      {!!Form::select('name',['Facebook'=>'Facebook','Twiter'=>'Twiter','Instagram'=>'Instagram'],null,['class'=>'form-control','placeholder'=>'Red Social','id'=>'name_social'])!!}
    </div>
  </div>
  <div class="col-lg-7 col-sm-7 col-12">
    <div class="form-group">
      {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Dirección Url del perfil de su Red Social','id'=>'link_social'])!!}
      {!!Form::hidden('medicalCenter_id',$medicalCenter->id,['id'=>'medicalCenter_id'])!!}
    </div>
  </div>
  <div class="col-lg-2 col-12 col-sm-2">
    <div class="form-group">
      <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button>
    </div>
  </div>
  {{-- alert error  --}}
  <div id="alert_error_s" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
    <p id="text_error_s"></p>
  </div>
  {{-- {!! $errors->first('name','<span class="help-block">:message</span>') !!} --}}
  {{-- BOTONES QUE SE MUESTRAN CON AJAX DESDE LISTA-Social --}}

</div>
<div id="list_social_ajax">
</div>
<hr>
<div class="row mt-3">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Aseguradoras</h4>
  </div>
</div>
<div class="row">
  <div class="col-12 my-3">
   <label><b>Clasificación de servicios profesionales otorgados</b></label>
 </div>
</div>


<div class="row my-3">
  <div class="col-lg-9 col-12 m-auto">
    <div class="custom-control custom-radio">
      {{-- {{Form::radio('type_patient_service','Solo pacientes privados',['class'=>'custom-control-input','id'=>'radio'])}} --}}

      @if($medicalCenter->type_patient_service == "Solo pacientes privados")
      <input type="radio" name="type_patient_service" value="solo medicos privados" checked="checked" id="radio" onclick="hide_aseguradoras()">
      @else
        <input type="radio" name="type_patient_service" value="Solo pacientes privados" id="radio" onclick="hide_aseguradoras()">
      @endif
      <label class="" for="show-question1" id="radio"  >Solo pacientes privados</label>
    </div>
    <div class="custom-control custom-radio">

      @if($medicalCenter->type_patient_service == "Pacientes por aseguradoras, convenios y privados")

      <input type="radio" name="type_patient_service" value="Pacientes por aseguradoras, convenios y privados" checked="checked" id="radio2" onclick="show_aseguradoras()">
      @else
        <input type="radio" name="type_patient_service" value="Pacientes por aseguradoras, convenios y privados" id="radio2" onclick="show_aseguradoras()">
      @endif
      <label class="" for="show-question1" id="radioxxx"  >Pacientes por aseguradoras, convenios y privados</label>
      <label class="" for="show-question2"></label>
    </div>
    <div class= "p-3 mt-3" id="panel-insurance" style="display:none;">
      <a href="{{route('create_add_insurrances',\Hashids::encode($medicalCenter->id))}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
    </div>
    <div class="aseguradoras" id="aseguradoras" style="display:none">
        <div class="card">
          <div class="card-body">
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
              <div class="col-6">
                  <a href="{{route('create_add_insurrances',\Hashids::encode($medicalCenter->id))}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
              </div>
            </div>
          </div>
        </div>

   </div>
 </div>
</div>

<hr>
</div>
<div class="row">
  <div class="col-12 text-center">
    {{-- <button class="btn btn-success" type="buton">Guardar</button> --}}
  </div>
</div>
</div>
</div>
</section>
@include('medicalCenter/modal_edit/modals')
@endsection

@section('scriptJS')
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>

<script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>
<script type="text/javascript">

    // function show_insurance(){
    //   $('#panel-insurance').show();
    // }
    $('document').ready(function(){
      show_description();
      show_map();
      medicalCenter_list_specialty();
      medicalCenter_list_experience();
      list_social();
      comprueba_checkbox();

    });

    function hide_aseguradoras(){
      type_patient_service = $('#radio').val();
      medicalCenter_id = "{{\Hashids::encode($medicalCenter->id)}}"
      route = "{{route('select_insurrances')}}"
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{type_patient_service:type_patient_service,medicalCenter_id:medicalCenter_id},
       error:function(error){
      },
      success:function(result){
        console.log(result);
      }
    });
      $('#aseguradoras').hide();
    }

    function show_aseguradoras(){
      type_patient_service = $('#radio2').val();
      medicalCenter_id = "{{\Hashids::encode($medicalCenter->id)}}"
      route = "{{route('select_insurrances')}}"
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{type_patient_service:type_patient_service,medicalCenter_id:medicalCenter_id},
       error:function(error){
      },
      success:function(result){
        console.log(result);
      }
    });
      $('#aseguradoras').show();
    }

    function comprueba_checkbox(){
        if($("#radio2").is(':checked')) {
          $('#aseguradoras').show();
          }
    }



    function show_map(){
      $('#store_coordinates').attr('disabled', true);
      lat = '{{$medicalCenter->latitud}}';
      lng = '{{$medicalCenter->longitud}}';
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
        icon: "{{asset('img/marker-icon.png')}}",
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
      var map = new GMaps({
        el: '#map',
        zoom: 5,

      });
      $('#store_coordinates').attr('disabled', false);

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
              icon: "{{asset('img/marker-icon.png')}}",
              draggable: true,
              dragend: function(event) {
               var lat = event.latLng.lat();
               var lng = event.latLng.lng();
               $('#latitudSave').val(lat);
               $('#longitudSave').val(lng);
               $('#store_coordinates').attr('disabled', false);
             },

                 // infoWindow: {
                 //     content: content
                 // }
          });//fin marker
          }
        }
      });
    }//fin searchInMap

    function store_coordinates(){
      route = '{{route('medicalCenter_store_coordinates',\Hashids::encode($medicalCenter->id))}}';
      latitud = $('#latitudSave').val();
      longitud = $('#longitudSave').val();

      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{latitud:latitud,longitud:longitud},
       error:function(error){
        console.log(error);
      },
      success:function(result){
        console.log(result);
            // //$('#input_descripion').val(result);
            // $('#div_descripion').html(result);
            // decription = $('#description_text').html();
            // $('#input_description').val(decription);
          }
        });
    }


    function show_description(){
      route = '{{route('medicalCenter_description_show',\Hashids::encode($medicalCenter->id))}}';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       // data:{},
       error:function(error){

        console.log(error);
      },
      success:function(result){
        console.log(result);
        //$('#input_descripion').val(result);
        $('#div_descripion').html(result);
        decription = $('#description_text').html();
        $('#input_description').val(decription);
      }
    });

    }
    function store_description(){

      description = $('#input_description').val();
    //medicalCenter_id = 'xxssd';
    route = "{{route('medicalCenter_description_update',\Hashids::encode($medicalCenter->id))}}";
    errormsj = '';
    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url:route,
     data:{description:description},
     error:function(error){
      $.each(error.responseJSON.errors, function(index, val){
        errormsj+='<li>'+val+'</li>';
      });
      $('#text_error_service').html('<ul>'+errormsj+'</ul>');
      $('#alert_error_service').fadeIn();
      console.log(errormsj);
    },
    success:function(result){
      console.log(result);
      $('#input_description').val('');
      $('#modal-service2').modal('toggle');
      show_description();
    }
  });

  }

  function medicalCenter_list_specialty(){

   route = "{{route('medicalCenter_list_specialty',\Hashids::encode($medicalCenter->id))}}";
   medicalCenter_id = '{{$medicalCenter->id}}';

   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medicalCenter_id:medicalCenter_id},
     success:function(result){
       console.log(result);
       $('#div_list_specialty').empty().html(result);
     },
     error:function(error){
       console.log(error);
     },
   });
 }

 function medicalCenter_list_experience(){

   route = "{{route('medicalCenter_list_experience',\Hashids::encode($medicalCenter->id))}}";
   medicalCenter_id = '{{$medicalCenter->id}}';

   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medicalCenter_id:medicalCenter_id},
     success:function(result){
       console.log(result);
       $('#div_list_experience').empty().html(result);
     },
     error:function(error){
       console.log(error);
     },
   });
 }

 function medical_center_experience_store(){
  name = $('#input_experience').val();
      //medicalCenter_id = 'xxssd';
      route = "{{route('medical_center_experience_store',\Hashids::encode($medicalCenter->id))}}";
      errormsj = '';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{name:name},
       error:function(error){
        $.each(error.responseJSON.errors, function(index, val){
          errormsj+='<li>'+val+'</li>';
        });
        $('#text_error_experience').html('<ul>'+errormsj+'</ul>');
        $('#alert_error_experience').fadeIn();
        console.log(errormsj);
      },
      success:function(result){
        console.log(result);
        $('#input_experience').val('');
        $('#modal_experience').modal('toggle');
        medicalCenter_list_experience();
      }
    });
    }

    function medical_center_specialty_store(){

      name = $('#input_specialty').val();
    //medicalCenter_id = 'xxssd';
    route = "{{route('medical_center_specialty_store',\Hashids::encode($medicalCenter->id))}}";
    errormsj = '';
    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url:route,
     data:{name:name},
     error:function(error){
      $.each(error.responseJSON.errors, function(index, val){
        errormsj+='<li>'+val+'</li>';
      });
      $('#text_error_specialty').html('<ul>'+errormsj+'</ul>');
      $('#alert_error_specialty').fadeIn();
      console.log(errormsj);
    },
    success:function(result){
      console.log(result);
      $('#input_specialty').val('');
      $('#modal-specialty').modal('toggle');
      medicalCenter_list_specialty();
    }
  });

  }

  function medical_experience_delete(id){
    pre = confirm('¿Esta segur@ de Eliminar esta Especialidad?');
    if(pre == false){
      return;
    }
    route = "{{route('medical_experience_delete')}}";
    id = id;
    errormsj = '';
    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url:route,
     data:{id:id},
     error:function(error){
      console.log(error);
    },
    success:function(result){
      console.log(result);
      medicalCenter_list_experience();
    }
  });
  }

  function medical_specialty_delete(id){
    pre = confirm('¿Esta segur@ de Eliminar esta Especialidad?');
    if(pre == false){
      return;
    }
    route = "{{route('medical_specialty_delete')}}";
    id = id;
    errormsj = '';
    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url:route,
     data:{id:id},
     error:function(error){
      console.log(error);
    },
    success:function(result){
      console.log(result);
      medicalCenter_list_specialty();
    }
  });
  }

  function modal_specialty(){
    $('#modal-specialty').modal('toggle');
    $('#modal-specialty').on('shown.bs.modal', function() {
      $('#input_specialty').focus();
    });

  }
  function modal_experience(){
    $('#modal_experience').modal('toggle');
    $('#modal_experience').on('shown.bs.modal', function() {
      $('#input_experience').focus();
    });

  }

  function storeSocial(){
    medicalCenter_id = $('#medicalCenter_id').val();
    name = $('#name_social').val();
    link = $('#link_social').val();
    route = "{{route('medicalCenter_social_store')}}";
    errormsj = '';

    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'post',
      url:route,
      data:{name:name,link:link,medicalCenter_id:medicalCenter_id},
      error:function(error){
       $.each(error.responseJSON.errors, function(index, val){
         errormsj+='<li>'+val+'</li>';
       });
       $('#text_error_s').html('<ul>'+errormsj+'</ul>');
       $('#alert_error_s').fadeIn();
       console.log(errormsj);
     },
     success:function(result){
       console.log(result);
       $('#alert_error_s').fadeOut();
       name = $('#name_social').val('');
       link = $('#link_social').val('');
       list_social();
     }
   });
  }

  function list_social(){
   route = "{{route('medicalCenter_social_list')}}";

   medicalCenter_id = '{{$medicalCenter->id}}';

   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medicalCenter_id:medicalCenter_id},
     success:function(result){
       $('#list_social_ajax').empty().html(result);
       console.log(result);

     },
     error:function(error){
       console.log(error);
     },
   });
 }

 function social_network_delete(social_id){
   id = social_id;
   errormsj = '';
   question = confirm('¿Esta seguro de Borrar esta Red Social?');
   if(question == false){
    exit();
  }
  route = "{{route('borrar_social')}}";
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   method:'post',
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
    console.log(result);
    list_social();

  },
});

}
</script>
@endsection
