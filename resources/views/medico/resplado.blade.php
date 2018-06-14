-------------------HTML-------------------

<div class="spinner-wrapper">
	<div class="spinner"></div>
</div>


-------------------CSS-------------------

 /*||||||||||||||||||| Preloaders |||||||||||||||||||||||*/

    .spinner-wrapper {
    	position: fixed;
    	top: 0;
    	left: 0;
    	right: 0;
    	bottom: 0;
    	background-color: rgba(255, 255, 255, .87);
    	z-index: 999999;
    }

    .spinner{
    	width: 80px;
    	height: 80px;
    	border: 2px solid #0060df;
    	border-top:5px solid #0060df;
    	border-radius: 100%;
    	position: absolute;
    	top:0;
    	bottom:0;
    	left:0;
    	right: 0;
    	margin: auto;
    	animation: spin 1s infinite linear;
    }

    @keyframes spin {
    	from{
    		transform: rotate(0deg);
    		}to{
    			transform: rotate(360deg);
    		}
    	}


------------------------- JS ------------------------

$(document).ready(function() {
//Preloader
$(window).on("load", function() {
    preloaderFadeOutTime = 400;
    function hidePreloader() {
        var preloader = $('.spinner-wrapper');
        preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
});
});

///////////////////////////////////////////////////////////
function update_event(){


 cerrar();
 medico_id = $('#medico_id4').val();
 event_id = $('#event_id3').val();
 title = $('#titleUp9').val();
 alert(title);
 description = $('#descriptionUp4').val();
 route = "{{route('update_event')}}";
 $('#alert_carga5').fadeIn();
 $('#guardar5').attr("disabled", true);
 $('#delete5').attr("disabled", true);
 $('#cancelar5').attr("disabled", true);
 errormsj = '';
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: route,
        data:{medico_id:medico_id,event_id:event_id,title:title,description:description},
        success:function(result){
          console.log(result);
          $('#alert_carga5').fadeOut();
          $('#guardar5').attr("disabled", false);
          $('#delete5').attr("disabled", false);
          $('#cancelar5').attr("disabled", false);

          if(result == 'fuera del horario'){
            $('#text_error_up1').html('imposible guardar evento, fuera del horario establecido');
            $('#alert_error_up1').fadeIn();
          }else if(result == 'fecha_editada'){
            $('#text_success_up1').html('Se a Guardado el cambio de Fecha con Exito, se ha enviado una notificacion al correo del paciente para informar del cambio de la Cita.');
            $('#alert_success_up1').fadeIn();
          }else {
            console.log(result);
            $('#text_success_up1').html('Guardado con Exito');
            $('#alert_success_up1').fadeIn();
            $('#alert_error_up1').fadeOut();
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('refetchEvents');
            cerrar();
          }

        },
        error:function(error){
          $('#alert_carga5').fadeOut();
          $('#guardar5').attr("disabled", false);
          $('#delete5').attr("disabled", false);
          $('#cancelar5').attr("disabled", false);
          console.log(error);
         $.each(error.responseJSON.errors, function(index, val){
           errormsj+='<li>'+val+'</li>';
         });
         $('#text_error_up1').html('<ul style="list-style:none;">'+errormsj+'</ul>');
         $('#alert_error_up1').fadeIn();
         $('#alert_success_up1').fadeOut();

         console.log(errormsj);
       },
    })

    return false;
};
///////////////////////////////////////////////////////////
@extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-12">
        <div class="register">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center font-title">Administrar Datos de Paciente: <span>{{$patient->name }} {{$patient->lastName }}</span></h2>
              <hr>
            </div>
          </div>
          <div class="row justify-content-center mb-2">
            <div class="col-8 -auto">
              <div class="row">
                <div class="col-lg-2 col-6">
                  <a href="#"><img src="{{asset('img/botones-medicossi-26.png')}}" alt=""></a>
                </div>
                <div class="col-lg-2 col-6">
                  <img src="{{asset('img/botones-medicossi-27.png')}}" alt="">
                </div>

                <div class="col-lg-2 mt-3 col-12">
                  <a href="{{route('medico_patients',$medico->id)}}" class="btn btn-secondary">Lista de Pacientes</a>
                </div>
                <div class="col-lg-2 mt-3 col-12">
                  <a href="{{route('medico_patients',$medico->id)}}" class="btn btn-secondary">Notas Médicas</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>
          </div>
          <hr>
          {{-- ////////////////////////////////////////////centro de menu////////////centro de menu// --}}
            <a href="#" class="btn btn-link">* Agregar Nueva Nota Médica</a>

            <div class="card">
              <div class="card-header">
                Nueva Nota
              </div>
              <div class="card-body">
                Pruebas de Laboratorio

                <div id="list_questions_labs">

                </div>

              </div>
            </div>


          {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
          </div>
        <div class="col-12 col-lg-3">
          <div id="dashboard">
            <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
            <div class="col-12 border-head-panel text-center">
              <span>Usuario firmado:</span>
              <span>{{$medico->email}}</span>
            </div>


              <hr>
              <div class="col-12 box-control-panel text-center p-0">
                <a href="" id="green">
                  <i class="fas fa-plus"></i>
                  <h5>Dar paciente de alta</h5>
                </a>
              </div>


              <hr>
              <div class="col-12">
                <div class="col-12 box-control-panel text-center p-0">
                  <a href="" id="green">
                    <h5>Nueva nota médica</h5>
                    <i class="fas fa-plus-circle"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="border-panel-green">
              <div class="col-12">
                <div class="row">
                  <div class="col-12 box-control-panel text-center p-0">
                    <a href="">
                      <img src="{{asset('img/botones-medicossi-26.png')}}" alt="">
                      <h5>Agrega nueva cita</h5>
                    </a>
                  </div>
                  <div class="col-12">
                    <div class="col-lg-12 col-12 mt-2">
                      <button type="submit" class="btn-config-blue btn btn-block" data-toggle="modal" data-target="#modal-end-consult">Termino de consulta</button>
                    </div>
                    <div class="col-lg-12 col-12 mt-2">
                      <button type="submit" class="btn-config-green btn btn-block">Nuevo recordatorio</button>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12">
                <div class="col-12 box-control-panel text-center p-0">
                  <a href="">
                    <i class="fas fa-chart-line"></i>
                    <h5>Mis Estadisticas</h5>
                  </a>
                </div>
              </div>
              <hr>

          </div>
          <div class="row">
            <div class="col-12">
              <a href="" class="btn-config-green btn btn-block">Configuración</a>
              <a href="" class="btn-config-green btn btn-block">Atras</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- <button onclick="filtrar()" type="button" name="button">Filtrar</button> --}}
<input type="text" name="" value="" id="input1">
  <button onclick="parpadeo()" type="button" name="button">testttttt</button>
@isset($days_hide)
<input id="lunes" type="hidden" name="" value="{{$days_hide['lunes']}}">
<input id="martes" type="hidden" name="" value="{{$days_hide['martes']}}">
<input id="miercoles" type="hidden" name="" value="{{$days_hide['miercoles']}}">
<input id="jueves" type="hidden" name="" value="{{$days_hide['jueves']}}">
<input id="viernes" type="hidden" name="" value="{{$days_hide['viernes']}}">
<input id="sabado" type="hidden" name="" value="{{$days_hide['sabado']}}">
<input id="domingo" type="hidden" name="" value="{{$days_hide['domingo']}}">

<input id="max_lunes" type="hidden" name="" value="{{$lunes_libre_start = '11:30'}}">
<input id="max_lunes" type="hidden" name="" value="{{$lunes_libre_end = '13:30'}}">

<input id="max_hour" type="hidden" name="" value="{{$max_hour}}">
<input id="min_hour" type="hidden" name="" value="{{$min_hour}}">

@endisset


  @endsection
  {{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

  @section('scriptJS')
  {{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}">

  </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
  <script type="text/javascript">

  $('document').ready(function(){
    questions_labs();
  });

  function questions_labs(){
    route = "{{route('questions_labs')}}";

    patient_id = "{{$patient->id}}";

    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'post',
      url: route,
      data:{patient_id:patient_id},
      success:function(result){
        $('#list_questions_labs').empty().html(result);
        console.log(result);

      },
      error:function(error){
        console.log(error);
      },
    });
  }


  </script>





  @endsection
