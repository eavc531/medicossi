@extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">
<style media="screen">
.fc-event {
    border-width: 1px;
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
    <div class="col-lg-9 col-sm-8 col-12">
      <div class="register">
        <div class="row">
          <div class="col-12">
            <h3 class="text-center font-title mt-2">Agendar Cita con El profesional: {{$medico->name}} {{$medico->lastName}}</h3>
          </div>
        </div>
        <div class="row mt-">
          <div class="col-12 text-center">
           <h3 class="text-center font-title-blue">Especialidad: {{$medico->specialty}}</h3>
         </div>
       </div>
     </div>
     <hr>

    @include('medico.includes.alert_calendar')
    @include('medico.includes.card_edit')
    <hr>
    <div class="" id="example">
      {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}
      <div id="alert_success_1" class="alert alert-success" role="alert" style="display:none">
       <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
       <h5 id="text_success_1" style=""></h5>

       {{-- <a href="{{route('patient_appointments_pending',\Hashids::encode(Auth::user()->patient->id))}}" class="btn btn-outline-primary">Ver mis Citas Pendienes</a> --}}
        {{-- <a href="{{route('home')}}" class="btn btn-outline-success">Ir a Inicio</a> --}}
       {{--<a class="btn btn-outline-success" href="{{route('patient_appointments',Auth::user()->patient->id)}}">Tus Citas Pendientes</a>--}}
     </div>
     {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
     {{-- IF SHOW CALENDAR --}}
     <div class="text-right">


     </div>
     <div class="text-right mb-2">
         <a href="{{route('home')}}" class="btn btn-secondary">Ir Inicio</a>
         <button onclick="window.history.back();" type="button" name="button" class="btn btn-secondary">Volver</button>
     </div>
     @if($countEventSchedule != 0)
     <div id='calendar' style=""></div>
     @else
       <div class="card mt-5 mb-5">

         <div class="alert-warning p-4">
           <h5>Lo sentimos, no es Posible agendar cita con el medico: "{{$medico->name}} {{$medico->lastName}}" en este momento, debido a que aun no a definido su horario de trabajo.</h5>
         </div>
       </div>
     @endif
     {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
     {{-- IF SHOW CALENDAR --}}
   </div>
 </div>
 <div class="col-lg-3 col-sm-4 col-12">
  <div id="dashboard">
    <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
    <div class="col-12 border-head-panel text-center">
      <span>Médico:</span>
      <span>{{$medico->name}} {{$medico->lastName}}</span>
    </div>


    <div class="border-panel-blue my-1">

      <div class="col-12">
      </div>
      <a href="" class="btn-info btn" data-toggle="modal" data-target="#info-modal"><i class="fas fa-info mr-2"></i>¿Como Agendar?</a>
      <div class="form-group text-center">
        <div class="form-group mt-2">
          <label for="" class="label-title ">Agendar Cita con el Médico: {{$medico->name}} {{$medico->lastName}}</label>
        </div>


        {!!Form::hidden('title','Cita por Internet',['class'=>'form-control','id'=>'eventType2'])!!}

        <label for="" class="mt-2 font-title">Metodo de Pago</label>
         @if($medico->type_patient_service == "Solo pacientes privados")
        {!!Form::select('payment_method',['Normal'=>'Normal'],null,['class'=>'form-control','id'=>'payment_method6'])!!}
        @elseif($medico->type_patient_service == "solo pacientes de aseguradoras")
        {!!Form::select('payment_method',['Aseguradora'=>'Aseguradora'],null,['class'=>'form-control','id'=>'payment_method6'])!!}
        @else
        {!!Form::select('payment_method',['Normal'=>'Normal','Aseguradora'=>'Aseguradora'],null,['class'=>'form-control','id'=>'payment_method6','placeholder'=>'seleccionar'])!!}
        @endif
        {{-- <input class="form-control my-2" type="text" placeholder="Titulo" id="title2"> --}}


        {{-- <input class="form-control my-2" type="text" placeholder="precio (Opcional)" id="price2"> --}}
        <div class="row">
          <div class="col-lg-4 col-sm-12 font-title">
           <label for="" class="col-form-label font-title-grey mt-1"> Inicio</label>
         </div>
         <div class="col-lg-8 col-sm-12 mt-1">
           {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start2'])!!}
         </div>
       </div>
       <div class="row mt-1">
        <div class="col-lg-4 col-sm-12 font-title">
         <label for="" class="col-form-label font-title-grey"> Hora</label>
       </div>
       <div class="form-inline col-lg-8 col-sm-12">
        {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourStart2','placeholder'=>'--'])!!}

        {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsStart2','placeholder'=>'--'])!!}

        {{-- {!!Form::select('startFormatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'startFormatHour3','class'=>'form-control  mb-1'])!!} --}}
      </div>

    </div>
    <label for="" class="mt-2 font-title">Culminacion</label>
    <div class="row mt-1">
      <div class="col-4 col-lg-4 col-sm-12">
       <label for="" class="col-form-label font-title-grey"> Hora</label>
     </div>
     <div class="form-inline col-lg-8 col-sm-12">
      {!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control','id'=>'hourEnd2','placeholder'=>'--'])!!}

      {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEnd2','placeholder'=>'--'])!!}

      {{-- {!!Form::select('endformatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'endFormatHour2','class'=>'form-control  mb-1'])!!} --}}
    </div>
  </div>
  <div id="alert_error" class="alert alert-warning alert-dismissible fade show text-left  mt-1" role="alert" style="display:none">
    <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
    <p id="text_error" style="font-size:12px"></p>
  </div>

  <div id="alert_success" class="alert alert-success alert-dismissible fade show text-left  mt-1" role="alert" style="display:none">
    <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
    <p id="text_success" style="font-size:12px"></p>
  </div>

  <div id="alert_carga" class="alert alert-info alert-dismissible fade show text-left mt-1" role="alert" style="display:none">
    <p>Procesando...</p>
  </div>

  <div class="col-12 text-center mt-2 row">
    <div class="col-lg-6">
      @if($countEventSchedule != 0)
      <button onclick="store_event()"type="button" class="btn btn-config-blue" id="btn_agendar">agendar</button>
      @else
      <button onclick=""type="button" class="btn btn-config-blue" disabled>Agendar</button>
      @endif
      {{-- <button type="submit" class="btn btn-config-blue">Guardar</button> --}}
    </div>
    <div class="col-lg-6">
      <button onclick="vaciar()" type="button"class="btn btn-config-secondary" id="btn_cancelar">Cancelar</button>
    </div>
    {!!Form::close()!!}
  </div>
</div>
</div>
</div>
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

@endisset


@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}


<!--  ///////////////////////////////////////////////////////MODAL INFO////////////////////  -->
<!-- Modal -->
<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Como agendar una cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="font-title-grey">Agendar Cita</h5>
        <p>Las Horas disponibles del médico, estan marcadas en el calendario como color verde claro:  <div class="" style="width:40px;height:40px; border:solid black 1px;background:rgba(162, 231, 50, 0.64);border-radius:5px"></div></p>
        <p>Seleccione horas disponibles y rellene los campos del formulario ubicado a la derecha, a continuación presione el boton agendar cita, y listo ya habra agendado una cita con el Médico: {{$medico->name}} {{$medico->lastName}}</p>

        <p>Puede desplasarse a otras fechas en el calendario, con los botones "<",">" en la parte superior de este.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


@section('scriptJS')
{{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
<script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
<script src='{{asset('fullcalendar/locale/es.js')}}'></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
<script type="text/javascript">


  $(document).ready(function(){
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

         //$('#ModalCreate').modal('show');
         //alert(start.format('YYYY-MM-DD'));
       },

       events:"{{route('patient_medico_diary_events',\Hashids::encode($medico->id))}}",

       eventRender: function (event, element, view) {

           element.find('.fc-title').html('<div class="hr-line-solid-no-margin">Reservado</div>');

       },


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
      // title = $('#title2').val("");
      // eventType = $('#eventType2').val("");
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

      loader();
     
      close_edit();
      title = $('#eventType2').val();
      payment_method = $('#payment_method6').val();
      date_start = $('#date_start2').val();
      hourStart = $('#hourStart2').val();
      minsStart = $('#minsStart2').val();
      dateEnd = $('#date_end3').val();
      hourEnd = $('#hourEnd2').val();
      minsEnd = $('#minsEnd2').val();
      patient_id = "{{Auth::user()->patient->id}}";
      medico_id = "{{$medico->id}}";
      route = "{{route('appointment_store')}}";
      errormsj = '';

      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{title:title,payment_method:payment_method,date_start:date_start,hourStart:hourStart,minsStart:minsStart,dateEnd:dateEnd,hourEnd:hourEnd,minsEnd:minsEnd,medico_id:medico_id,patient_id:patient_id},
       error:function(error){
           stop_loader();


         $.each(error.responseJSON.errors, function(index, val){
          errormsj+='<li>'+val+'</li>';
        });
         $('#text_error').html('<ul style="list-style:none;">'+errormsj+'</ul>');
         $('#alert_error').fadeIn();
         $('#alert_success').fadeOut();

         console.log(error);
       },
       success:function(result){
           stop_loader();
         $('#btn_agendar').attr("disabled", false);
         $('#btn_cancelar').attr("disabled", false);
         $('#alert_carga').fadeOut();
        vaciar();
        console.log(result);
        if(result == 'fuera del horario'){
          $('#text_error_up1').html('Imposible crear evento fuera del horario establecido');
          $('#alert_error_ip1').fadeIn();
          $('#alert_success').fadeOut();
      }else if(result == 'end menor start'){
          $('#text_error_up1').html('imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
          $('#alert_error_up1').fadeIn();
          $('#alert_success').fadeOut();
        }else if(result == 'ya existe'){
          $('#text_error').html('Imposible crear evento,Ya existe un Evento en las horas seleccionadas, por favor compruebe la fecha en el calendario e intente nuevamente');
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
          $('#btn_agendar').attr("disabled", false);
          $('#btn_cancelar').attr("disabled", false);
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
          $('#text_success_up1').html('Guardado con Exito');
          $('#alert_success_up1').fadeIn();
          $('#alert_error_up1').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');
          close_edit();
        }

      }
    });

    }


   function filtrar(filtro){
      $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
      test = 1;
      route = '{{route('medico_diary_events2',\Hashids::encode($medico->id))}}';
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



</script>





@endsection
