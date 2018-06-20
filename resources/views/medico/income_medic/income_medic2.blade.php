@extends('layouts.app')

@section('content')


<section class="box-register">

	<div class="container">
		<div class="register text-center">
      <h3>Ingresos</h3>
    </div>
          <div class="card">
            <div class="card-body">
              <h4>Ingresos Obtenidos:{{$ingresos_obtenidos}}</h4>
              {{-- <h4>Ingresos Pendientes:{{$ingresos_pendientes}}</h4> --}}
              <p>Cantidad de Citas Cobradas:{{$citas_cobradas}}</p>
              <p>Cantidad de Citas por Cobrar:{{$citas_pendientes}}</p>
            </div>
          </div>

        <a href="{{route('income_medic',request()->id)}}" class="btn btn-primary disabled">Citas Cobradas</a>
        <a href="{{route('income_medic_without_pay',request()->id)}}" class="btn btn-warning">Citas por Cobrar</a>
        <div class="">
          <h5>Citas por Cobrar</h5>
        </div>

        @if(@isset($list_citas_cobradas) and $list_citas_cobradas->first() != Null)
        <table class="table">
          <thead>
            <tr>
              <th>Fecha de Realizacion</th>
              <th>Nombre del Paciente</th>
              <th>Tipo de Consulta</th>
              <th>Precio</th>
              <th>Tipo de Pago</th>
            </tr>

          </thead>
          <tbody>
            @foreach ($list_citas_cobradas as $value)
            <tr>
              <td>{{$value->start}}</td>
              <td>{{$value->namePatient}}</td>
              <td>{{$value->eventType}}</td>
              <td>{{$value->price}}</td>
              <td>{{$value->payment_method}}</td>
            </tr>
          @endforeach
          </tbody>
            <td>{{$list_citas_cobradas->links()}}</td>
        </table>


      @else
        <h5 class="mt-5">No ahi registro de Citas</h5>
      @endif
	</section>

	@endsection
