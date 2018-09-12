<div class="box-dashboard" id="dashboard">
  <div class="row">
    <div class="col-12">
      <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-gift"></i><span>Compartir</a>
    </div>
  </div>
  <div class="row py-1">
    {{-- <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div> --}}
    <div class="col-12">
      <a href="{{route('patient_profile',\Hashids::encode(Auth::user()->patient_id))}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-user fa-2"></i><span>Perfil</a>
    </div>
    <div class="col-12">
      <a href="{{route('patient_medicos',\Hashids::encode(Auth::user()->patient_id))}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-users"></i><span>Mis medicos</span></a>
    </div>
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-search"></i><span>Buscar Médicos</span></a>
    </div>
    <div class="col-12">
      <a href="{{route('patient_appointments',\Hashids::encode(Auth::user()->patient_id))}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-notes-medical mr-1"></i><span>Citas Médicas</span></a>
    </div>
  </div>

</div>
