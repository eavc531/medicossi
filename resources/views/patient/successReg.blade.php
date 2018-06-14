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
              <h3>¡Felicidades!</h3>
            </div>
            <div class="col-12">


              <p>Se ha enviado un mesaje de confirmacion, al correo asociado a tu registro para que confirmes tu Cuenta.</p><a href="{{route('home')}}">Ir a Inicio</a>
              <div class="row">
                <div class="col-lg-12 col-12 mt-1">
                  <button class="btn btn-secondary" data-toggle="collapse" data-target="#demo">Ver Datos otorgados</button>
                </div>
              </div>

              <div id="demo" class="collapse mt-2" style="border:1px solid black">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Nombre: {{$patient->name}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Apellido: {{$patient->lastName}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Sexo: {{$patient->gender}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Tlf: {{$patient->phone1}}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <label>Correo: {{$patient->email}}</label>
                  </div>
                  <div class="col-lg-6 col-12">
                    <label>Contraseña: ****</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-12 mt-3">
              <a href="{{route("resend_mail_confirm_patient",$patient->id)}}" class="btn btn-primary">Reenviar Correo de Confirmación</a>

             </a>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

{{-- //@include('medico.modalresendMailConfirm') --}}
@endsection
