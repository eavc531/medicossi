@extends('layouts.app')

@section('content')


<section class="box-register">

	<div class="container">
		<div class="register text-center">
      <h3>Ingresos</h3>
    </div>
          <div class="card">
            <div class="card-body">
              <h4>Ingresos Obtenidos:&nbsp;{{$ingresos_obtenidos}}</h4>
              {{-- <h4>Ingresos Pendientes:&nbsp;{{$ingresos_pendientes}}</h4> --}}
              <p>Cantidad de Citas Cobradas:&nbsp;{{$citas_cobradas}}</p>
              <p>Cantidad de Citas por Cobrar:&nbsp;{{$citas_pendientes}}</p>
            </div>
          </div>

        <a href="{{route('income_medic',\Hashids::encode(request()->id))}}" class="btn btn-primary space-btw-w-color">Citas Cobradas</a>
        <a href="{{route('income_medic_without_pay',\Hashids::encode(request()->id))}}" class="btn btn-warning disabled space-btw-w-color">Citas por Cobrar</a>
        <div class="text-center">
          <h5 class="title-citas">Citas por Cobrar</h5>
        </div>

        @if(@isset($list_citas_x_cobrar) and $list_citas_x_cobrar->first() != Null)
        <table class="table">
          <thead class="head-table">
            <tr>
              <th class="table-infor">Fecha de Realizacion</th>
              <th class="table-infor">Nombre del Paciente</th>
              <th class="table-infor">Tipo de Consulta</th>
              <th class="table-infor">Precio</th>
              <th class="table-infor">Tipo de Pago</th>
            </tr>

          </thead>
          <tbody class="body-table">
            @foreach ($list_citas_x_cobrar as $value)
            <tr>
              <td class="table-infor">{{$value->start}}</td>
              <td class="table-infor">{{$value->namePatient}}</td>
              <td class="table-infor">{{$value->eventType}}</td>
              <td class="table-infor">{{$value->price}}</td>
              <td class="table-infor">{{$value->payment_method}}</td>
            </tr>
          @endforeach
          </tbody>
            <td>{{$list_citas_x_cobrar->links()}}</td>
        </table>
      @else
        <h5 class="mt-5">No ahi registro de Citas</h5>
      @endif
	</section>

	@endsection
