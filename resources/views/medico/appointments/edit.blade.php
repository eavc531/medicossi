@extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<style media="screen">
.fc-event {
    border-width: 1px;
}

.fc-toolbar{
  background: rgb(231, 174, 98);
}
</style>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-12">
          <div class="row">
            <div class="col-12">
               <h3 class="text-center font-title">Editar Cita: {{$event_edit->title}} {{\Carbon\Carbon::parse($event_edit->date_start)->format('d-m-Y')}}, Paciente: {{ $event_edit->namePatient}}</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>
          <div class="alert-info p-3 m-2" style="display:none" id="alert_carga5">
            Procesando...
          </div>

          <hr>
          {{-- //busqueda --}}
          @if($countEventSchedule != 0)


          @endif
          @include('medico.includes.alert_calendar')
          @include('medico.appointments.card_edit_include_edit')
          @include('medico.includes.modals_diary')
          {{-- // --}}

          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}
          @if($countEventSchedule != 0)

          <div id='calendar' style=""></div>
          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}

        @else
          <div class="card mt-5 mb-5">
            <div class="card-header">
              <h4>Bienevenido al Panel Mi Agenda</h4>
            </div>
            <div class="card-body">
              <h5>Para poder ver el Calendario de agenda y todas sus fucniones debe Otorgar un Horario de Trabajo</h5>
              <a href="{{route('medico_schedule',$medico->id)}}" class="btn btn-primary">Otorgar un Horario de Trabajo</a>
            </div>
          </div>
        @endif
        {{-- IF SHOW CALENDAR --}}
    </div>
          {{-- </div> --}}
        <div class="col-12 col-lg-3">

        </div>
      </div>
    </div>
  {{-- </div> --}}



{{-- <button onclick="filtrar()" type="button" name="button">Filtrar</button> --}}
{{-- <input type="text" name="" value="" id="input1"> --}}

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
<div class="modal fade" id="info1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Como agendar una cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h5 class="font-title-grey">¿Como Agendar Cita con un Paciente Registrado?</h5>
        <p>Para agendar cita, debe buscar medico a travez del filtro "Agendar con" ubicado en la parte superior de la agenda, o seleccionar en la barra lateral izquierda la opcion "Mis Pacientes",seleccionar el
        paciente al que desea agendar la consulta, y luego hacer click en el boton "Agendar cita", con esto se abrira el panel correspondiente para agendar cita con el paciente seleccionado.</p>

        <h5 class="font-title-grey">Mi Agenda</h5>
        <p>El Panel mi Agenda le permite organizar sus eventos, y filtrarlos segun su tipo, tambien puede editar los eventos creados previamente; al hacer click sobre ellos se abrira una ventana que contendra la informacion de los mismos, en esta ventana podra modificar los datos del evento seleccionado, o eliminar el evento por completo.</p>

        <h5 class="font-title-grey">Horario</h5>
        <p>Las Horas disponibles del médico se marcan en el calendario con el color verde claro.</p>
        <div class="" style="width:40px;height:40px; border:solid black 1px;background:rgba(162, 231, 50, 0.64);border-radius:5px"></div>
        <p>El Horario de trabajo puede ser modificado, al presionar el boton editar de la tabla "Horario de trabajo" justo debado del calendario.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
{{-- modal marcar como pagado --}}
<div class="modal fade" id="confirmed_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><h5>¿Que desea realizar?</h5></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p>Si marca la cita como "pagada", el precio establecido no podra ser editado, es importante que el precio agregado a la cita sea real, para mostrar sus ingresos de forma correcta</p>
        <div class="text-center">
          <h5>Marcar Cita como:</h5>
        </div>

        <div class="row">
          <div class="col-6">
            <button onclick="confirmed_payment_app()" type="button" name="button" class="btn btn-info btn-block">Pagada</button>

          </div>
          <div class="col-6">
            <button onclick="confirmed_completed()" type="button" name="button" class="btn btn-warning btn-block">Pagada y Completada</button>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>

  {{Form::hidden('','Ninguno',['id'=>'filtro_state'])}}
  {{Form::hidden('filtro_title','Ninguno',['id'=>'filtro_title'])}}
  {{Form::hidden('filtro_payment_method','Ninguno',['id'=>'filtro_payment_method'])}}

  @endsection
  {{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

  @section('scriptJS')
  {{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
  <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
  <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
  <script src='{{asset('fullcalendar/locale/es.js')}}'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
  <script type="text/javascript">



  function confirmed_payment_or_completed(){
    if($('#price9').val().length == 0){
      alert('Para marcar esta Cita como pagada, debe añadir el precio de la misma.El precio real de la cita es necesario para poder llevar el registro de los ingresos de forma correcta.');
      return false;
    }
    $('#confirmed_payment').modal('show');
  }

  function confirmed_completed(){
    price = $('#price9').val();

    // medico_id = "{{$medico->id}}";
    event_id = $('#event_id9').val();
    route = "{{route('confirmed_completed_app')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'get',
      url: route,
      data:{price:price,event_id:event_id},
      success:function(result){
        $('#text_success_up1').html('Se a marcado el Cita como Completada');
        $('#alert_success_up1').fadeIn();
        $('#price9').attr('readonly',true);
        $('#button_confirmed_payment').hide();
        $('#button_confirmed_complete').show();
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        $('#confirmed_patient9').attr('disabled',true);
        $('#confirmed_medico9').attr('disabled',true);
        $('#price9').attr('disabled',true);
        $('#title9').attr('disabled',true);
        $('#state9').attr('disabled',true);
        $('#description9').attr('disabled',true);
        $('#eventType9').attr('disabled',true);
        $('#payment_method9').attr('disabled',true);
        $('#dateStart9').attr('disabled',true);
        $('#hourStart9').attr('disabled',true);
        $('#minsStart9').attr('disabled',true);
        $('#dateEndU9').attr('disabled',true);
        $('#hourEnd9').attr('disabled',true);
        $('#minsEnd9').attr('disabled',true);
        $('#event_id9').attr('disabled',true);
        $('#event_id9').attr('disabled',true);
        $('#event_id_destroy9').attr('disabled',true);
        $('#namePatient9').attr('disabled',true);
        $('#payment_state9').attr('disabled',true);
        $('#confirmed_payment').modal('hide');
        $('#rechazar').hide();
        $('#button_confirmed_payment').hide();
        $('#button_confirmed_complete').hide();
        $('#but_save').hide();
        $('#payment_state9').val('Si');

      },
      error:function(error){
        $('#confirmed_payment').modal('hide');
       console.log(error);
     },
  });
  }

  function confirmed_payment_app(){

    price = $('#price9').val();
    // medico_id = "{{$medico->id}}";
    event_id = $('#event_id9').val();
    route = "{{route('confirmed_payment_app')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'get',
      url: route,
      data:{price:price,event_id:event_id},
      success:function(result){
        $('#text_success_up1').html('Se a marcado el Cita como Pagada');
        $('#alert_success_up1').fadeIn();
        console.log(result);
        $('#price9').attr('readonly',true);
        $('#button_confirmed_payment').hide();
        $('#button_confirmed_complete').show();
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        $('#confirmed_payment').modal('hide');
      },
      error:function(error){
        $('#confirmed_payment').modal('hide');
       console.log(error);
     },
  });
  }


    function switch_payment_and_past(result){

      medico_id = "{{$medico->id}}";
      options = result;
      route = "{{route('switch_payment_and_past')}}";
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: route,
        data:{medico_id:medico_id,options:options},
        // Mostramos un mensaje con la respuesta de PHP
        success:function(result){
          console.log(result);
        },
        error:function(error){
         console.log(error);
       },
    });
    }

    $(document).ready(function(){

        ajax_data_edit_event();


      $('#form, #fo3').submit(function(){

          if($('#dateStart99').val() != $('#dateStart9').val() || $('#hourStart99').val() != $('#hourStart9').val() || $('#minsStart99').val() != $('#minsStart9').val() || $('#hourEnd99').val() != $('#hourEnd9').val() || $('#minsEnd99').val() != $('#minsEnd9').val()){
              question = confirm('Se ha modificado la fecha de la consulta, al guardar cambio se enviara un correo al paciente para notificarle, ¿desea continuar?');
              if(question == false){
                  return false;
              }
          }
        loader();
        cerrar();
        $('#alert_carga5').fadeIn();
        $('#guardar5').attr("disabled", true);
        $('#delete5').attr("disabled", true);
        $('#cancelar5').attr("disabled", true);
        errormsj = '';
             $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type: 'POST',
               url: $(this).attr('action'),
               data: $(this).serialize(),
               // Mostramos un mensaje con la respuesta de PHP
               error:function(error){
                 stop_loader();
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
               success:function(result){
                 stop_loader();
                 console.log(result);
                 $('#alert_carga5').fadeOut();
                 $('#guardar5').attr("disabled", false);
                 $('#delete5').attr("disabled", false);
                 $('#cancelar5').attr("disabled", false);

                 if(result == 'fuera del horario'){
                   $('#text_error_up1').html('imposible guardar evento, fuera del horario establecido');
                   $('#alert_error_up1').fadeIn();
                 }else if(result == 'fecha_editada'){
                   $('#text_success_up1').html('Se ha cambiado la "Hora/Fecha" de la consulta con Exito. Se ha enviado un correo al Paciente para notificarle del cambio de la consulta.');
                   $('#alert_success_up1').fadeIn();
                   $('#calendar').fullCalendar('removeEvents');
                   $('#calendar').fullCalendar('refetchEvents');
                   // $('#card_edit').fadeOut();
               }else if(result == 'end menor start'){
                     $('#text_error_up1').html('imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
                     $('#alert_error_up1').fadeIn();
                 }else if(result == 'ya existe'){
                   $('#text_error_up1').html('Imposible actualizar evento,Ya existe un Evento en las horas seleccionadas, por favor compruebe la fecha en el calendario e intente nuevamente');
                   $('#alert_error_up1').fadeIn();
                   $('#alert_success').fadeOut();

                 }else {
                   console.log(result);
                   // $('#card_edit').fadeOut();
                   $('#text_success_up1').html('Guardado con Exito');
                   $('#alert_success_up1').fadeIn();
                   $('#alert_error_up1').fadeOut();
                   $('#calendar').fullCalendar('removeEvents');
                   $('#calendar').fullCalendar('refetchEvents');
                   var1 = $('#dateStart9').val();
                   var2 = $('#hourStart9').val();
                   var3 = $('#minsStart9').val();
                   $('#dateStart99').val(var1);
                   $('#hourStart99').val(var2);
                   $('#minsStart99').val(var3);
                 }

               }

           })

           return false;
       });

      max_hour = $('#max_hour').val();
      min_hour = $('#min_hour').val();

      lunes = $('#lunes').val();
      martes = $('#martes').val();
      miercoles = $('#miercoles').val();
      jueves = $('#jueves').val();
      vierness = $('#vierness').val();
      sabado = $('#sabado').val();
      domingo = $('#domingo').val();

      if(lunes == 1){
        lunes = 1;
      }
      martes = $('#martes').val();
      if(martes == 2){
        martes = 2;
      }
      miercoles = $('#miercoles').val();
      if(miercoles == 3){
        miercoles = 3;
      }
      jueves = $('#jueves').val();
      if(jueves == 4){
        jueves = 4;
      }
      viernes = $('#viernes').val();
      if(viernes == 5){
        viernes = 5;
      }
      sabado = $('#sabado').val();
      if(sabado == 6){
        sabado = 6;
      }
      domingo = $('#domingo').val();
      if(domingo == 0){
        domingo = 0;
      }

        //comentario fc
    // function calendario(){
      $('#calendar').fullCalendar({

        header: {
          left: 'prev,next today myCustomButton',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listWeek'
        },
        // defaultDate: '2018-03-12',
        defaultView: 'agendaWeek',
        eventStartEditable: false, //desabilita el arrastre
        eventDurationEditable: false,//desabilita el estiramiento
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true, //permite seleccionar campos
        selectHelper: true, //permite agregar nuevos eventos
        maxTime:max_hour,
        minTime:min_hour,
        hiddenDays: [lunes,martes,miercoles,jueves,viernes,sabado,domingo],

        slotDuration: '00:15:00',
        slotLabelInterval: 15,
        // slotLabelFormat: 'h(:mm)a',

        select:function(start,end){
         start = moment(start);
         end = moment(end);
         day = start.format('d');
         hour_start = start.format('HH:mm');
         hour_end = end.format('HH:mm');
         route = "{{route('compare_hours',$medico->id)}}";

         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:'post',
          url:route,
          data:{hour_start:hour_start,hour_end:hour_end,day:day},
          error:function(error){
            console.log(error);
         },
         success:function(result){
           if(result == 'fuera de horario'){
             alert('Imposible editar campo, esta establecido como horas no laborales.')
             return;
           }else{
             $('#hourStart2').val(start.format('HH'));
             $('#minsStart2').val(start.format('mm'));
             $('#date_start2').val(start.format('YYYY-MM-DD'));
             $('#date_end3').val(end.format('YYYY-MM-DD'));
             $('#minsEnd2').val(end.format('mm'));
             $('#hourEnd2').val(end.format('HH'));
             parpadeo();
           }
         }
       });

         //$('#ModalCreate').modal('show');
         //alert(start.format('YYYY-MM-DD'));
        },

        events:"{{route('medico_diary_events',$medico->id)}}",

        eventClick: function(event, jsEvent, view){
            alert('Este panel es exclusivo solo para editar citas pre-seleccionadas, para editar todas las citas de modo libre acceda al panel "Mi Agenda"');
        },

        eventRender: function (event, element, view) {


          if(event.id == "{{$event_edit->id}}"){
            element.find('.fc-title').html('<div class="hr-line-solid-no-margin text-center" style="background:red;border-radius:2px;color:white;">Editando</div>');
          }else{
            element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">'+event.namePatient+'</span><span style="font-size: 10px"><p style="font-size: 10px">'+event.description+'</p></span>');
          }
        },
            });
  });

  function filtro_state(result){
    $('#filtro_state').val(result);
    $('#filtro_title').val('Ninguno');
    $('#filtro_payment_method').val('Ninguno');
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('refetchEvents');
  }

  function filtro_title(result){
    $('#filtro_title').val(result);
    $('#filtro_state').val('Ninguno');
    $('#filtro_payment_method').val('Ninguno');
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('refetchEvents');
  }

  function filtro_payment_method(result){
    $('#filtro_payment_method').val(result);
    $('#filtro_state').val('Ninguno');
    $('#filtro_title').val('Ninguno');
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('refetchEvents');
  }


  function filtro_todas(){
    $('#filtro_title').val('Ninguno');
    $('#filtro_state').val('Ninguno');
    $('#filtro_payment_method').val('Ninguno');
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('refetchEvents');
  }

      function newConsultation(){
        $('#eventType').val('Consulta Medica');
        $('#ModalCreate').modal('show');
      }
      function medicalAppointment(){
        $('#eventType').val('Cita Medica');
        $('#ModalCreate').modal('show');
      }

    function cerrar(){

      $('#alert_error').fadeOut();
      $('#alert_success').fadeOut();
      $('#alert_success_up1').fadeOut();
      $('#alert_error_up1').fadeOut();
      $('#alert_success_up1').fadeOut();
      $('#alert_danger_up1').fadeOut();

      vaciar2();
    }

    function vaciar(){
      title = $('#title2').val("");
      eventType = $('#eventType2').val("");
      description = $('#description2').val("");
      price = $('#price2').val("");
      date_start = $('#date_start2').val("");
      hourStart = $('#hourStart2').val("");
      minsStart = $('#minsStart2').val("");
      startFormatHour = $('#startFormatHour3').val("");
      dateEnd = $('#date_end3').val("");
      hourEnd = $('#hourEnd2').val("");
      minsEnd = $('#minsEnd2').val("");
      endFormatHour = $('#endFormatHour2').val("");
      $('#alert_error').fadeOut();
    }

    function vaciar2(){
      title = $('#titleUp1').val("");
      eventType = $('#eventTypeUp1').val("");
      description = $('#descriptionUp4').val("");
      price = $('#priceUp1').val("");
      date_start = $('#dateStartUp1').val("");
      hourStart = $('#hourStartUp1').val("");
      minsStart = $('#minsStartUp1').val("");
      startFormatHour = $('#startFormatHour3').val("");
      dateEnd = $('#dateEndUp1').val("");
      hourEnd = $('#hourEndUp1').val("");
      minsEnd = $('#minsEndUp1').val("");
      endFormatHour = $('#endFormatHour2').val("");
      event_id = $('#event_id2').val("");
    }



      $('#form_event').submit(function() {

      title = $('#title2').val();
      eventType = $('#eventType2').val();
      description = $('#description2').val();
      price = $('#price2').val();
      date_start = $('#date_start2').val();
      hourStart = $('#hourStart2').val();
      minsStart = $('#minsStart2').val();
      startFormatHour = $('#startFormatHour3').val();
      dateEnd = $('#date_end3').val();
      hourEnd = $('#hourEnd2').val();
      minsEnd = $('#minsEnd2').val();
      endFormatHour = $('#endFormatHour2').val();
      medico_id = "{{$medico->id}}";
      errormsj = '';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url: $(this).attr('action'),
       data: $(this).serialize(),
       error:function(error){
         console.log(error);
        $.each(error.responseJSON.errors, function(index, val){
          errormsj+='<li>'+val+'</li>';
        });
        $('#text_error').html('<ul style="list-style:none;">'+errormsj+'</ul>');
        $('#alert_error').fadeIn();
        $('#alert_success').fadeOut();

        console.log(errormsj);

      },
      success:function(result){
          alert(result);
        if(result == 'fuera del horario'){
          $('#text_error').html('Imposible crear evento fuera del horario establecido');
          $('#alert_error').fadeIn();
          $('#alert_success').fadeOut();
        }else if(result == 'ya existe'){
          $('#text_error').html('Imposible crear evento,Ya existe un Evento en las horas seleccionadas, por favor compruebe la fecha en el calendario e intente nuevamente');
          $('#alert_error').fadeIn();
          $('#alert_success').fadeOut();
      }else if(result == 'end menor start'){
            $('#text_error_up1').html('imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
            $('#alert_error_up1').fadeIn();
        }else{
          console.log(result);
          $('#text_success').html('Guardado con Exito');
          $('#alert_success').fadeIn();
          $('#alert_error').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');
        }

      }
    });
      return false;
    });

    function cancel(result){
        loader();
        $('#mail_cancel').modal('hide');
      cerrar();
     //  question = confirm('Esta a punto de Rechazar/Cancelar esta Cita,se enviara un corredo al paciente para notificarle de este suceso,¿Esta segur@ de Continuar?.');
     //  if(question == false){
     //   return false;
     // }
     send = result;
     $('#alert_carga5').fadeIn();
     $('#guardar5').attr("disabled", true);
     $('#delete5').attr("disabled", true);
     $('#cancelar5').attr("disabled", true);
      event_id = $('#event_id9').val();

      route = "{{route('cancel_appointment')}}";
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{event_id:event_id,send:send},
       error:function(error){
           stop_loader();
         console.log(error);
      },
      success:function(result){
           stop_loader();
        console.log(result);
        $('#alert_carga5').fadeOut();
         $('#guardar5').attr("disabled", false);
         $('#delete5').attr("disabled", false);
         $('#cancelar5').attr("disabled", false);
        $('#text_danger_up1').html(result);
        $('#alert_danger_up1').fadeIn();
        $('#alert_error_up1').fadeOut();
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        $('#card_edit').fadeOut();
      }
    });

    }

    function confirmar2(){

      cerrar();
      $('#alert_carga5').fadeIn();
      $('#guardar5').attr("disabled", true);
      $('#delete5').attr("disabled", true);
      $('#cancelar5').attr("disabled", true);
      event_id = $('#event_id9').val();

      route = "{{route('appointment_confirm_ajax')}}";
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{event_id:event_id},
       error:function(error){
         console.log(error);
      },
      success:function(result){
        $('#alert_carga5').fadeOut();
         $('#guardar5').attr("disabled", false);
         $('#delete5').attr("disabled", false);
         $('#cancelar5').attr("disabled", false);
        console.log(result);
        cerrar();
        $('#text_success_up1').html(result);
        $('#alert_success_up1').fadeIn();
        $('#alert_error_up1').fadeOut();
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        // $('#card_edit').fadeOut();
      }
    });

    }



    function parpadeo(){

        $("#hourStart2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#minsStart2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#date_start2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#date_end3").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#minsEnd2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#hourEnd2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
    }


    function cerrar_edit(){
      $("#card_edit").fadeOut();
      cerrar();
    }



    $('#input_search').keyup(function(){
      medico_id = "{{$medico->id}}";
      search = $('#input_search').val();
      route = "{{route('search_patients_diary')}}";
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{search:search,medico_id:medico_id},
         error:function(error){
           console.log(error);
        },
        success:function(result){
          $('#result_search').html(result);
          $('#result_search').show();
          if(search.length == 0){
            $('#result_search').hide();
          }
          console.log(result);
          cerrar();

        }
      });
    });

      function search_medic(){

      medico_id = "{{$medico->id}}";
      search = $('#input_search').val();
      route = "{{route('search_patients_diary')}}";
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{search:search,medico_id:medico_id},
         error:function(error){
           console.log(error);
        },
        success:function(result){
          $('#result_search').html(result);
          $('#result_search').show();
          if(search.length == 0){
            $("#input_search").fadeTo(200, .2)
            .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
            $('#result_search').hide();
          }
          console.log(result);
          cerrar();

        }
      });
    }

    function vaciar_search(){
      $("#input_search").val('');
      $('#result_search').hide();
    }

    function mail_cancel(){
        $('#mail_cancel').modal('show');
    }

    function ajax_data_edit_event(){
        event_edit = "{{$event_edit->id}}"
        route = "{{route('ajax_data_edit_event')}}"
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{event_edit:event_edit},
         error:function(error){
           console.log(error);
        },
        success:function(event){
            console.log(event);

            var start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
            var end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
            hour_start = $.fullCalendar.moment(event.start).format('HH');
            mins_start = $.fullCalendar.moment(event.start).format('mm');
            hour_end = $.fullCalendar.moment(event.end).format('HH');
            mins_end = $.fullCalendar.moment(event.end).format('mm');

            $('#confirmed_patient9').val(event.confirmed_patient);
            $('#confirmed_medico9').val(event.confirmed_medico);
            $('#price9').val(event.price);
            $('#title9').val(event.title);
            $('#state9').val(event.state);
            $('#description9').val(event.description);
            $('#eventType9').val(event.eventType);
            $('#payment_method9').val(event.payment_method);
            //
            $('#dateStart9').val(start);
            $('#hourStart9').val(hour_start);
            $('#minsStart9').val(mins_start);
            //clones
            $('#dateStart99').val(start);
            $('#hourStart99').val(hour_start);
            $('#minsStart99').val(mins_start);
            ///
            $('#dateEndU9').val(end);
            //
            $('#hourEnd9').val(hour_end);
            $('#minsEnd9').val(mins_end);
            $('#hourEnd99').val(hour_end);
            $('#minsEnd99').val(mins_end);
            //
            $('#event_id9').val(event.id);
            $('#event_id9').val(event.id);
            $('#event_id_destroy9').val(event.id);
            $('#namePatient9').val(event.namePatient);
            $('#payment_state9').val(event.payment_state);



            $('#alert_success_up1').fadeOut();
            vaciar();
            if(event.confirmed_medico == 'Si'){
              $('#but_save').attr('value','Guardar Cambios');
            }else{
              $('#but_save').attr('value','Guardar y Confirmar');
            }

            if(event.state == 'Pagada y Completada'){
              $('#rechazar').hide();
              $('#button_confirmed_payment').hide();
              $('#button_confirmed_complete').hide();
              $('#but_save').hide();
            }else if(event.payment_state == 'Si'){
              $('#price9').attr('readonly',true);
              $('#rechazar').hide();
              $('#button_confirmed_payment').hide();
              $('#button_confirmed_complete').show();
              $('#but_save').show();
            }else{
              $('#rechazar').show();
              $('#price9').attr('readonly',false);
              $('#button_confirmed_payment').show();
              $('#button_confirmed_complete').hide();
              $('#but_save').show();
            }

            if(event.state == 'Pagada y Completada'){
              $('#confirmed_patient9').attr('disabled',true);
              $('#confirmed_medico9').attr('disabled',true);
              $('#price9').attr('disabled',true);
              $('#title9').attr('disabled',true);
              $('#state9').attr('disabled',true);
              $('#description9').attr('disabled',true);
              $('#eventType9').attr('disabled',true);
              $('#payment_method9').attr('disabled',true);
              $('#dateStart9').attr('disabled',true);
              $('#hourStart9').attr('disabled',true);
              $('#minsStart9').attr('disabled',true);
              $('#dateEndU9').attr('disabled',true);
              $('#hourEnd9').attr('disabled',true);
              $('#minsEnd9').attr('disabled',true);
              $('#event_id9').attr('disabled',true);
              $('#event_id9').attr('disabled',true);
              $('#event_id_destroy9').attr('disabled',true);
              $('#namePatient9').attr('disabled',true);
              $('#payment_state9').attr('disabled',true);

            }else{
              $('#confirmed_patient9').attr('disabled',false);
              $('#confirmed_medico9').attr('disabled',false);
              $('#price9').attr('disabled',false);
              $('#title9').attr('disabled',false);
              $('#state9').attr('disabled',false);
              $('#description9').attr('disabled',false);
              $('#eventType9').attr('disabled',false);
              $('#payment_method9').attr('disabled',false);
              $('#dateStart9').attr('disabled',false);
              $('#hourStart9').attr('disabled',false);
              $('#minsStart9').attr('disabled',false);
              $('#dateEndU9').attr('disabled',false);
              $('#hourEnd9').attr('disabled',false);
              $('#minsEnd9').attr('disabled',false);
              $('#event_id9').attr('disabled',false);
              $('#event_id9').attr('disabled',false);
              $('#event_id_destroy9').attr('disabled',false);
              $('#namePatient9').attr('disabled',false);
              $('#payment_state9').attr('disabled',false);

            }

          cerrar();

        }
      });
    }
  </script>





  @endsection
