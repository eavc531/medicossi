<div class="box-dashboard" id="dashboard">
  <div class="row">
    <div class="col-12">
      <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-05.png')}}" alt="">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-home fa-2"></i><span>Inicio</a>
    </div>
    <div class="col-12">
      <a href="{{route('panel_control_promoters',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-home fa-2"></i><span>Panel de Control</a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
    </div>
    <div class="col-12">
      <a href="#" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-gift"></i><span>Compartir</a>
    </div>
    <div class="col-12">
      <a href="{{route('accounts_number',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-gift"></i><span>Mis Numeros de Cuenta</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('add_medic',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Hacer Invitacion </span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('promoter_deposits',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Depositos</span></a>
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-12">
      <a href="{{route('add_medical_center',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Invitar Centro Médico </span></a>
    </div>
  </div> --}}
  {{-- <div class="row">
    <div class="col-12">
      <a href="{{route('list_client',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Lista de Clientes</span></a>
    </div>
  </div> --}}
  <div class="row">
    <div class="col-12">
      <a href="{{route('list_client',\Hashids::encode(Auth::user()->promoter_id))}}" class="btn btn-block btn-config-dashboard color-admin"><i class="far fa-thumbs-up"></i><span>Clientes</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{route('planes_medic_specialties')}}" class="btn btn-block btn-config-dashboard color-admin"><i class="fas fa-briefcase"></i><span>Descripción de Planes </span></a>
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
