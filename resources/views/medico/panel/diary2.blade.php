@extends('layouts.app-panel')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
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
    {{-- //ALGUNOS PERMISOS PARA LAS CITAS  --}}
    @if(Auth::user()->role == 'Asistente')
        <input type="hidden" name="" value="{{Auth::user()->assistant->cita_confirm}}" id="cita_confirm">
        <input type="hidden" name="" value="{{Auth::user()->role}}" id="auth_role">
        <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_edit}}" id="cita_edit">
        <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_change_date}}" id="cita_change_date">
        <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_confirm_payment}}" id="cita_confirm_payment">
        <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_confirm_completed}}" id="cita_confirm_completed">
        <input type="hidden" name="" value="{{Auth::user()->assistant->permission->cita_cancel}}" id="cita_cancel">
    @endif
    {{-- // --}}
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

                <hr>
                @if($countEventSchedule != 0)
                    {{-- //busqueda --}}
                    @cita_create
                    <label for="" class="mt-2">Agendar con:</label>
                    <input type="text" name="" value="" class="" placeholder="cedula/nombre de Paciente" id="input_search">
                    <button type="button" name="button" class="btn btn-success btn-sm" onclick="search_medic()">Buscar</button>
                    <button type="button" name="button" class="btn btn-secondary btn-sm" onclick="vaciar_search()">vaciar</button>
                    <div class="" id="result_search">
                    </div>
                @else
                    <label for="" class="mt-2">Agendar con:</label>
                    <input type="text" name="" value="" class="" placeholder="cedula/nombre de Paciente" id="input_search" disabled>
                    <button type="button" name="button" class="btn btn-success btn-sm" onclick="search_medic()" disabled>Buscar</button>
                    <button type="button" name="button" class="btn btn-secondary btn-sm text-secondary" onclick="vaciar_search()" disabled>vaciar</button>
                    <div class="" id="result_search">
                    </div>
                    @endcita_create

                @endif

                @include('medico.includes.alert_calendar')
                @include('medico.includes.card_edit')
                @include('medico.includes.card_personal')

                @include('medico.includes.modals_diary')
                {{-- // --}}

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
                        <label for="" style="background:rgb(255, 152, 152)">Aseguradora</label>
                    </div>
                    <div class="col">
                        <input type="radio" value="A" name="opcion" onclick="filtro_confirmed_medico('No')"/><br />
                        <label for="" style="background:rgb(227, 227, 227)">Sin Confirmar</label>
                    </div>
                    <div class="col">

                        <input type="radio" value="A" name="opcion" onclick="filtro_state('Realizada y por cobrar')"/><br />
                        <label for="" style="background:rgb(246, 43, 244)">Realizada y por cobrar</label>

                    </div>
                </div>


                @include('medico.panel.config_reminder')

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
                                            <a href="{{route('medico_schedule',\Hashids::encode($medico->id))}}" class="btn btn-success ">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card mt-5 mb-5">
                            <div class="card-header">
                                <h4>Bienevenido al Panel Mi Agenda</h4>
                            </div>
                            <div class="card-body">
                                <h5>Para poder ver el Calendario de agenda y todas sus fucniones debe Otorgar un Horario de Trabajo</h5>
                                @plan_agenda
                                <a href="{{route('medico_schedule',\Hashids::encode($medico->id))}}" class="btn btn-primary">Otorgar un Horario de Trabajo</a>
                                @endplan_agenda
                            </div>
                        </div>
                        {{-- IF SHOW CALENDAR --}}
                    @endif
                </div>
                {{-- </div> --}}
                <div class="col-12 col-lg-3">
                    @cita_person_create

                    <div id="dashboard mt-2" style="margin-top:60px">
                        <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
                        <div class="col-12 border-head-panel text-center">
                            <span>Médico:</span>
                            <span>{{$medico->nameComplete}}</span>
                        </div>
                        {{-- <div class="col-12 border-panel-green text-center my-1">
                        <a class="btn btn-block btn-config-green" href="{{route('medico_schedule',\Hashids::encode($medico->id))}}">
                        Editar horario de consulta
                    </a>
                </div> --}}
                <div class="border-panel-blue my-1">
                    <div class="form-group text-center">
                        <button type="button" class="btn-info btn" data-toggle="modal" data-target="#info1"><i class="fas fa-info mr-2"></i>Ayuda</button>
                        <div class="form-group" style="margin-top:35px">
                            <label for="" class="label-title ">Agendar Evento Personal</label>
                        </div>

                        {!!Form::open(['route'=>'event_personal_store','method'=>'POST','id'=>'form_event','name'=>'form_event'])!!}
                        {!!Form::hidden('medico_id',$medico->id)!!}
                        {!!Form::select('title',['Personal'=>'Personal','Ausente'=>'Ausente'],null,['class'=>'form-control input-sm','id'=>'title6','Tipo de Evento'=>'Tipo de Cita'])!!}

                        <input class="form-control input-sm my-2" type="text" placeholder="Descripción (Opcional)" id="description6" name="description">
                        <label for="" class="mt-2 font-title">Datos de Inicio</label>
                        <div class="row">

                            <div class="col-4 font-title">
                                Fecha
                            </div>
                            <div class="col-8">
                                {!!Form::date('date_start',null,['class'=>'form-control input-sm','id'=>'date_start2'])!!}
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-3 font-title">
                                Hora

                            </div>
                            <div class="form-inline">
                                {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control input-sm','id'=>'hourStart2','placeholder'=>'--'])!!}

                                {!!Form::select('minsStart',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control input-sm','id'=>'minsStart2','placeholder'=>'--'])!!}

                                {{-- {!!Form::select('startFormatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'startFormatHour3','class'=>'form-control input-sm  mb-1'])!!} --}}
                            </div>

                        </div>
                        <label for="" class="mt-2 font-title">Datos de Culminacion</label>

                        <div class="row mt-1">

                            <div class="col-4 font-title">
                                Hora
                            </div>
                            <div class="form-inline">
                                {!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],null,['class'=>'form-control input-sm','id'=>'hourEnd2','placeholder'=>'--'])!!}

                                {!!Form::select('minsEnd',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control input-sm','id'=>'minsEnd2','placeholder'=>'--'])!!}

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
                                    <button onclick=""type="button" class="btn btn-config-blue" readOnly>Guardar</button>
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
            @endcita_person_create
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
                            @if(Auth::check() and Auth::user()->role == 'medico')
                                <button onclick="confirmed_completed()" type="button" name="button" class="btn btn-warning btn-block">Pagada y Completada</button>

                            @else
                                @if(Auth::user()->assistant->permission->cita_confirm_completed != Null){
                                    <button onclick="confirmed_completed()" type="button" name="button" class="btn btn-warning btn-block">Pagada y Completada</button>
                                @else
                                    <button onclick="confirmed_completed()" type="button" name="button" class="btn btn-warning btn-block" disabled>Pagada y Completada</button>
                                @endif
                            @endif


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


    {{Form::hidden('filtro_state','Ninguno',['id'=>'filtro_state'])}}
    {{Form::hidden('filtro_title','Ninguno',['id'=>'filtro_title'])}}
    {{Form::hidden('filtro_payment_method','Ninguno',['id'=>'filtro_payment_method'])}}
    {{Form::hidden('filtro_confirmed_medico','Ninguno',['id'=>'filtro_confirmed_medico'])}}

    <input type="hidden" name="id_medico_id" value="{{$medico->id}}" id="id_medico_id">
    <input type="hidden" name="" value="{{route('event_personal_update')}}" id="event_personal_update">
    <input type="hidden" name="" value="{{route('event_personal_delete')}}" id="event_personal_delete">
    {{Form::hidden('route',route('manage_patient',['m_id'=>'m_id','p_id'=>'p_id']),['id'=>'route_manage'])}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
    {{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
    <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
    <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
    <script src='{{asset('fullcalendar/locale/es.js')}}'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
    <script type="text/javascript">



    //ACTUIALZIAR EVENTO Personal
    function event_personal_delete(){
        event_id = $('#event_id10').val();
        route = $('#event_personal_delete').val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url:route,
            data: {event_id:event_id},
            // Mostramos un mensaje con la respuesta de PHP
            error:function(error){
                stop_loader();

                console.log(error);
                $.each(error.responseJSON.errors, function(index, val){
                    errormsj+='<li>'+val+'</li>';
                });
                $('#text_error_up1').html('<ul style="list-style:none;">'+errormsj+'</ul>');
                $('#alert_error_up1').fadeIn();
                $('#alert_success_up1').fadeOut();

                console.log(error);
            },
            success:function(result){
                stop_loader();

                console.log(result);
                $('#text_danger_up1').html('El evento ha sido eliminado con exito');
                $('#alert_danger_up1').fadeIn();
                $('#card_personal').fadeOut();
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('refetchEvents');


            }
        });
    }

    function update_event_personal(){
        loader();
        event_id = $('#event_id10').val();
        medico_id = $('#id_medico_id').val();
        title = $('#title10').val();
        description = $('#description10').val();
        date_start = $('#date_start10').val();
        hourStart = $('#hour_start10').val();
        minsStart = $('#mins_start10').val();
        hourEnd = $('#hour_end10').val();
        minsEnd = $('#mins_end10').val();
        route = $('#event_personal_update').val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url:route,
            data: {event_id:event_id,medico_id:medico_id,title:title,description:description,date_start:date_start,hourStart:hourStart,minsStart:minsStart,hourEnd:hourEnd,minsEnd:minsEnd},
            // Mostramos un mensaje con la respuesta de PHP
            error:function(error){
                stop_loader();

                console.log(error);
                $.each(error.responseJSON.errors, function(index, val){
                    errormsj+='<li>'+val+'</li>';
                });
                $('#text_error_up1').html('<ul style="list-style:none;">'+errormsj+'</ul>');
                $('#alert_error_up1').fadeIn();
                $('#alert_success_up1').fadeOut();

                console.log(error);
            },
            success:function(result){
                stop_loader();

                console.log(result);
                if(result.message.error == 'fuera del horario'){
                    alert('Imposible guardar evento fuera del horario establecido');
                    // $('#text_error_up1').html('imposible guardar evento fuera del horario establecido');
                    // $('#alert_error_up1').fadeIn();
                }else if(result.message.error == 'end menor start'){
                    alert('Imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
                    // $('#text_error_up1').html('Imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
                    // $('#alert_error_up1').fadeIn();
                }else if(result.message.error == 'ya existe'){
                    alert('Imposible actualizar evento,Ya existe un Evento en las horas seleccionadas, por favor compruebe la fecha en el calendario e intente nuevamente');
                }else if(result.message.error == 'fecha_editada'){
                    $('#text_success_up1').html('Se ha cambiado la "Hora/Fecha" de la consulta con Exito. Se ha enviado un correo al Paciente para notificarle del cambio de la consulta.');
                    $('#alert_success_up1').fadeIn();
                    $('#card_edit').fadeOut();
                }else if(result.message.error == 'confirmado_editado'){
                    $('#text_success_up1').html('Se ha cambiado la "Hora/Fecha" y Confirmada consulta con Exito. Se ha enviado un correo al Paciente para notificarle del cambio de la consulta.');
                    $('#alert_success_up1').fadeIn();
                    $('#card_edit').fadeOut();
                }else if(result.message.error == 'cita_confirmada'){
                    $('#text_success_up1').html(result.message.message_error);
                    $('#alert_success_up1').fadeIn();
                    $('#alert_error_up1').fadeOut();
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('refetchEvents');

                }else if(result.message.error == 'ok'){
                    console.log(result);

                    $('#text_success_up1').html('Los datos del evento, han sido guardados con exito.');
                    $('#alert_success_up1').fadeIn();
                    $('#alert_error_up1').fadeOut();
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('refetchEvents');

                }else if(result.message.error == 'fecha_pasada'){
                    alert(result.message.message_error);

                }
                $('#card_personal').fadeOut();

            }
        });


        }



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
                    $('#confirmed_patient9').attr('readOnly',true);
                    $('#confirmed_medico9').attr('readOnly',true);
                    $('#price9').attr('readOnly',true);
                    $('#title9').attr('readOnly',true);
                    $('#state9').attr('readOnly',true);
                    $('#description9').attr('readOnly',true);
                    $('#eventType9').attr('readOnly',true);
                    $('#payment_method9').attr('readOnly',true);
                    $('#dateStart9').attr('readOnly',true);
                    $('#hourStart9').attr('readOnly',true);
                    $('#minsStart9').attr('readOnly',true);
                    $('#dateEndU9').attr('readOnly',true);
                    $('#hourEnd9').attr('readOnly',true);
                    $('#minsEnd9').attr('readOnly',true);
                    $('#event_id9').attr('readOnly',true);
                    $('#event_id9').attr('readOnly',true);
                    $('#event_id_destroy9').attr('readOnly',true);
                    $('#namePatient9').attr('readOnly',true);
                    $('#payment_state9').attr('readOnly',true);
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

            options = request.value;
            medico_id = request.id;
            route = "{{route('reminder_switch_confirmed')}}";
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                url: route,
                data:{medico_id:medico_id,options:options},
                // Mostramos un mensaje con la respuesta de PHP
                success:function(result){

                    console.log(result);
                    if(result == 'Si'){
                        $('.time-check').fadeIn();
                    }else{
                        $('.time-check').fadeOut();
                    }
                },
                error:function(error){
                    console.log(error);
                },
            });
        }

        function switch_payment_and_past(request){

            options = request.value;
            medico_id = request.id;
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

            $('#form, #fo3').submit(function(){
                if($('#confirmed_medico9').val() == 'Si'){
                    if($('#dateStart99').val() != $('#dateStart9').val() || $('#hourStart99').val() != $('#hourStart9').val() || $('#minsStart99').val() != $('#minsStart9').val()){
                        question = confirm('Se ha modificado la fecha de la consulta, al guardar cambio se enviara un correo al paciente para notificarle, ¿desea continuar?');
                        if(question == false){
                            return false;
                        }
                    }
                }

                loader();
                cerrar();
                errormsj = '';
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    error:function(error){
                        stop_loader();

                        console.log(error);
                        $.each(error.responseJSON.errors, function(index, val){
                            errormsj+='<li>'+val+'</li>';
                        });
                        $('#text_error_up1').html('<ul style="list-style:none;">'+errormsj+'</ul>');
                        $('#alert_error_up1').fadeIn();
                        $('#alert_success_up1').fadeOut();

                        console.log(error);
                    },
                    success:function(result){
                        stop_loader();

                        console.log(result);
                        if(result.message.error == 'fuera del horario'){
                            alert('Imposible guardar evento fuera del horario establecido');
                            // $('#text_error_up1').html('imposible guardar evento fuera del horario establecido');
                            // $('#alert_error_up1').fadeIn();
                        }else if(result.message.error == 'end menor start'){
                            alert('Imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
                            // $('#text_error_up1').html('Imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
                            // $('#alert_error_up1').fadeIn();
                        }else if(result.message.error == 'ya existe'){
                            alert('Imposible actualizar evento,Ya existe un Evento en las horas seleccionadas, por favor compruebe la fecha en el calendario e intente nuevamente');
                        }else if(result.message.error == 'fecha_editada'){
                            $('#text_success_up1').html('Se ha cambiado la "Hora/Fecha" de la consulta con Exito. Se ha enviado un correo al Paciente para notificarle del cambio de la consulta.');
                            $('#alert_success_up1').fadeIn();
                            $('#card_edit').fadeOut();
                        }else if(result.message.error == 'confirmado_editado'){
                            $('#text_success_up1').html('Se ha cambiado la "Hora/Fecha" y Confirmada consulta con Exito. Se ha enviado un correo al Paciente para notificarle del cambio de la consulta.');
                            $('#alert_success_up1').fadeIn();
                            $('#card_edit').fadeOut();
                        }else if(result.message.error == 'cita_confirmada'){
                            $('#text_success_up1').html(result.message.message_error);
                            $('#alert_success_up1').fadeIn();
                            $('#alert_error_up1').fadeOut();
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('refetchEvents');

                        }else if(result.message.error == 'ok'){
                            console.log(result);

                            $('#text_success_up1').html('Los datos de la cita, han sido guardados con exito.');
                            $('#alert_success_up1').fadeIn();
                            $('#alert_error_up1').fadeOut();
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('refetchEvents');

                        }else if(result.message.error == 'fecha_pasada'){
                            alert(result.message.message_error);

                        }

                    }
                });

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

                events:"{{route('medico_diary_events',\Hashids::encode($medico->id))}}",

                eventClick: function(event, jsEvent, view){

                    var start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                    var end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
                    hour_start = $.fullCalendar.moment(event.start).format('HH');
                    mins_start = $.fullCalendar.moment(event.start).format('mm');
                    hour_end = $.fullCalendar.moment(event.end).format('HH');
                    mins_end = $.fullCalendar.moment(event.end).format('mm');



                    // boton Iniciar consulta
                    if(event.title != 'Ausente' & event.title != 'Personal' & event.state != 'Realizada y por cobrar' & event.state != 'Pagada y Completada' & event.confirmed_medico == 'Si'){
                        $('#btn_ini_consul').show();
                    }else{
                        $('#btn_ini_consul').hide();
                    }

                    if(event.state == 'Realizada y por cobrar' || event.state == 'Pagada y Completada'){

                        $('#acciones_realizadas').show();
                    }else{
                        $('#acciones_realizadas').hide();
                    }
                    // Realizada y por cobrar
                    if(event.title == 'Ausente' || event.title == 'Personal'){
                        cerrar();
                        $('#event_id10').val(event.id);
                        $('#title10').val(event.title);                        $('#description10').val(event.description);
                        $('#date_start10').val(start);
                        $('#hour_start10').val(hour_start);
                        $('#mins_start10').val(mins_start);
                        $('#hour_end10').val(hour_end);
                        $('#mins_end10').val(mins_end);
                        $('#card_personal').fadeIn();
                        $('#card_edit').hide();
                        return false;
                    }
                    $('#event_id4').val(event.id);
                    $('#event_id5').val(event.id);

                    /////////////
                    $('#patient_id9').val(event.patient_id);
                    $('#patient_id10').val(event.patient_id);
                    $('#patient_id11').val(event.patient_id);

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
                    $('#card_edit').fadeOut();

                    $('#alert_success_up1').fadeOut();
                    vaciar();

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
                        $('#confirmed_patient9').attr('readOnly',true);
                        $('#confirmed_medico9').attr('readOnly',true);
                        $('#price9').attr('readOnly',true);
                        $('#title9').attr('readOnly',true);
                        $('#state9').attr('readOnly',true);
                        $('#description9').attr('readOnly',true);
                        $('#eventType9').attr('readOnly',true);
                        $('#payment_method9').attr('readOnly',true);
                        $('#dateStart9').attr('readOnly',true);
                        $('#hourStart9').attr('readOnly',true);
                        $('#minsStart9').attr('readOnly',true);
                        $('#dateEndU9').attr('readOnly',true);
                        $('#hourEnd9').attr('readOnly',true);
                        $('#minsEnd9').attr('readOnly',true);
                        $('#event_id9').attr('readOnly',true);
                        $('#event_id9').attr('readOnly',true);
                        $('#event_id_destroy9').attr('readOnly',true);
                        $('#namePatient9').attr('readOnly',true);
                        $('#payment_state9').attr('readOnly',true);

                    }else{
                        $('#confirmed_patient9').attr('readOnly',false);
                        $('#confirmed_medico9').attr('readOnly',true);
                        $('#price9').attr('readOnly',false);
                        // $('#title9').attr('readOnly',false);
                        $('#state9').attr('readOnly',true);
                        $('#description9').attr('readOnly',false);
                        $('#eventType9').attr('readOnly',false);
                        $('#payment_method9').attr('readOnly',false);
                        $('#dateStart9').attr('readOnly',false);
                        $('#hourStart9').attr('readOnly',false);
                        $('#minsStart9').attr('readOnly',false);
                        $('#dateEndU9').attr('readOnly',false);
                        $('#hourEnd9').attr('readOnly',false);
                        $('#minsEnd9').attr('readOnly',false);
                        $('#event_id9').attr('readOnly',false);
                        $('#event_id9').attr('readOnly',false);
                        $('#event_id_destroy9').attr('readOnly',false);
                        $('#namePatient9').attr('readOnly',true);
                        $('#payment_state9').attr('readOnly',true);
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

                        if($('#cita_confirm_completed').val() != 1){
                            $('#confirmed_completed').attr('disabled',true);
                            $('#button_confirmed_complete').attr('disabled',true);

                        }

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
                    //////////////////////////////////////////////
                    if(event.confirmed_medico != 'Si'){
                        $('#but_save').attr('value','Guardar y Confirmar');
                        $('#button_confirmed_payment').attr('disabled',true);
                    }else{
                        $('#but_save').attr('value','Guardar');
                        $('#button_confirmed_payment').attr('disabled',false);
                    }
                    /////////////////////////////////////////////////
                    $('#card_personal').hide();
                    $('#card_edit').fadeIn();
                    // Realizada y por cobrar
                    if(event.state == 'Realizada y por cobrar'){
                        $('#but_save').hide();

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
                    if($('#filtro_confirmed_medico').val() != 'Ninguno'){

                        if(event.confirmed_medico == 'Si' &&  event.rendering != 'background'){
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
            $('#filtro_confirmed_medico').val('Ninguno');

            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('refetchEvents');
        }

        function filtro_title(result){
            $('#filtro_title').val(result);
            $('#filtro_state').val('Ninguno');
            $('#filtro_payment_method').val('Ninguno');
            $('#filtro_confirmed_medico').val('Ninguno');

            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('refetchEvents');
        }

        function filtro_payment_method(result){
            $('#filtro_payment_method').val(result);
            $('#filtro_state').val('Ninguno');
            $('#filtro_title').val('Ninguno');
            $('#filtro_confirmed_medico').val('Ninguno');

            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('refetchEvents');
        }


        function filtro_todas(){
            $('#filtro_title').val('Ninguno');
            $('#filtro_state').val('Ninguno');
            $('#filtro_payment_method').val('Ninguno');
            $('#filtro_confirmed_medico').val('Ninguno');
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('refetchEvents');
        }

        function filtro_confirmed_medico(result){
            $('#filtro_title').val('Ninguno');
            $('#filtro_state').val('Ninguno');
            $('#filtro_payment_method').val('Ninguno');
            $('#filtro_confirmed_medico').val(result);
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

            $('#card_personal').fadeOut();
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

                },
                success:function(result){
                    if(result == 'fuera del horario'){
                        $('#text_error').html('Imposible crear evento fuera del horario establecido');
                        $('#alert_error').fadeIn();
                        $('#alert_success').fadeOut();
                    }else if(result == 'end menor start'){
                        $('#text_error').html('imposible guardar evento, la fecha/hora de incio de la cita, debe ser menor a la fecha de culminacion');
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

        function cancel(result){
            loader();
            $('#mail_cancel').modal('hide');
            cerrar();

            send = result;

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
                    // alert(result);

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
            loader();
            cerrar();


            event_id = $('#event_id9').val();

            route = "{{route('appointment_confirm_ajax')}}";
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'post',
                url:route,
                data:{event_id:event_id},
                error:function(error){
                    stop_loader();
                    console.log(error);
                },
                success:function(result){
                    stop_loader();
                    console.log(result);
                    cerrar();
                    $('#text_success_up1').html(result);
                    $('#alert_success_up1').fadeIn();
                    $('#alert_error_up1').fadeOut();
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('refetchEvents');
                    $('#confirmed_medico9').fadeIn();
                    $('#button_confirm_app').fadeOut();




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
        ///////////////////////////////////////////////////////
        $('#btn-confirmar').click(function(){

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
                    if(result == 'fecha_pasada'){
                        alert('La cita posee una fecha que ya paso, por favor actualize la fecha y guarde los cambios para poder dar confirmación a esta cita.');
                        return false;
                    }
                    $('#text_success_up1').html(result);
                    $('#alert_success_up1').fadeIn();
                    $('#alert_error_up1').fadeOut();
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('refetchEvents');
                    console.log(result);


                }
            });
        });


        //////////////AGREGAR EN EDIT appointment
        function manage_patient(){
            medico_id = $('#medico_id9').val();
            patient_id = $('#patient_id9').val();
            route = $('#route_manage').val();

            route = route.replace('m_id', medico_id);
            route = route.replace('p_id', patient_id);


            window.location.href = route;
        }


        ///////////////////////
        </script>





    @endsection
