@extends('layouts.app')

@section('content')
<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Centros Médicos Agregados:</h2>
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

        @if($medicalCenters->first() != Null)
          <div class="row">
              <table class="table table-responsive table-config">
                <thead class="thead-color">
                  <tr>
                    <th class="text-center">Fecha de Alta</th>
                    <th class="text-center">id del Centro Médico</th>
                    <th class="text-center">Nombre del Centro Médico</th>
                    <th class="text-center">Nombre del Administrador</th>
                    <th class="text-center">Email del Administrador</th>
                    <th class="text-center">Plan Contratado</th>
                    <th class="text-center">Comicion Generada</th>
                    <th class="text-center">Depositos a sus Cuentas</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($medicalCenters as $medico)
                  <tr>
                    <td class="text-center">{{$medico->created_at->format('d-m-Y')}}</th>
                    <td class="text-center">{{$medico->id_medicalCenter}}</th>
                    <td class="text-center">{{$medico->name}}</th>
                    <td class="text-center">{{$medico->nameAdmin}}</td>
                    <td class="text-center">{{$medico->emailAdmin}}</td>
                    <td class="text-center">Plan Contratado</td>
                    <td class="text-center">Comicion Generada</td>
                    <td class="text-center">Depositos a sus Cuentas</td>

                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">{{ $medicalCenter->links() }}</td>
                  </tr>
                </tfoot>
              </table>
          </div>
        @else
          <h4>No existen Centros Médicos Registrados</h4>
        @endif


			</div>
		</div>
	</section>


@endsection
