<div class="box-dashboard" id="dashboard">
  <div class="row">
    <div class="col-12">
      <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
    </div>
  </div>
  <div class="row">
    @if(Auth::user()->assistant->medico->plan != Null)
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-assistant" style="border-bottom:solid 1px white"><strong><span style="font-size:14px;color:white;" class="p-2 m-1"> @if(Auth::user()->assistant->medico->plan == 'plan_profesional') Plan: Plan Profesional @elseif(Auth::user()->assistant->medico->plan == 'plan_agenda') Plan: Plan Mi Agenda @elseif(Auth::user()->assistant->medico->plan == 'plan_platino') Plan: Plan Platino
        @elseif(Auth::user()->assistant->medico->plan == 'plan_basico') Plan: Plan Basico
      @else @endif</span></strong></a>
    </div>
    @endif
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-assistant"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-gift"></i><span>Compartir</span></a>
    </div>
  </div>
  <div class="row py-1">
    @plan_agenda
    <div class="col-12">
      <a href="{{route('medico_patients',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
    </div>
    @endplan_agenda
    <div class="col-12">
      <a href="{{route('medico_diary',\Hashids::encode(Auth::user()->assistant->medico->id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-book"></i><span>Mi Agenda</span></a>
    </div>
    @plan_agenda
    <div class="col-12">
      @plan_profesional
      <a href="{{route('appointments', \Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->assistant->medico->notification_number}})</span> </span></a>
      @else
      <a href="{{route('appointments_confirmed', \Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->assistant->medico->notification_number}})</span> </span></a>
      @endplan_profesional
    </div>
    <div class="col-12">
      <a href="{{route('medico_reminders',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
    </div>
    <div class="col-12">
      @edit_schedule
      <a href="{{route('medico_schedule',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
      @endedit_schedule
    </div>
    @endplan_agenda
  </div >
  <div class="row">
    @assistant
    <div class="col-12">
      <a href="{{route('medico.edit', \Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-user fa-2"></i><span>Ver Perfil</span></a>
    </div>
    @else
    <div class="col-12">
      <a href="{{route('medico.edit', \Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
    </div>
    @endassistant
    @plan_profesional
    @assistant
    @else
    <div class="col-12">
      <a href="{{route('medico_assistants',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-clipboard-list"></i><span>Asistentes</span></a>
    </div>
    @endassistant
    @endplan_profesional
    @plan_profesional
    <div class="col-12">
      <a href="{{route('calification_medic',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="far fa-list-alt"></i><span>Calificación</span><span class="badge badge-danger" >Nuevas ({{Auth::user()->medico->calification_not_see}})</span></a>
    </div>
    @endplan_profesional
    <div class="col-12">
      <a href="{{route('planes_medic',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-clipboard-list"></i><span>Planes</span></a>
    </div>
    @plan_agenda
    <div class="col-12">
      <a href="{{route('income_medic',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-clipboard-list"></i><span>Ingresos</span></a>
    </div>
    @endplan_agenda
    @if ( Auth::user()->assistant->medico->plan == 'plan_profesional' or Auth::user()->assistant->medico->plan == 'plan_platino')
    @endif
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
    </div>
  </div>
</div>
<div class="row mt-1">
  <div class="col-12">
    <a href="{{route('assistant_permissions',\Hashids::encode(Auth::user()->assistant->permission_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-mobile-alt"></i><span>Permisos otorgados</span></a>
  </div>
  <div class="col-12">
    <a href="{{route('assistant_medicos',\Hashids::encode(Auth::user()->assistant->id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="fas fa-mobile-alt"></i><span>Médicos que asisto</span></a>
  </div>
</div>
<div class="row mt-1">
  <div class="col-12">
    <div class="dropup">
      <button class="btn btn-block btn-config-dashboard color-assistant dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Desabilitados
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width:210px">
        <span class="ml-2 text-secondary">Desabilitado</span>
        <div class="dropdown-divider"></div>
        @plan_agenda_no
        <a href="{{route('medico_patients',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="dropdown-item"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
        <a href="{{route('medico_diary',\Hashids::encode(Auth::user()->assistant->medico_id) )}}" class="dropdown-item "><i class="fas fa-book"></i><span>Mi Agenda</span></a>
        <a href="{{route('appointments_confirmed', \Hashids::encode(Auth::user()->assistant->medico_id))}}" class="dropdown-item"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->assistant->medico->notification_number}})</span> </span></a>
        <a href="{{route('medico_reminders',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="dropdown-item"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
        <a href="{{route('medico_schedule',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="dropdown-item"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
        <a href="{{route('medico_assistants',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="dropdown-item"><i class="fas fa-clipboard-list"></i><span>Asistentes</span></a>
        @endplan_agenda_no
        @edit_schedule
        @else
        <a href="{{route('medico_schedule',\Hashids::encode(Auth::user()->assistant->medico_id))}}" class="dropdown-item"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
        @endedit_schedule
        {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
      </div>
    </div>
  </div>
</div>
<!-- Hasta aqui -->
@elseif(Auth::check() and Auth::user()->role == 'medico')
<input type="hidden" name="" value="{{$ruta_actual = Route::currentRouteName()}}">
@if($ruta_actual == 'manage_patient' or $ruta_actual == 'data_patient' or  $ruta_actual == 'data_patient_extract_perfil' or  $ruta_actual == 'create_edit_salubridad_report' or  $ruta_actual == 'patient_appointments_all' or  $ruta_actual == 'patient_appointments_no_confirmed' or  $ruta_actual == 'patient_appointments_confirmed' or   $ruta_actual == 'patient_appointments_paid_and_pending' or  $ruta_actual == 'patient_app_realizada_por_cobrar' or  $ruta_actual == 'patient_appointments_past_collect' or  $ruta_actual == 'patient_appointments_completed' or   $ruta_actual == 'patient_appointments_canceled' or  $ruta_actual == 'notes_patient' or  $ruta_actual == 'history_clinic_create' or  $ruta_actual == 'note_paper_bin' or  $ruta_actual == 'view_preview' or  $ruta_actual == 'note_edit' or  $ruta_actual == 'note_move' or  $ruta_actual == 'note_create' or  $ruta_actual == 'note_config' or  $ruta_actual == 'expedients_patient' or $ruta_actual == 'expedient_open' or $ruta_actual == 'expedient_preview' or $ruta_actual == 'medico_stipulate_appointment' or $ruta_actual == 'patient_files' or $ruta_actual == 'ending_appointment')

<div class="box-dashboard" id="dashboard">

  <div class="row">

    <div class="col-12">
      <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
    </div>
    @if(Auth::user()->medico->plan != Null)
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic" style="border-bottom:solid 1px white"><strong><span style="font-size:14px;color:white;" class="p-2 m-1">
        @if(Auth::user()->medico->plan == 'plan_profesional') Plan: Plan Profesional @elseif(Auth::user()->medico->plan == 'plan_agenda') Plan: Plan Mi Agenda @elseif(Auth::user()->medico->plan == 'plan_platino') Plan: Plan Platino
        @elseif(Auth::user()->medico->plan == 'plan_basico') Plan: Plan Basico
      @else @endif</span></strong></a>
    </div>
    @endif
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-home fa-2"></i><span>Inicio</a>
      </div>
      <div class="col-12" style="margin-top:1px">
        <a href="{{route('manage_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic" style="border-bottom:solid 1px white">
          @isset($patient)
          <div>Paciente:</div>
          {{$patient->nameComplete}}
          @endisset
        </a>
      </div>
      @if(Auth::check() and Auth::user()->medico->event_id != Null)
      <div class="col-12" style="margin-top:1px">
        <a href="{{route('ending_appointment',['id'=>\Hashids::encode(Auth::user()->medico->event->medico_id),'p_id'=>\Hashids::encode(Auth::user()->medico->event->patient_id),'app_id'=>\Hashids::encode(Auth::user()->medico->event_id)])}}" class="btn btn-block btn-config-dashboard color-medic" style="border-bottom:solid 1px white">
          @isset(Auth::user()->medico->event_id)

          <div>Consulta Abierta:</div>
          {{Auth::user()->medico->event->title}},
          {{\Carbon\Carbon::parse(Auth::user()->medico->event->start)->format('d-m-Y H:i')}}
          @endisset
        </a>
      </div>
      @endif
      <div class="col-12">
        <a href="{{route('manage_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-list"></i><span>Datos del Paciente</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('notes_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-notes-medical"></i><span>Notas Médicas</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('expedients_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-folder"></i><span>Expedientes</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('patient_files',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-upload"></i><span>Archivos</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('patient_appointments_all',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-calendar-alt"><span style="font-size:11"></span></i><span>Citas Paciente</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('medico_stipulate_appointment',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-calendar-check"></i><span>Agendar Citas</span></a>
      </div>
      @if(Auth::check() and Auth::user()->medico->event_id != Null)
      <div class="col-12" style="margin-top:1px">
        <a href="{{route('ending_appointment',['id'=>\Hashids::encode(Auth::user()->medico->event->medico_id),'p_id'=>\Hashids::encode(Auth::user()->medico->event->patient_id),'app_id'=>\Hashids::encode(Auth::user()->medico->event_id)])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-users"></i><span>Cerrar Consulta</span></a>
      </div>

      @else
      <div class="col-12" style="margin-top:1px">
        <a href="{{route('medico_patients',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-users"></i><span>Mis Pacientes</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('medico_diary',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-calendar-alt"></i><span>Mi Agenda</span></a>
      </div>

      @endif

    </div>

  </div>

  @else
<!-- Copia desde aqui abajo -->
<div class="box-dashboard" id="dashboard">
  <div class="row">
    <div class="col-12">
      <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
    </div>
  </div>
  <div class="row">
    @if(Auth::user()->medico->plan != Null)
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic text-center" style="border-bottom:solid 1px white">
        <strong>
          <span class="p-2">
            @if(Auth::user()->medico->plan == 'plan_profesional') Plan: Plan Profesional @elseif(Auth::user()->medico->plan == 'plan_agenda') Plan: Plan Mi Agenda @elseif(Auth::user()->medico->plan == 'plan_platino') Plan: Plan Platino
            @elseif(Auth::user()->medico->plan == 'plan_basico') Plan: Plan Basico
          @else @endif</span>
        </strong>
      </a>
    </div>
    @endif
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-gift"></i><span>Compartir</span></a>
    </div>
  </div>
  <div class="row py-1">
    @plan_agenda
    <div class="col-12">
      <a href="{{route('medico_patients',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
    </div>
    <div class="col-12">


        <button class="btn btn-block btn-config-dashboard color-medic" type="button" data-toggle="collapse" data-target="#test" aria-expanded="false" aria-controls="test">
          <i class="fas fa-history"></i> Historial
        </button>

      <div class="collapse" id="test">
        <div class="card card-body">
          @foreach (Auth::user()->medico->history as $value)
            <a href="{{route('manage_patient',['m_id'=>\Hashids::encode(Auth::user()->medico_id),'p_id'=>\Hashids::encode($value->patient_id)])}}" class="btn btn-white text-capitalize">{{$value->name}}</a>
            @endforeach
        </div>
      </div>

    </div>
    @endplan_agenda
    <div class="col-12">
      <a href="{{route('medico_diary',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-book"></i><span>Mi Agenda</span></a>
    </div>
    @plan_agenda
    <div class="col-12">
      @plan_profesional
      <a href="{{route('appointments', \Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
      @else
      <a href="{{route('appointments_confirmed', \Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
      @endplan_profesional
    </div>
    <div class="col-12">
      <a href="{{route('medico_reminders',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
    </div>
    <div class="col-12">
      <a href="{{route('medico_schedule',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
    </div>
    @endplan_agenda
  </div >
  <div class="row">
    @assistant
    <div class="col-12">
      <a href="{{route('medico.edit', \Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Ver Perfil</span></a>
    </div>
    @else
    <div class="col-12">
      <a href="{{route('medico.edit', \Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
    </div>
    @endassistant
    @plan_profesional
    @assistant
    @else
    <div class="col-12">
      <a href="{{route('medico_assistants',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Asistentes</span></a>
    </div>
    @endassistant
    @endplan_profesional
    @plan_profesional
    <div class="col-12">
      <a href="{{route('calification_medic',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-list-alt"></i><span>Calificación</span><span class="badge badge-danger" >Nuevas ({{Auth::user()->medico->calification_not_see}})</span></a>
    </div>
    @endplan_profesional
    <div class="col-12">
      <a href="{{route('planes_medic',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Planes</span></a>
    </div>
    @plan_agenda
    <div class="col-12">
      <a href="{{route('income_medic',\Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Ingresos</span></a>
    </div>
    @endplan_agenda
    @if ( Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
    @endif
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
    </div>
  </div>
</div>
@assistant
<div class="row mt-1">
  <div class="col-12">
    <a href="{{route('assistant_permissions',\Hashids::encode(Auth::user()->medico->id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Permisos otorgados</span></a>
  </div>
  <div class="col-12">
    <a href="{{route('assistant_medicos',\Hashids::encode(Auth::user()->medico->id))}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Médicos que asisto</span></a>
  </div>
</div>
@endassistant
<div class="row mt-1">
  <div class="col-12">
    <div class="dropup box-dashboard">
      <button class="btn btn-block btn-config-dashboard color-medic dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Desabilitados
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width:210px">
        <span class="ml-2 text-secondary">Desabilitado</span>
        <div class="dropdown-divider"></div>
        @plan_agenda_no
        <a href="{{route('medico_patients',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
        <a href="{{route('medico_diary',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item "><i class="fas fa-book"></i><span>Mi Agenda</span></a>
        @plan_profesional
        <a href="{{route('appointments', \Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
        @else
        <a href="{{route('appointments_confirmed', \Hashids::encode(Auth::user()->medico_id))}}" class="btn btn-block btn-config-dashboard color-assistant"><i class="far fa-bell"></i> <span>Citas <span class="badge badge-danger" >Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
        @endplan_profesional
        <a href="{{route('medico_reminders',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
        <a href="{{route('medico_schedule',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
        <a href="{{route('medico_assistants',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item"><i class="fas fa-clipboard-list"></i><span>Asistentes</span></a>
        @endplan_agenda_no
        @plan_profesional_no
        <a href="{{route('calification_medic',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item"><i class="fas fa-list-alt"></i><span>Calificación</span></a>
        <a href="{{route('medico_assistants',\Hashids::encode(Auth::user()->medico_id))}}" class="dropdown-item"><i class="fas fa-clipboard-list"></i><span> Asistentes</span></a>
        @endplan_profesional_no
        {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
      </div>
    </div>
  </div>
</div>
@endif
