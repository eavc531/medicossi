@elseif(Auth::check() and Auth::user()->hasRole('medico') and Auth::user()->medico->plan == Null)

    <!-- Copia desde aqui abajo -->
    <div class="box-dashboard" id="dashboard">
      <div class="row">

        <div class="col-12">
          <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
        </div>

      </div>
      <div class="row">

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
        <div class="col-12">

            <a href="{{route('medico_diary', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span style="font-size:10px;background:rgb(222, 46, 8);border-radius:10px;padding:5px;border-color:white;">Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>

        </div>
        <div class="col-12">
          <a href="{{route('medico.edit', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
        </div>
        {{-- <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Panel de control</span></a>
        </div> --}}

          <div class="col-12">

          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-list-alt"></i><span>Calificación</span></a>
        </div>

      </div>

      <div class="row">

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-book"></i><span>Mi Agenda</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('planes_medic',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Planes</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Ingresos</span></a>
        </div>

        {{-- <div class="col-12">
          <a href="{{route('reminders_medico',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
        </div> --}}
        <div class="col-12">
          <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
        </div>

      </div>
    </div>
    <!-- Hasta aqui -->
  @elseif(Auth::check() and Auth::user()->hasRole('medico'))
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
          <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic" style="border-bottom:solid 1px white"><strong><span style="font-size:14px;color:white;" class="p-2 m-1"> @if(Auth::user()->medico->plan == 'plan_profesional') Plan: Plan Profesional @elseif(Auth::user()->medico->plan == 'plan_agenda') Plan: Plan Mi Agenda @elseif(Auth::user()->medico->plan == 'plan_platino') Plan: Plan Platino
          @elseif(Auth::user()->medico->plan == 'plan_basico') Plan: Plan Basico
          @else @endif</span></strong></a>
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

      <div class="col-12">

        @if (Auth::user()->medico->plan == 'plan_agenda' or Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          @if(Auth::user()->medico->plan == 'plan_agenda')
            <a href="{{route('appointments_confirmed', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span style="font-size:10px;background:rgb(222, 46, 8);border-radius:10px;padding:5px;border-color:white;">Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
          @else
            <a href="{{route('appointments', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span style="font-size:10px;background:rgb(222, 46, 8);border-radius:10px;padding:5px;border-color:white;">Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
          @endif
        @endif

      </div>
      <div class="col-12">
        <a href="{{route('medico.edit', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
      </div>
      {{-- <div class="col-12">
        <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Panel de control</span></a>
      </div> --}}


    <div class="col-12">

        <a href="{{route('medico_patients',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
      </div>

      <div class="col-12">
        <a href="{{route('calification_medic',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-list-alt"></i><span>Calificación</span></a>
      </div>

    </div >

    <div class="row">


      <div class="col-12">
        <a href="{{route('medico_diary',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-book"></i><span>Mi Agenda</span></a>
      </div>

      <div class="col-12">
        <a href="{{route('medico_schedule',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
      </div>

      <div class="col-12">
        <a href="{{route('planes_medic',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Planes</span></a>
      </div>
      @if (Auth::user()->medico->plan == 'plan_agenda' or Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
      <div class="col-12">
        <a href="{{route('income_medic',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Ingresos</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('medico_reminders',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
      </div>
      @endif
      @if ( Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
      <div class="col-12">
        <a href="{{route('medico_assistants',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Asistentes</span></a>
      </div>
    @endif
      <div class="col-12">
        <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
      </div>

    </div>
  </div>
  <!-- Hasta aqui -->
