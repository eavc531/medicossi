@extends('layouts.app')

@section('content')
<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Médicos Agregados:</h2>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-6 text-left">
						{{-- <a class="btn btn-config-blue" href="{{route('promoters.create')}}">Agregar Nuevo Medico</a> --}}
					</div>
					<div class="col-6  text-right">
						<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
					</div>
				</div>

        @if($client->first() != Null)
          <div class="row">
              <table class="table table-responsive table-config">
                <thead class="thead-color">
                  <tr>
                    <th class="text-center">Fecha de Alta</th>
                    <th class="text-center">Id</th>
										<th class="text-center">Tipo de Cliente</th>
                    <th class="text-center">Nombre</th>
										<th class="text-center">Estado</th>
										<th class="text-center">Plan Cotratado</th>
										<th>Acciones</th>

                  </tr>
                </thead>
                <tbody>

                  @foreach ($client as $medico)
                  <tr>
                    <td class="text-center">{{$medico->created_at->format('d-m-Y')}}</th>
                    <td class="text-center">{{$medico->identification}}</th>
                    <td class="text-center">{{$medico->name}}</th>
                    {{-- <td class="text-center">{{$medico->lastName}}</td> --}}
                    <td class="text-center">{{$medico->email}}</td>
                    <td><a class="btn btn-secondary">Plan Contratado</a>
                    <a class="btn btn-secondary">Comicion Generada</a>
                    <a class="btn btn-secondary">Depositos a sus Cuentas</a>
									</td>

                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">{{ $client->links() }}</td>
                  </tr>
                </tfoot>
              </table>
          </div>
        @else
          <h4>No existen Médicos Registrados</h4>
        @endif


			</div>
		</div>
	</section>


@endsection
