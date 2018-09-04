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
    @if(Auth::user()->role == 'Asistente')
    <input type="hidden" name="" value="{{Auth::user()->role}}" id="auth_role">

    <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_edit}}" id="cita_edit">
    <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_change_date}}" id="cita_change_date">
    <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_confirm_payment}}" id="cita_confirm_payment">
    <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_confirm_completed}}" id="cita_confirm_completed">
    <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_cancel}}" id="cita_cancel">


    @endif

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-12">
          <div class="row">
            <div class="col-12">
               <h3 class="text-center font-title">Detalles Consulta: {{$event_edit->title}} {{\Carbon\Carbon::parse($event_edit->start)->format('d-m-Y')}}, Paciente: {{ $event_edit->namePatient}}</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>
            <div class="text-right">
                <button onclick="window.history.back();" type="button" name="button" class="btn btn-secondary">Atras</button>

            </div>



          {{-- //busqueda --}}

          @include('medico.includes.alert_calendar')
          @include('medico.appointments.card_edit_ending_app')
          <div class="text-center my-5">
              <h5 class="text-primary">Acciones Realizadas en Consulta</h5>
          </div>

          @if ($tasks->first() != Null)
              <table class="table">
                  <thead>
                          <th>Acción</th>
                          <th>nombre</th>
                          <th>interacción</th>
                  </thead>
                  <tbody>
                      @foreach ($tasks as $value)
                      <tr>
                          @if($value->task == 'Nota Creada dentro de expediente')
                              <td>{{$value->task}}: {{$value->description}}</td>
                          @else
                              <td>{{$value->task}}</td>
                          @endif

                          @if ($value->task == 'Nota Creada')
                              @if($value->note_id == Null)
                                  <td><span class="text-danger">La Nota fue Eliminada</span></td>
                                  <td></td>
                              @else
                                  <td>{{$value->note->title}} {{\Carbon\Carbon::parse($value->note->created_at)->format('d-m-Y H:i')}}</td>
                                  <td><a class="mr-2 btn btn-secondary" href="{{route('view_preview',['m_id'=>\Hashids::encode($value->note->medico_id),'p_id'=>\Hashids::encode($value->note->patient_id),'n_id'=>\Hashids::encode($value->note->id)])}}"><i class="fas fa-eye"></i></a></td>
                              @endif

                          @elseif($value->task == 'Archivo subido')
                              @if($value->file_id == Null)
                                  <td><span class="text-danger">El Archivo fue eliminado</span></td>
                                  <td></td>
                              @else
                                  <td>{{$value->file->name}}</td>
                                  <td> <a onclick="" href="{{route('file_download',Hashids::encode($value->file_id))}}" class="btn btn-info"><i class="fas fa-download"></i></a></td>
                              @endif

                          @elseif($value->task == 'Expediente Creado')
                              @if($value->expedient_id == Null)
                                  <td><span class="text-danger">La Expediente fue Eliminado</span></td>
                                  <td></td>
                              @else
                                  <td>{{$value->expedient->name}}</td>
                                  <td>    <a href="{{route('expedient_preview',\Hashids::encode($value->expedient->id))}}" class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>
                              @endif

                          @elseif($value->task == 'Nota Creada dentro de expediente')
                              @if($value->note_id == Null)
                                  <td><span class="text-danger">La Nota fue Eliminada</span></td>
                                  <td></td>
                              @else
                                  <td>{{$value->note->title}} {{\Carbon\Carbon::parse($value->note->created_at)->format('d-m-Y H:i')}}</td>
                                  <td><a class="mr-2 btn btn-secondary" href="{{route('view_preview',['m_id'=>\Hashids::encode($value->note->medico_id),'p_id'=>\Hashids::encode($value->note->patient_id),'n_id'=>\Hashids::encode($value->note->id)])}}"><i class="fas fa-eye"></i></a></td>
                              @endif

                          @endif

                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="3">{{$tasks->links()}}</td>
                  </tr>
              </tfoot>

              </table>
          @else
              <div class="card">
                  <div class="card-body text-center">
                      <h5 class="text-secondary">No se registran acciones/tareas realizadas en esta consulta</h5>
                      <p class="text-center text-secondary">Las acciones de una consulta son aquellos eventos que se realizan mintras una consulta esta abierta,ejemplo:crear una nota. Es posible marcar una Cita como pagada o completada sin abrir la consulta, por lo que es posible que no se registre ninguna tarea para esta.</p>
                  </div>
              </div>
          @endif



          @include('medico.appointments.modal_cancel_ending')
          {{-- // --}}

          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}
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
  <a href="#" class="btn btn-"></a>

  @endsection
  {{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

  @section('scriptJS')
  {{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
  <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
  <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
  <script src='{{asset('fullcalendar/locale/es.js')}}'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
  <script type="text/javascript">





  function cerrar_pago_pendiente(){
      if($('#price9').val().length == 0){
          alert('Para marcar esta Cita como pagada y completada, debe añadir el precio de la misma.El precio real de la cita es necesario para poder llevar el registro de los ingresos de forma correcta.');
          return false;
        }
        $('#cerrar_cita').val('cerrar_pago_pendiente');
        $('#fo3').submit();
  }

  function cerrar_completada(){
      if($('#price9').val().length == 0){
          alert('Para marcar esta Cita como pagada y completada, debe añadir el precio de la misma.El precio real de la cita es necesario para poder llevar el registro de los ingresos de forma correcta.');
          return false;
        }
        $('#cerrar_cita').val('cerrar_completada');
        $('#fo3').submit();


  }

    $(document).ready(function(){

  });


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





    function cancel(result){
        loader();
        $('#app_cancel').modal('hide');
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



        $('#but_save').hide();
        $('#rechazar').hide();
        // $('#button_confirmed_payment').hide();
        $('#confirmed_completed').hide();





        //
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



    function vaciar_search(){
      $("#input_search").val('');
      $('#result_search').hide();
    }

    function app_cancel(){
        $('#app_cancel').modal('show');
    }

    function ajax_data_edit_event(){

        event_edit = "{{$event_edit->id}}"
        route = "{{route('ajax_ending_event')}}"
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{event_edit:event_edit},
         error:function(error){
           console.log(error);
        },
        success:function(result){
            alert(result);
            console.log(result);

            var start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
            var end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
            hour_start = $.fullCalendar.moment(event.start).format('HH');
            mins_start = $.fullCalendar.moment(event.start).format('mm');
            hour_end = $.fullCalendar.moment(event.end).format('HH');
            mins_end = $.fullCalendar.moment(event.end).format('mm');

            $('#calendar').fullCalendar('gotoDate',start);

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
            // if(event.confirmed_medico == 'Si'){
            //
            //   $('#but_save').attr('value','Guardar Cambios');
            // }else{
            //   $('#but_save').attr('value','Guardar y Confirmar');
            //
            // }

            if(event.state == 'Pagada y Completada'){
              $('#rechazar').hide();
              $('#button_confirmed_payment').hide();
              $('#button_confirmed_complete').hide();
              $('#but_save').hide();
            }else if(event.payment_state == 'Si'){
              $('#price9').attr('readonly',true);
              $('#rechazar').hide();
              // $('#button_confirmed_payment').hide();
              // $('#button_confirmed_complete').show();
              $('#but_save').show();
            }else{
              $('#rechazar').show();
              $('#price9').attr('readonly',false);
              // $('#button_confirmed_payment').show();
              // $('#button_confirmed_complete').hide();
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

            //verifica permisos de asistente
            if($('#auth_role').val() == 'Asistente'){
                if($('#cita_edit').val() != 1){
                     $('#eventType9').attr('readOnly',true);
                      $('#price9').attr('readOnly',true);
                      $('#description9').attr('readOnly',true);
                       $('#payment_method9').attr('readOnly',true);
                       $('#confirmed_patient9').attr('readOnly',true);

                       $('#title9').attr('readOnly',true);

                }

                if($('#cita_change_date').val() != 1){
                    $('#dateStart9').attr('readOnly',true);
                    $('#hourStart9').attr('readOnly',true);
                    $('#minsStart9').attr('readOnly',true);

                    $('#hourEnd9').attr('readOnly',true);
                    $('#minsEnd9').attr('readOnly',true);

                }

                if($('#cita_confirm_payment').val() != 1){
                    $('#button_confirmed_payment').attr('disabled',true);
                    $('#confirmed_payment_app').attr('disabled',true);
                }

                // if($('#cita_confirm_completed').val() != 1){
                //     $('#confirmed_completed').attr('disabled',true);
                //     $('#button_confirmed_complete').attr('disabled',true);
                //
                // }

                if($('#cita_cancel').val() != 1){
                    $('#rechazar').attr('disabled',true);

                }

                if($('#cita_confirm').val() != 1){

                    if(event.confirmed_medico == 'No'){

                        $('#button_confirmed_payment').hide();
                        $('#rechazar').hide();
                        $('#button_confirmed_payment').hide();
                        $('#button_confirmed_complete').hide();
                        $('#but_save').hide();
                        $('#text_confirm').show();

                    }else{
                        $('#text_confirm').hide();
                    }


                }else{
                    $('#text_confirm').hide();
                }


            }

            // if(event.confirmed_medico != 'Si'){
            //     $('#but_save').attr('value','Guardar y Confirmar');
            //     $('#button_confirmed_payment').attr('disabled',true);
            // }else{
            //     $('#but_save').attr('value','Guardar');
            //     $('#button_confirmed_payment').attr('disabled',false);
            // }
          cerrar();

        }
      });
    }
  </script>





  @endsection
