





///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////
///////////////////////////////////NOOOOOOOOOOOOOOOO SIRVEEEEEEEEEEe//////////






















@extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style media="screen">
    .fc-toolbar{
      background: rgb(226, 179, 58);
    }
</style>
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
              <h1 class="text-center">//En Desarrollo//</h1>
              <h2 class="text-center font-title">Editar Cita: {{$app->title}},Paciente: {{$patient->name}} {{$patient->lastName}}XXXXXXXXXXXXXXXXXXXXXXXXXXxxx</h2>
            </div>
          </div>

          </div>
          <div class="text-right mt-2 mb-2">
            <button type="button" onclick="modal()" name="button" class="btn btn-info">Ayuda</button>
          </div>
          {{-- MENU DE PACIENTES --}}
          {{-- @include('medico.includes.main_medico_patients') --}}
          {{-- <div class="alert-info p-3 m-2" style="display:none" id="alert_carga5">
            Procesando...
          </div> --}}

          <div class="col-12">
            @if($app->state == 'Rechazada/Cancelada')
              <div class="alert-danger p-3 m-2" id="procesando">
                <h5>La Cita con el paciente {{$patient->name}} {{$patient->lastName}} estipulada para la fecha {{$app->start}} fue Rechazada/Cancelada. </h5>
                <p>Las citas "Rechazadas o Canceladas no pueden ser editadas, ni se mostraran en la agenda, para ver una cita de este tipo puede ir al panel "Citas" y seleccionar el boton "Citas Rechazadas/Canceladas"</p>
              </div>
            @else
              @include('medico.includes.card_edit_noti')
            @endif
            @include('medico.includes.alert_calendar')
          </div>
          <hr>
          <div class="" id="example">
            {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}
          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}
          <div id='calendar' style=""></div>
          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
        {{-- IF SHOW CALENDAR --}}
            </div>
          </div>
        <div class="col-12 col-lg-3">
      </div>
    </div>
  </div>

{{-- <button onclick="filtrar()" type="button" name="button">Filtrar</button> --}}

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

<input type="hidden" name="" value="{{\Carbon\Carbon::parse($app->start)->format('m-d-Y')}}" id="date_edit">


<!-- Modal -->
<div class="modal fade" id="modal_ayuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLongTitle">Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Confirmar Cita</h5>
        <p>Al presionar el boton confirmar cita, estaras confirmando tu disponibilidad para la misma, simultaneament se enviara de forma automatica un correo al paciente para notificar la confirmación de la cita.</p>
        <h5>Rechazar Cita</h5>
          <p>El Boton Rechazar Cita te permite cancelar una cita, esta quedara registrada en el panel de citas canceladas, al cancelar una cita se enviara un correo electronico de notificacion al paciente para notificarle sobre este cambio.</p>
        <h5>Editar Citas</h5>
        <p>Puedes editar las citas en cualquier momento,entre los cambios que puedes realizar se encuentran los siguientes.</p>
        <h5>Cambiar Fecha</h5>
        <p>Puedes cambiar la fecha y la hora de la cita en cualquier momento,siempre y cuando este disponible segun tu agenda, que puedes verificar en el calendario, si modificas la fecha al momento de guardar los cambios se enviara un mensaje de notificacion al paciente, para hacerle saber el cambio de la cita, con un link al q podra ingresar para confirmar su disponibilidad</p>
        <h5>Estado de la Cita</h5>
        <p>Esta opcion te permitira marcar el estado de la cita, como pendiente, pagada o cobrada y cerrada
         </p>
        <h5>Tipo de Pago</h5>
        <p>Puedes cambiar el tipo de pago, esto en caso de que el cliente al comunicarse con usted solicite este cambio, y asi pueda registrarlo en el sistema.</p>
        <h5>Confirmacion del Paciente</h5>
        <p>es posible agregar la confirmacion del paciente, en caso de que el paciente confirme su pago a travez de un metodo ageno al correo electronico, permitiendole registrar este cambio por usted mismo</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>

{{Form::hidden('change_date','',['id'=>'change_date'])}}
@endisset


  @endsection
  {{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

  @section('scriptJS')
  {{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
  <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
  <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
  <script src='{{asset('fullcalendar/locale/es.js')}}'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
  <script type="text/javascript">



  $("#rechazar").click(function() {
    $('#procesando').fadeIn();
    variable = confirm('Esta a punto de Cancelar esta Cita, se enviara un mesaje notificacando al paciente sobre la cancelacion de la misma, ¿Esta segur@ de Continuar?');
    if(variable == false){
      return false;
    }
    event_id = "{{$app->id}}";
    route = "{{route('appointment_cancel',$app->id)}}";
    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url:route,
     data:{event_id:event_id},
        error:function(error){
           console.log(error);
        },
        success:function(result){
          $('#change_date').val(result)
          $('#procesando').fadeOut();
          // $('#text_danger').html(result.danger);
          // $('#alert_danger_up1').fadeIn();
          window.location.replace("{{route('edit_appointment',['m-id'=>$medico->id,'p_id'=>$patient->id,'app_id'=>$app->id])}}");
      }
    });
  });

  $("#dateStartUp1").change(function() {
    dateStart = $('#dateStartUp1').val();
    hourStart = $('#hourStartUp1').val();
    minsStart = $('#minsStartUp1').val();
    event_id = "{{$app->id}}"
    route = '{{route('verify_change_date')}}';
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{dateStart:dateStart,hourStart:hourStart,minsStart:minsStart,event_id:event_id},
            error:function(error){
               console.log(error);
            },
            success:function(result){
              $('#change_date').val(result)
          }
        });
  });




  $("#hourStartUp1").change(function() {
    dateStart = $('#dateStartUp1').val();
    hourStart = $('#hourStartUp1').val();
    minsStart = $('#minsStartUp1').val();
    event_id = "{{$app->id}}"
    route = '{{route('verify_change_date')}}';
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{dateStart:dateStart,hourStart:hourStart,minsStart:minsStart,event_id:event_id},
            error:function(error){
               console.log(error);
            },
            success:function(result){
              $('#change_date').val(result)

          }
        });
  });
  $("#minsStartUp1").change(function() {
    dateStart = $('#dateStartUp1').val();
    hourStart = $('#hourStartUp1').val();
    minsStart = $('#minsStartUp1').val();
    event_id = "{{$app->id}}"
    route = '{{route('verify_change_date')}}';
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{dateStart:dateStart,hourStart:hourStart,minsStart:minsStart,event_id:event_id},
            error:function(error){
               console.log(error);
            },
            success:function(result){
              $('#change_date').val(result)

          }
        });
  });

    function modal(){
      $('#modal_ayuda').modal('show');
    }


    $(document).ready(function(){

     //  $('#form, #fo3').submit(function() {
     // // Enviamos el formulario usando AJAX
     //
     // change = $('#change_date').val()
     // if(change == 'cambio fecha'){
     //   question = confirm('Se a cambiado la fecha de la cita, se le enviara una correo al pacietne para notificarle acerca del cambio, ¿Desea continuar?')
     //   if(question == false){
     //      return false;
     //   }
     // }
     //
     // $('#procesando').fadeIn();
     //       $.ajax({
     //           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     //           type: 'POST',
     //           url: $(this).attr('action'),
     //           data: $(this).serialize(),
     //           // Mostramos un mensaje con la respuesta de PHP
     //           success: function(data) {
     //             console.log(data);
     //               $('#procesando').fadeOut();
     //               if(data == 'ya existe'){
     //                 alert('Imposible Guardar cambios, ya existe un evento que abarca parte o total de las horas seleccionadas.');
     //               }else if(data == 'fuera del horario'){
     //                 alert('Imposible Guardar cambios, la Fecha o las Horas escogidas estan Fuera del Horario disponible en tu agenda, verifica el calendario e intenta nuevamente.');
     //               }else if(data == 'fecha_editada') {
     //                 $('#text_success_1').html('Se ha cambiado la "Hora/Fecha" de la consulta con Exito. Se ha enviado un correo al Paciente para notificarle del cambio de la consulta, y permitirle confirmar su disponibilidad con respecto a la nueva Fecha/Hora de la Consulta.');
     //                 $('#alert_success_1').fadeIn();
     //
     //
     //               }
     //           }
     //       })
     //
     //       return false;
     //   });


      date_edit = $('#date_edit').val();
      date_ini_format = moment(date_edit).format('YYYY-MM-DD');
      // alert(date_ini_format);
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
        defaultDate: date_ini_format,

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



      });
  });



      function newConsultation(){
        $('#eventType').val('Consulta Medica');
        $('#ModalCreate').modal('show');
      }
      function medicalAppointment(){
        $('#eventType').val('Cita Medica');
        $('#ModalCreate').modal('show');
      }

    // desactivar botones
    // ,
    //        	viewRender: function(currentView){
    //       		var minDate = moment(),
    //       		maxDate = moment().add(6,'days');
    //       		// Past
    //       		if (minDate >= currentView.start && minDate <= currentView.end) {
    //             $(".fc-prev-button").hide();
    //       			// $(".fc-prev-button").prop('disabled', true);
    //       			// $(".fc-prev-button").addClass('fc-state-disabled');
    //       		}
    //       		else {
    //       			$(".fc-prev-button").removeClass('fc-state-disabled');
    //       			$(".fc-prev-button").prop('disabled', false);
    //       		}
    //       		// Future
    //       		if (maxDate >= currentView.start && maxDate <= currentView.end) {
    //               $(".fc-next-button").hide();
    //       			// $(".fc-next-button").prop('disabled', true);
    //       			// $(".fc-next-button").addClass('fc-state-disabled');
    //       		} else {
    //       			$(".fc-next-button").removeClass('fc-state-disabled');
    //       			$(".fc-next-button").prop('disabled', false);
    //       		}
    //       	}





    function cerrar(){
      $('#alert_error').fadeOut();
      $('#alert_success').fadeOut();
      $('#alert_success_up1').fadeOut();
      $('#alert_error_up1').fadeOut();
      $('#alert_success_up1').fadeOut();
      $('#alert_danger_up1').fadeOut();
      $('#alert_success_1').fadeOut();


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


    function store_event(){
      title = $('#title4').val();
      description = $('#description2').val();
      date_start = $('#date_start2').val();
      hourStart = $('#hourStart2').val();
      minsStart = $('#minsStart2').val();
      dateEnd = $('#date_end3').val();
      hourEnd = $('#hourEnd2').val();
      minsEnd = $('#minsEnd2').val();

      patient_id = "{{$patient->id}}";
			medico_id = "{{$medico->id}}";
      route = "{{route('appointment_store')}}";
      errormsj = '';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{title:title,description:description,date_start:date_start,hourStart:hourStart,minsStart:minsStart,dateEnd:dateEnd,hourEnd:hourEnd,minsEnd:minsEnd,medico_id:medico_id,patient_id:patient_id},
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
				console.log(result);
        if(result == 'fuera del horario'){
          $('#text_error').html('Imposible crear evento fuera del horario establecido');
          $('#alert_error').fadeIn();
          $('#alert_success').fadeOut();
        }else{
          console.log(result);
          $('#text_success').html('Guardado con Exito');
          $('#alert_success').fadeIn();
          $('#alert_error').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');
					$('#text_success_1').html(result);
					$('#alert_success_1').fadeIn();
        }

      }
    });

    }

    function close_edit(){

      $('#card_edit').fadeOut();
      vaciar2();
    }

    function update_event(){

      title = $('#titleUp1').val();
      eventType = $('#eventTypeUp1').val();
      description = $('#descriptionUp4').val();
      price = $('#priceUp1').val();
      date_start = $('#dateStartUp1').val();
      hourStart = $('#hourStartUp1').val();
      minsStart = $('#minsStartUp1').val();
      startFormatHour = $('#startFormatHour3').val();
      dateEnd = $('#dateEndUp1').val();
      hourEnd = $('#hourEndUp1').val();
      minsEnd = $('#minsEndUp1').val();
      endFormatHour = $('#endFormatHour2').val();
      state = $('#state').val();

      medico_id = "{{$medico->id}}";
      event_id = $('#event_id2').val();


      route = "{{route('update_event')}}";
      errormsj = '';

      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{title:title,eventType:eventType,description:description,price:price,date_start:date_start,hourStart:hourStart,minsStart:minsStart,startFormatHour:startFormatHour,dateEnd:dateEnd,hourEnd:hourEnd,minsEnd:minsEnd,endFormatHour:endFormatHour,medico_id:medico_id,event_id:event_id,state:state},
       error:function(error){

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

        if(result == 'fuera del horario'){
          $('#text_error_up1').html('imposible guardar evento, fuera del horario establecido');
          $('#alert_error_up1').fadeIn();
        }else {
          console.log(result);
          close_edit();
          $('#text_success_up1').html('Guardado con Exito');
          $('#alert_success_up1').fadeIn();
          $('#alert_error_up1').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');

        }

      }
    });

    }

    function delete_event(){
      question = confirm('¿Esta segur@ de Borrar este Evento?');
      if(question == false){
       exit();
     }
      event_id = $('#event_id2').val();


      route = "{{route('delete_event')}}";
      errormsj = '';

      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{event_id:event_id},
       error:function(error){
         console.log(error);
      },
      success:function(result){
        console.log(result);
        $('#text_danger_up1').html(result);
        $('#alert_danger_up1').fadeIn();

        $('#alert_error_up1').fadeOut();
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        close_edit();
      }
    });

    }




    function filtrar(filtro){
      $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
      test = 1;
      route = '{{route('medico_diary_events2',$medico->id)}}';
          $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type:'post',
           url:route,
           data:{test:test},
              error:function(error){
                 console.log(error);
              },
              success:function(result){
                $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                    if(value.eventType == 'Consulta Medica Importante' || value.rendering == 'background'){
                        $("#calendar").fullCalendar('renderEvent', value, true);
                    }
                });

          }
          });

      }

      function filtroDisponible(filtro){
        $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
        test = 1;
        route = '{{route('medico_diary_events2',$medico->id)}}';
            $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type:'post',
             url:route,
             data:{test:test},
                error:function(error){
                   console.log(error);
                },
                success:function(result){
                  $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                      if(value.state != 'Cancelada' & value.state != 'Cerrada y Cobrada'){
                          $("#calendar").fullCalendar('renderEvent', value, true);
                      }
                  });

            }
            });

        }

        function filtroCitaPorInternet(){
          $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
          test = 1;
          route = '{{route('medico_diary_events2',$medico->id)}}';
              $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type:'post',
               url:route,
               data:{test:test},
                  error:function(error){
                     console.log(error);
                  },
                  success:function(result){
                    $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                        if(value.eventType == 'Cita por Internet'){
                            $("#calendar").fullCalendar('renderEvent', value, true);
                        }
                    });

              }
              });

          }


          function  CerradaYCobrada(){
            $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
            test = 1;
            route = '{{route('medico_diary_events2',$medico->id)}}';
                $.ajax({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 type:'post',
                 url:route,
                 data:{test:test},
                    error:function(error){
                       console.log(error);
                    },
                    success:function(result){
                      $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                          if(value.state == 'Cerrada y Cobrada'){
                              $("#calendar").fullCalendar('renderEvent', value, true);
                          }
                      });

                }
                });

            }



function  PendientePorCobrar(){
  $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
  test = 1;
  route = '{{route('medico_diary_events2',$medico->id)}}';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{test:test},
          error:function(error){
             console.log(error);
          },
          success:function(result){
            $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                if(value.state == 'Pendiente'){
                    $("#calendar").fullCalendar('renderEvent', value, true);
                }
            });

      }
      });

  }


  function  FiltroPacienteCancelo(){
    $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
    test = 1;
    route = '{{route('medico_diary_events2',$medico->id)}}';
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{test:test},
            error:function(error){
               console.log(error);
            },
            success:function(result){
              $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                  if(value.state == 'Pagada'){
                      $("#calendar").fullCalendar('renderEvent', value, true);
                  }
              });

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

    // function cargando(){
    //   $( "#guardar" ).prop( "disabled", true );
    //   $( "#alert" ).fadeIn();
    //   confirm('si');
    // }






  </script>





  @endsection
