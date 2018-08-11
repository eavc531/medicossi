@extends('layouts.app')

@section('content')
<section class="">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Pacientes</h2>
					</div>

				</div>
					<div class="row mb-3">

						<div class="col-12 text-right">
							<a class="btn btn-secondary" href="{{route('panel_control_administrator')}}">Atras</a>
						</div>
					</div>
				<div class="row">
						<table class="table table-responsive table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">Cedula</th>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Apellido</th>
									<th class="text-center">Telefono 1</th>
									<th class="text-center">Telefono 2</th>
									<th class="text-center">email</th>
									<th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>


								@foreach ($patients as $patient)
								<tr>
									<td scope="row">{{$patient->identification}}</td>
									<td class="text-center">{{$patient->name}}</td>
									<td class="text-center">{{$patient->lastName}}</td>
									<td class="text-center">{{$patient->phone1}}</td>
									<td class="text-center">{{$patient->phone2}}</td>
									<td class="text-center">{{$patient->email}}</td>


								</tr>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">{{ $patients->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
