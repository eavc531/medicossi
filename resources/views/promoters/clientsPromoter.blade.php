@extends('layouts.app')

@section('content')
<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Clientes de: {{$promoter->name}} {{$promoter->lastName}}</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mb-5">
						<h3 class="text-center font-title">Centros Medicos</h3>
					</div>
				</div>
				<div class="row">
						<table class="table config-table">
						  <thead class="thead-color">
						    <tr>
									<th class="text-center">Inicio</th>
									<th class="text-center">Nombre del Centro Medico</th>
						      <th class="text-center">Nombre del Administrador</th>
									<th class="text-center">Email de Administrador</th>
									<th class="text-center">id#Promotor</th>

						    </tr>
						  </thead>
						  <tbody>

								@foreach ($medicalCenters as $mC)
								<tr>
									<td class="text-center"></td>
									<td class="text-center">{{$mC->tradename}}</td>
									<td class="text-center">{{$mC->nameAdmin}}</td>
									<td class="text-center">{{$mC->emailAdmin}}</td>
									<td class="text-center">{{$mC->id_promoter}}</td>
                </tr>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">{{ $medicalCenters->links() }}</td>
                </tr>
              </tfoot>
						</table>
						</div>


							<div class="row">
								<div class="col-12 mb-5">
									<h3 class="text-center font-title">Medicos</h3>
								</div>
							</div>

							<table class="table config-table">
							  <thead class="thead-color">
							    <tr>
										<th class="text-center">Inicio</th>
							      <th class="text-center">Nombre</th>
							      <th class="text-center">Apellido</th>
										<th class="text-center">Email</th>
										<th class="text-center">id#Promotor</th>

							    </tr>
							  </thead>
							  <tbody>

									@foreach ($medicos as $medico)
									<tr>

										<td class="text-center">{{$medico->created_at->format('d-m-Y')}}</td>
										<td class="text-center">{{$medico->name}}</td>
										<td class="text-center">{{$medico->lastName}}</td>
										<td class="text-center">{{$medico->email}}</td>
										<td class="text-center">{{$medico->id_promoter}}</td>
	                </tr>
									@endforeach

							  </tbody>
	              <tfoot>
	                <tr>
	                  {{-- <td colspan="4">{{ $medicos->links() }}</td> --}}
	                </tr>
	              </tfoot>
							</table>
						</div>

			</div>
		</div>
	</section>


@endsection
