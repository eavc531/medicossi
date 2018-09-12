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
    
    <div class="col-12">
      <a href="{{route('medicalCenter.edit',\Hashids::encode(Auth::user()->medical_center_id))}}" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-user fa-2"></i><span>Perfil</a>
    </div>
  </div>
  <div class="row">
    {{-- <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-book"></i><span>Agendar cita</span></a>
    </div> --}}
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-cogs"></i><span>Recursos</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-patient"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
    </div>
  </div>
</div>
