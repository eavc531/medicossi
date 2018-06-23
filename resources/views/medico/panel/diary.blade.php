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
      <div class="col-lg-9 col-12">

          <div class="row">
            <div class="col-12">
              <h2 class="text-center font-title">Mi Agenda</h2>


            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>

          <div class="alert-info p-3 m-2" style="display:none" id="alert_carga5">
            Procesando...
          </div>
        @include('medico.includes.alert_calendar')
        @include('medico.includes.card_edit')
          <hr>
          {{-- //busqueda --}}
          @if($countEventSchedule != 0)
            <label for="" class="mt-2">Agendar con:</label>
            <input type="text" name="" value="" class="" placeholder="cedula/nombre de Paciente" id="input_search">
            <button type="button" name="button" class="btn btn-success btn-sm" onclick="search_medic()">Buscar</button>
            <button type="button" name="button" class="btn btn-secondary btn-sm" onclick="vaciar_search()">vaciar</button>
            <div class="" id="result_search">

            </div>
            <div class="mb-3">

            </div>
          @endif
          {{-- // --}}

          <div class="" id="example">
            {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}


          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}
          @if($countEventSchedule != 0)

          <div id='calendar' style=""></div>
          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}


            <div class="row text-center mt-2">
              <div class="col">
                <div class="" style="width:15px;height:15px;background:">

                </div>
                  <input type="radio" value="Disponible" name="opcion" onclick="filtro_todas()"/><br />
                <label for="" class="mx-2" style="background:rgb(230, 230, 230)">Todas</label>
              </div>
              <div class="col">
              <input type="radio" value="A" name="opcion" onclick="filtro_title('Cita por Internet')"/><br />
                <label for="" style="background:rgb(35, 44, 173);color:white">Cita por internet</label>
              </div>
              <div class="col">

                  <input type="radio" value="A" name="opcion" onclick="filtro_state('Pagada y Pendiente')"/><br />
                  <label for="" style="background:rgb(233, 21, 21)">Pagada y Pendiente</label>

              </div>
              {{-- <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="filtrar('Cita por internet')"/><br />
                <label for="">Paciente valorado</label>
              </div> --}}
              <div class="col">
                <input type="radio" value="A" name="opcion" onclick="filtro_state('Pagada y Completada')"/><br/>
                <label for="" style="border:solid 1px black">Pagada y Completada</label>
              </div>
              <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="filtro_state('Pendiente')"/><br />
                <label for=""  style="background:rgba(179, 193, 173, 0.75)">Pendiente y por Cobrar</label>
              </div>
              <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="filtro_state('Pasada y por Cobrar')"/><br />
                <label for="" style="background:rgb(190, 61, 13)">Pasada y por Cobrar</label>
              </div>
              <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="filtro_payment_method('Aseguradora')"/><br />
                <label for="">Aseguradora</label>
              </div>
              {{-- <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="PendientePorCobrar()"/><br />
                <label for="">Confirmada con Paciente</label>
              </div> --}}
            </div>




              <div class="col-lg-10 col-12 align-items-center">
                <h6>¿Desea que se mande un mensaje de recordatorio a sus pacientes con citas confirmadas?</h6>
              </div>
              <div class="col-lg-2 col-12">
                <div class="radio-switch">
                @if($reminder_confirmed != Null)
                  @if ($reminder_confirmed->options == Null or $reminder_confirmed->options == 'No')
                    <div class="radio-switch-field">

                      <input id="switch-off" type="radio" name="radio-switch" value="No" checked onclick="switch_reminder1('No')">
                      <label for="switch-off">No</label>
                    </div>
                    <div class="radio-switch-field">
                      <input id="switch-on" type="radio" name="radio-switch" value="Si"  onclick="switch_reminder1('Si')">
                      <label for="switch-on">Si</label>
                    </div>
                  @else
                  <div class="radio-switch-field">
                    <input id="switch-off" type="radio" name="radio-switch" value="off"  onclick="switch_reminder1('No')">
                    <label for="switch-off">No</label>
                  </div>
                  <div class="radio-switch-field">
                    <input id="switch-on" type="radio" name="radio-switch" value="on" checked onclick="switch_reminder1('Si')">
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

              {{-- @if ($reminder_confirmed->options == Null or $reminder_confirmed->options == 'No')
                <div class="col-12" id="open-check" style="display: none;">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input value="" type="radio" id="customRadioInline1" name="tyme_before" class="custom-control-input" onclick="reminder_time_confirmed('5')">
                    <label class="custom-control-label" for="customRadioInline1">5 dias antes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="tyme_before" class="custom-control-input" onclick="reminder_time_confirmed('2')">
                    <label class="custom-control-label" for="customRadioInline2">2 dias antes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="1d" class="custom-control-input" onclick="reminder_time_confirmed('1')">
                    <label class="custom-control-label" for="customRadioInline3">1 dia antes</label>
                  </div>
                </div>
                </div>
              @else
                <div class="col-12" id="open-check">
                  {!!Form::model($reminder_confirmed,['route'=>'medico.store','method'=>'POST'])!!}

                    {!!Form::radio('days_before','1',null,['onclick'=>'reminder_time_confirmed(1)'])!!}
                    <label class="" for="customRadioInline1">5 dias antes</label>

                    {!!Form::radio('days_before','2',null,['onclick'=>'reminder_time_confirmed(2)'])!!}
                    <label class="" for="customRadioInline1">2 dias antes</label>

                    {!!Form::radio('days_before','5',null,['onclick'=>'reminder_time_confirmed(5)'])!!}
                    <label class="" for="customRadioInline2">1 dia antes</label>

                  {!!Form::close()!!}
                </div>
              </div>
            @endif --}}




            <h6 style="color:red">arreglar animaciones de los switch</h6>
            <div class="row my-5">
              <div class="col-lg-10 col-12 align-items-center">
                <h6>¿Desea que las citas que han sido pagadas con anticipacion, se marquen como completadas automaticamente despues de pasar la fecha de la misma?</h6>
              </div>
              <div class="col-lg-2 col-12">

                <div class="col-lg-2 col-12">
                  <div class="radio-switch">
                  @if ($config_past_and_payment_auto != Null)
                    @if($config_past_and_payment_auto->options == 'Si')
                      <label for="switch-off">No</label>
                      <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('No')">
                      <label for="switch-off">Si</label>
                      <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('Si')" checked>
                    @else
                      <label for="switch-off">No</label>
                      <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('No')" checked>
                      <label for="switch-off">Si</label>
                      <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('Si')">
                    @endif
                  @else
                    <label for="switch-off">No</label>
                    <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('No')" checked>
                    <label for="switch-off">Si</label>
                    <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('Si')">
                  @endif


                  </div>
                </div>


                </div>


                </div>

          <div class="card mt-5 mb-5" >
          <div class="row">
            <div class="col-12 text-center">
              <h4 class="font-title-blue text-center mt-3">Horario de trabajo</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-bordered">
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
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>
                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($martes as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>

                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($miercoles as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}


                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($jueves as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}


                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($viernes as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>

                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($sabado as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>

                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($domingo as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

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
                <div class="card-footer text-right">
                  <a href="{{route('medico_schedule',$medico->id)}}" class="btn btn-success ">Editar</a>
                </div>
              </div>
            </div>
          </div>
          </div>
        @else
          <div class="card mt-5 mb-5">
            <div class="card-header">
              <h4>Bienevenido al Panel de Control</h4>
            </div>
            <div class="card-body">
              <h5>Para poder ver el Calendario y todas sus fucniones debe Otorgar un Horario de Trabajo</h5>
              <a href="{{route('medico_schedule',$medico->id)}}" class="btn btn-primary">Otorgar un Horario de Trabajo</a>
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
              <span>{{$medico->email}}</span>
            </div>
            <div class="col-12 border-panel-green text-center my-1">
              <a class="btn btn-block btn-config-green" href="{{route('medico_schedule',$medico->id)}}">
                Otorgar horario de consulta
              </a>
            </div>
            <div class="border-panel-blue my-1">
              <div class="form-group text-center">
                <button type="button" class="btn-info btn" data-toggle="modal" data-target="#info1"><i class="fas fa-info mr-2"></i>Ayuda</button>
                <div class="form-group" style="margin-top:35px">
                  <label for="" class="label-title ">Agendar Evento Personal</label>
                </div>

                  {!!Form::open(['route'=>'event_personal_store','method'=>'POST','id'=>'form_event','name'=>'form_event'])!!}
                  {!!Form::hidden('medico_id',$medico->id)!!}
                {!!Form::select('title',['Ausente'=>'Ausente'],null,['class'=>'form-control','id'=>'title6','Tipo de Evento'=>'Tipo de Cita'])!!}

                <input class="form-control my-2" type="text" placeholder="Descripción (Opcional)" id="description6" name="descripti9oon">
                <label for="" class="mt-2 font-title">Datos de Inicio</label>
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
                      <button type="submit" name="button" class="btn btn-config-blue">Guardar</button>
                    {{-- <button onclick="store_event()"type="button" class="btn btn-config-blue">Guardar</button> --}}
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


    function reminder_time_confirmed(request){
      medico_id = "{{$medico->id}}";
      time = request;
      route = "{{route('reminder_time_confirmed')}}";
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

    function switch_reminder1(request){
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

      $('#form, #fo3').submit(function() {

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
            $('#dateStart9').val(start);
            $('#hourStart9').val(hour_start);
            $('#minsStart9').val(mins_start);
            $('#dateEndU9').val(end);
            $('#hourEnd9').val(hour_end);
            $('#minsEnd9').val(mins_end);
            $('#event_id9').val(event.id);
            $('#event_id9').val(event.id);
            $('#event_id_destroy9').val(event.id);
            $('#namePatient9').val(event.namePatient);
            $('#payment_state9').val(event.payment_state);
            $('#card_edit').fadeOut();
            $('#card_edit').fadeIn();

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
        if(result == 'fuera del horario'){
          $('#text_error').html('Imposible crear evento fuera del horario establecido');
          $('#alert_error').fadeIn();
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
        }

      }
    });
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
        alert('sd');
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
  </script>





  @endsection
