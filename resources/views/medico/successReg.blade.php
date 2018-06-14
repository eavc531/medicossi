@extends('layouts.app')

@section('content')

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
              <div class="row">
                <div class="col-lg-12 col-12 mt-1">
                  <button class="btn btn-secondary" data-toggle="collapse" data-target="#demo">Ver Datos otorgados</button>
                </div>
              </div>

              <div id="demo" class="collapse mt-2" style="border:1px solid black">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Nombre: {{$medico->name}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Apellido: {{$medico->lastName}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Sexo: {{$medico->gender}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Especialidad: {{$medico->specialty}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Correo: {{$medico->email}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Pais: {{$medico->country}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Tlf: {{$medico->phone}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Contraseña: ****</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-12 mt-3">
              <a onclick="loader();this.form.submit()" href="{{route('resendMailMedicoConfirm',$medico->id)}}" class="btn btn-primary">Reenviar Correo de Confirmación</a>

           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

{{-- //@include('medico.modalresendMailConfirm') --}}
@endsection
