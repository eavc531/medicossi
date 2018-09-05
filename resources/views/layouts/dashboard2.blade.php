@if(Auth::check() and Auth::user()->hasRole('admin'))
<div class="box-dashboard mb-5" id="dashboard">
  <div class="row">
    <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-05.png')}}" alt="">
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-gift"></i><span>Compartir</a>
    </div>
  </div>
  <div class="row p-1">
    <div class="col-12 nopadding">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div>
    <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-chart-bar fa-2"></i><span>Dashboard</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 nopadding">
      <a href="{{route('administrators.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-users fa-2"></i><span>Administradores</a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('promoters.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-users"></i><span>Promotores</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('plans.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-briefcase"></i><span>Planes</span></a>
    </div>
  </div>
  <div class="row p-1">
    <div class="col-12 nopadding">
      <a href="{{route('MedicalCenterList')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-building"></i><span>Centros Medicos</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('medicosList')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-user-md"></i><span style="margin-left: 2%;">Profesionales  <br> de la salud</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('assistant.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-user"></i><span>Asistentes</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 nopadding">
      <a href="{{route('patient.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fab fa-accessible-icon"></i><span>Pacientes</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 nopadding">
      <a href="{{route('specialty.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-table"></i><span>Especialidad</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('sub_specialty.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-th-list"></i><span>Sub-Especialidad</span></a>
      <div class="col-12 nopadding">
        <a href="{{route('specialty_category.index')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-table"></i><span>Categorias</span></a>
      </div>
    </div>
  </div>
</div>
@elseif(Auth::check() and Auth::user()->hasRole('medico'))
<!-- Copia desde aqui abajo -->
<div class="box-dashboard" id="dashboard">
  <div class="row">
    <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-gift"></i><span>Compartir</span></a>
    </div>
  </div>
  <div class="row p-1">
    <div class="col-12 nopadding">
      <a href="{{route('medico.edit', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
    </div>
    <div class="col-12 nopadding">
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('medico_patients',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Mis Pacientes</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('medico_patients',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Mis Calificaciones</span></a>
    </div>
  </div>
  <div class="row">
    {{-- <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user-plus fa-2"></i><span>Agregar comentario y/o calificación</span></a>
    </div> --}}
  </div>
  <div class="row p-1">
    {{-- <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-table"></i><span>Especialidad</span></a>
    </div> --}}
    <div class="col-12 nopadding">
      <a href="{{route('medico_schedule',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Editar Horario</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-book"></i><span>Agenda</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
    </div>
  </div>
</div>
<!-- Hasta aqui -->
@elseif(Auth::check() and Auth::user()->role == 'Promotor')
<div class="box-dashboard" id="dashboard">
  <div class="row">
    <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-05.png')}}" alt="">
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-gift"></i><span>Compartir</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('add_medic',Auth::user()->promoter_id)}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Invitar Profesional </span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('add_medical_center',Auth::user()->promoter_id)}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Invitar Centro Médico </span></a>
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-12">
      <a href="{{route('list_client',Auth::user()->promoter_id)}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Lista de Clientes</span></a>
    </div>
  </div> --}}
  <div class="row">
    <div class="col-12">
      <a href="{{route('list_client',Auth::user()->promoter_id)}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Lista de Clientes Invitados</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Planes</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Contrato</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Recursos</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Descarga tu app</span></a>
    </div>
  </div>
</div>
@elseif(Auth::check() and Auth::user()->role == 'Paciente')
<div class="box-dashboard" id="dashboard">
  <div class="row">
    <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-05.png')}}" alt="">
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-gift"></i><span>Compartir</a>
    </div>
  </div>
  <div class="row p-1">
    <div class="col-12 nopadding">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('patient_profile',Auth::user()->patient_id)}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-home fa-2"></i><span>Perfil</a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('patient_medicos',Auth::user()->patient_id)}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-users"></i><span>Mis medicos</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-users"></i><span>Buscar Médicos</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-users"></i><span>Citas Médicas</span></a>
    </div>
  </div>
  <div class="row">
    {{-- <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-user-plus fa-2"></i><span>Agregar comentario y/o calificación</a>
    </div>
  </div>
  <div class="row p-1">
    {{-- <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-book"></i><span>Agendar cita</span></a>
    </div> --}}
    <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-cogs"></i><span>Recursos</span></a>
    </div>
    <div class="col-12 nopadding">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
    </div>
  </div>
</div>
@endif