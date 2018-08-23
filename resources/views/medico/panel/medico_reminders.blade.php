 @extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<style media="screen">
.fc-event {
    border-width: 1px;
}

.fc-toolbar{
  background: rgb(83, 36, 143);
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
        <div class="register">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center font-title">Recordatorios</h2>

            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>
          </div>
          <div class="alert-info p-3 m-2" style="display:none" id="alert_carga5">
            Procesando...
          </div>
        @include('medico.includes.alert_calendar')
        @include('medico.includes.card_edit_reminder')
          <hr>
          <div class="" id="example">
            {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}


          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}
          @if($countEventSchedule != 0)

          <div id='calendar' style=""></div>
          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          <div class="row mt-5">
            <div class="col-6">
              <h6>¿Activar Recordatorios?</h6>

            </div>
            <div class="col-6">
              <div class="radio-switch">

                @if($reminder_alarm != Null)
                  @if ($reminder_alarm->options == Null or $reminder_alarm->options == 'No')
                    <div class="radio-switch-field">

                      <input id="switch-off" type="radio" name="radio-switch" value="No" checked onclick="config_acvtivate_reminder_alarm('No')">
                      <label for="switch-off">No</label>
                    </div>
                    <div class="radio-switch-field">
                      <input id="switch-on" type="radio" name="radio-switch" value="Si"  onclick="config_acvtivate_reminder_alarm('Si')">
                      <label for="switch-on">Si</label>
                    </div>
                  @else
                    <div class="radio-switch-field">
                      <input id="switch-off" type="radio" name="radio-switch" value="off"  onclick="config_acvtivate_reminder_alarm('No')">
                      <label for="switch-off">No</label>
                    </div>
                    <div class="radio-switch-field">
                      <input id="switch-on" type="radio" name="radio-switch" value="on" checked onclick="config_acvtivate_reminder_alarm('Si')">
                      <label for="switch-on">Si</label>
                    </div>
                  @endif
                @else
                  <div class="radio-switch-field">

                    <input id="switch-off" type="radio" name="radio-switch" value="No" checked onclick="switch_reminder1('No')">
                    <label for="switch-off">No</label>
                  </div>
                  <div class="radio-switch-field">
                    <input id="switch-on" type="radio" name="radio-switch" value="Si"  onclick="switch_reminder1('Si')">
                    <label for="switch-on">Si</label>
                  </div>
                @endif
              </div>
            </div>
          </div>

          @if($reminder_alarm != Null and $reminder_alarm->options == 'Si')
            <div class="col-12" id="open-check" style="">
            {!!Form::model($reminder_alarm,['route'=>'medico.store','method'=>'POST'])!!}
               {!!Form::radio('days_before','1',null,['onclick'=>'reminder_time_alarm(1)'])!!}

                <label class="" for="customRadioInline1">1 Dias Antes</label>

                {!!Form::radio('days_before','2',null,['onclick'=>'reminder_time_alarm(2)'])!!}
                <label class="" for="customRadioInline2">2 Dias Antes</label>

                {!!Form::radio('days_before','4',null,['onclick'=>'reminder_time_alarm(4)'])!!}
                <label class="" for="customRadioInline3">4 Dias antes</label>

            {!!Form::close()!!}
            </div>
          @else
            <div class="col-12" id="open-check" style="display:none;">
            {!!Form::model($reminder_alarm,['route'=>'medico.store','method'=>'POST'])!!}
               {!!Form::radio('days_before','1',null,['onclick'=>'reminder_time_alarm(1)'])!!}

                <label class="custom-control-label" for="customRadioInline1">1 Dia Antes</label>

                {!!Form::radio('days_before','2',null,['onclick'=>'reminder_time_alarm(2)'])!!}
                <label class="custom-control-label" for="customRadioInline2">2 Dias Antes</label>

                {!!Form::radio('days_before','4',null,['onclick'=>'reminder_time_alarm(4)'])!!}
                <label class="custom-control-label" for="customRadioInline3">4 Dias antes</label>

            {!!Form::close()!!}
            </div>
          @endif


        @else
          <div class="card mt-5 mb-5">
            <div class="card-header">
              <h4>Bienevenido al Panel de Recordatorios</h4>
            </div>
            <div class="card-body">
              <h5>Para poder ver el Calendario  de recordatorios y todas sus funciones debe otorgar un Horario de Trabajo</h5>
              <a href="{{route('medico_schedule',\Hashids::encode($medico->id))}}" class="btn btn-primary">Otorgar Horario de Trabajo</a>
            </div>
          </div>
        @endif
        {{-- IF SHOW CALENDAR --}}
            </div>



          </div>
        <div class="col-12 col-lg-3">
          <div id="dashboard">
            <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
            <div class="col-12 border-head-panel text-center">
              <span>Usuario firmado:</span>
              <span>{{$medico->name}} {{$medico->lastName}}</span>
            </div>
            <div class="col-12 border-panel-green text-center my-1">
                @edit_schedule
              <a class="btn btn-block btn-config-green" href="{{route('medico_schedule',\Hashids::encode($medico->id))}}">
                Editar horario de consulta
              </a>
          @else
              <a class="btn btn-block btn-config-green disabled" href="{{route('medico_schedule',\Hashids::encode($medico->id))}}">
                Editar horario de consulta
              </a>
              @endedit_schedule
            </div>
            <div class="border-panel-blue my-1">
              <div class="form-group text-center">

                <div class="form-group" style="margin-top:35px">
                  <label for="" class="label-title ">Crear Nuevo Recordatorio </label>
                </div>
                @reminder_create
                {!!Form::open(['route'=>'reminder_store','method'=>'POST','id'=>'form_reminder'])!!}
                {!!Form::hidden('medico_id',$medico->id)!!}
                <label for="" class="font-title">Nombre</label>
              {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Recordatorio'])!!}
              <label for="" class="font-title">Descripción (Opcional)</label>
              {!!Form::text('description',null,['class'=>'form-control'])!!}


              <label for="" class="mt-2 font-title-blue">Datos de Inicio</label>
              <div class="row">

                <div class="col-4 font-title">
                  Fecha
                </div>
                  <div class="col-8">
                    {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start2'])!!}
                  </div>
              </div>
              <div class="row mt-1">
                <div class="col-3 font-title">
                  Hora

                </div>
                <div class="form-inline">
                  {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourStart2','placeholder'=>'--'])!!}

                    {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsStart2','placeholder'=>'--'])!!}

                    {{-- {!!Form::select('startFormatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'startFormatHour3','class'=>'form-control  mb-1'])!!} --}}
                </div>
            </div>
            <label for="" class="mt-2 font-title">Datos de Culminacion</label>

            <div class="row mt-1">

              <div class="col-4 font-title">
                Hora
              </div>
              <div class="form-inline">
                {!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourEnd2','placeholder'=>'--'])!!}

                  {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEnd2','placeholder'=>'--'])!!}

              </div>

            </div>
            @else

                {!!Form::open(['route'=>'reminder_store','method'=>'POST','id'=>'form_reminder'])!!}
                {!!Form::hidden('medico_id',$medico->id)!!}
                <label for="" class="font-title">Nombre</label>
              {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Recordatorio','disabled'])!!}
              <label for="" class="font-title">Descripción (Opcional)</label>
              {!!Form::text('description',null,['class'=>'form-control','disabled'])!!}


              <label for="" class="mt-2 font-title-blue">Datos de Inicio</label>
              <div class="row">

                <div class="col-4 font-title">
                  Fecha
                </div>
                  <div class="col-8">
                    {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start2','disabled'])!!}
                  </div>
              </div>
              <div class="row mt-1">
                <div class="col-3 font-title">
                  Hora

                </div>
                <div class="form-inline">
                  {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourStart2','placeholder'=>'--','disabled'])!!}

                    {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsStart2','placeholder'=>'--','disabled'])!!}

                    {{-- {!!Form::select('startFormatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'startFormatHour3','class'=>'form-control  mb-1'])!!} --}}
                </div>
            </div>
            <label for="" class="mt-2 font-title">Datos de Culminacion</label>

            <div class="row mt-1">

              <div class="col-4 font-title">
                Hora
              </div>
              <div class="form-inline">
                {!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourEnd2','placeholder'=>'--','disabled'])!!}

                  {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEnd2','placeholder'=>'--','disabled'])!!}

              </div>

            </div>
                @endreminder_create




                <div id="alert_error" class="alert alert-warning alert-dismissible fade show text-left" role="alert" style="display:none">
                  <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
                  <p id="text_error" style="font-size:12px"></p>
                </div>

                <div id="alert_success" class="alert alert-success alert-dismissible fade show text-left" role="alert" style="display:none">
                  <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
                  <p id="text_success" style="font-size:12px"></p>
                </div>

                <div class="col-12 text-center mt-2 row">
                  <div class="col-lg-6">
                    @if($countEventSchedule != 0)

                      @reminder_create
                  <button type="submit" name="button" class="btn btn-config-blue">Guardar</button>
                      @else
                          <button onclick=""type="button" class="btn btn-config-blue" disabled>Guardar</button>
                      @endreminder_create
                    @else

                    <button onclick=""type="button" class="btn btn-config-blue" disabled>Guardar</button>
                    @endif
                    {{-- <button type="submit" class="btn btn-config-blue">Guardar</button> --}}
                  </div>
                  <div class="col-lg-6">
                    <button onclick="vaciar()" type="button"class="btn btn-config-secondary">Cancelar</button>
                  </div>
                  {!!Form::close()!!}
                </div>
              </div>
            </div>
          </div>
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
        <p>Para agendar cita, debe seleccionar en la barra lateral izquierda,la opcion "Mis Pacientes",seleccionar el
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

  function reminder_time_alarm(request){
    medico_id = "{{$medico->id}}";
    time = request;
    route = "{{route('reminder_time_alarm')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: route,
      data:{medico_id:medico_id,time:time},
      // Mostramos un mensaje con la respuesta de PHP
      success:function(result){
        console.log(result);
      },
      error:function(error){
       console.log(error);
     },
  });
  }

  function config_acvtivate_reminder_alarm(request){
    medico_id = "{{$medico->id}}";
    options = request;
    route = "{{route('config_acvtivate_reminder_alarm')}}";
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

  function switch_reminder1(request){
    if(request == 'No'){
      $('#open-check').fadeIn();
    }else{
      $('#open-check').fadeOut();
    }

    medico_id = "{{$medico->id}}";
    options = request;
    route = "{{route('reminder_switch_confirmed')}}";
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

    function reminder_delete(){
      route = "{{route('reminder_delete')}}";
      reminder_id = $('#reminder_id').val();
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: route,
        data:{reminder_id:reminder_id},
        // Mostramos un mensaje con la respuesta de PHP
        error:function(error){
          $('#alert_carga5').fadeOut();
         stop_loader();
          console.log(error);
          $('#text_error_up1').html('Error: imposible borrar Recordatorio');
          $('#alert_error_up1').fadeIn();
       },
        success:function(result){
          console.log(result);
          $('#alert_carga5').fadeOut();
          stop_loader();
          $('#text_danger_up1').html('Se ha eliminado el recordatorio de forma satisfactoria');
          $('#alert_danger_up1').fadeIn()
          console.log(result);
          $('#card_edit').fadeOut();

          $('#alert_error_up1').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');



        }

    })
    }

    $(document).ready(function(){
      $('#form_reminder').submit(function() {
        loader();

        cerrar();
        $('#alert_carga5').fadeIn();

        errormsj = '';
             $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type: 'POST',
               url: $(this).attr('action'),
               data: $(this).serialize(),
               // Mostramos un mensaje con la respuesta de PHP
               error:function(error){
                 $('#alert_carga5').fadeOut();
                stop_loader();
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
                 console.log(result);
                 $('#alert_carga5').fadeOut();
                 stop_loader();

                 if(result == 'fuera del horario'){
                   $('#text_error_up1').html('imposible guardar evento, fuera del horario establecido');
                   $('#alert_error_up1').fadeIn();
                                  }else {
                   console.log(result);
                   $('#card_edit').fadeOut();
                   $('#text_success_up1').html('Guardado con Exito');
                   $('#alert_success_up1').fadeIn();
                   $('#alert_error_up1').fadeOut();
                   $('#calendar').fullCalendar('removeEvents');
                   $('#calendar').fullCalendar('refetchEvents');

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
         route = "{{route('compare_hours',\Hashids::encode($medico->id))}}";

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

        },

        events:"{{route('reminder_calendar',\Hashids::encode($medico->id))}}",

        eventClick: function(event, jsEvent, view){
            var start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
            var end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
            hour_start = $.fullCalendar.moment(event.start).format('HH');
            mins_start = $.fullCalendar.moment(event.start).format('mm');
            hour_end = $.fullCalendar.moment(event.end).format('HH');
            mins_end = $.fullCalendar.moment(event.end).format('mm');

            $('#title9').val(event.title);
            $('#state9').val(event.state);
            $('#description9').val(event.description);
            $('#dateStart9').val(start);
            $('#hourStart9').val(hour_start);
            $('#minsStart9').val(mins_start);
            $('#dateEndU9').val(end);
            $('#hourEnd9').val(hour_end);
            $('#minsEnd9').val(mins_end);
            $('#reminder_id').val(event.id);
            $('#event_id9').val(event.id);
            $('#card_edit').fadeOut();
            $('#card_edit').fadeIn();

        },

        eventRender: function (event, element, view) {

          if($('#filtro_state').val() != 'Ninguno'){


              if(event.state != $('#filtro_state').val() &&  event.rendering != 'background'){
                return false;
              }
            }


          if($('#filtro_title').val() != 'Ninguno'){

            if(event.title != $('#filtro_title').val() &&  event.rendering != 'background'){
              return false;
            }
          }

          if($('#filtro_payment_method').val() != 'Ninguno'){

            if(event.payment_method != $('#filtro_payment_method').val() &&  event.rendering != 'background'){
              return false;
            }
          }

          if(event.title == 'Ausente'){
            element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">'+event.description+'</span>');
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



    $('#form, #fo3').submit(function(){
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
                 $('#card_edit').fadeOut();
               }else if(result == 'ya existe'){
                 $('#text_error_up1').html('Imposible actualizar evento,Ya existe un Evento en las horas seleccionadas, por favor compruebe la fecha en el calendario e intente nuevamente');
                 $('#alert_error_up1').fadeIn();
                 $('#alert_success').fadeOut();

               }else {
                 console.log(result);
                 $('#card_edit').fadeOut();
                 $('#text_success_up1').html('Cambios guardados con exito');
                 $('#alert_success_up1').fadeIn();
                 $('#alert_error_up1').fadeOut();
                 $('#calendar').fullCalendar('removeEvents');
                 $('#calendar').fullCalendar('refetchEvents');

               }

             }

         })

         return false;
     });

    function cancel(){
      cerrar();
      question = confirm('Esta a punto de Rechazar/Cancelar esta Cita,se enviara un corredo al paciente para notificarle de este suceso,¿Esta segur@ de Continuar?.');
      if(question == false){
       return false;
     }
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
       data:{event_id:event_id},
       error:function(error){
         console.log(error);
      },
      success:function(result){
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
        $('#card_edit').fadeOut();
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

  </script>





  @endsection
