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

              <p><b>Tu Cuenta a sido Confirmada, solo falta esperar la  Autorización del medico Profesional: {{$assistant->medico->name}} {{$assistant->medico->lastName}},para que puedas acceder a sus archivos. Una vez ocurra esto podras usar tu cuenta.</b>.</p>
              <a href="{{route('home')}}">Ir a Inicio</a>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection
