@extends('layouts.app')

@section('content')

<div class="row">
  <div class="container">
    <div class="text-center">
      <h3>Felicidades</h3>
    </div>
<h5 class="mt-5">has Contratado el Plan Basico con exito, Puedes Acceder en cualquier Momento al panel planes, para cambiar de plan, cada plan añade nuevas utilidades para Mejorar tu rendimiento laboral, y nuevas posibilidades para atraer nuevos clientes.</h5>

<div class="row mt-5">
  <div class="col-6">
    <a href="{{route('planes_medic',\Hashids::encode(request()->id))}}" class="btn btn-success btn-block">Volver a Planes</a>
  </div>
  <div class="col-6">
    <a href="{{route('home')}}" class="btn btn-warning btn-block">Ir a Inicio</a>
  </div>
</div>

  </div>
</div>
@endsection
