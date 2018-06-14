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
						<div class="col-6 text-left">
							<a class="btn btn-config-green" href="{{route('patient.create')}}">Agregar Paciente</a>
						</div>
						<div class="col-6 text-right">
							<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
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
									<th scope="row">{{$patient->identification}}</th>
									<td class="text-center">{{$patient->name}}</th>
									<td class="text-center">{{$patient->lastName}}</td>
									<td class="text-center">{{$patient->phone1}}</td>
									<td class="text-center">{{$patient->phone2}}</td>
									<td class="text-center">{{$patient->email}}</td>

									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">

												<div class="btn-group" role="group" aria-label="...">
													<div class="row">
														<div class="col-4">
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Editar" role="button" href="{{route('patient.edit',$patient->id)}}"><i class="fas fa-edit"></i>
															</a>
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Profesionales y Centros Medicos que a Calificado" role="button" href="{{route('patient.create',$patient->id)}}"><i class="fas fa-edit"></i>
															</a>
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Calificaion de Encuestas de estrellas" role="button" href="{{route('patient.create',$patient->id)}}"><i class="fas fa-edit"></i>
															</a>
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Comentarios Positivos del Servicio" role="button" href="{{route('patient.create',$patient->id)}}"><i class="fas fa-edit"></i>
															</a>
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Recomendaciones" role="button" href="{{route('patient.create',$patient->id)}}"><i class="fas fa-edit"></i>
															</a>
														</div>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">{{ $patients->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
