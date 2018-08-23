@extends('layouts.app')

@section('content')
<div class="container">


<section>
  <div class="box-register">
    <div class="row">
      <div class="col-12 text-right">
        <div class="btn-group " role="group" aria-label="Basic example">
          <button type="button" class="btn btn-secondary">1</button>
          <button type="button" class="btn btn-config-blue">2</button>
          <button type="button" class="btn btn-secondary">3</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <div class="box-message">
          <div class="row">
            <div class="col-12">
              <h3>¡Muchas Felicidades!</h3>
            </div>
            <div class="col-12">

              <p><b>Ya eres un miembre de la mejor red de médicos y profesionales de la salud</b>.</p>
              <p>Solo falta que ingreses a tu cuenta de correo para que actives tu cuenta.</p><a href="{{route('home')}}">Ir a Inicio</a>
            </div>
            <div class="col-12 mb-3">
              <div class="row">
                <div class="col-lg-12 col-12 mt-1">
                  <button class="btn btn-secondary" data-toggle="collapse" data-target="#demo">Ver Datos otorgados</button>
                </div>
              </div>

              <div id="demo" class="collapse mt-2" style="border:1px solid black">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Nombre de la Institucion: {{$medicalCenter->name}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Nombre del Administrador: {{$medicalCenter->nameAdmin}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Telefono: {{$medicalCenter->phone_admin}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>pais: {{$medicalCenter->country}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Correo: {{$medicalCenter->emailAdmin}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>password: *****</label>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-12">

              <a class="btn btn-primary"href="{{route('resend_mail_medical_center',\Hashids::encode($medicalCenter->id))}}">Reenviar Correo de Confirmación</a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
@endsection
