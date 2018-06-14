@extends('layouts.app')

@section('content')
<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Centros médicos</h2>
					</div>
				</div>
				<div class="row">
						<table class="table table-responsive">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Nombre del Centro medico</th>
						      <th class="text-center">Nombre del administrador</th>
									 <th class="text-center">Email del administrador</th>
						      <th class="text-center">Ciudad</th>
						      <th class="text-center">Opciones</th>

						    </tr>
						  </thead>
						  <tbody>
								@foreach ($medicalCenters as $medicalCenter)
									@if ($medicalCenter->tradename != 'Otro')


								<tr>
										<th scope="row">{{$medicalCenter->id}}</th>
										<td class="text-center">{{$medicalCenter->name}}</td>
										<td class="text-center">{{$medicalCenter->nameAdmin}}</td>
										<td class="text-center">{{$medicalCenter->emailAdmin}}</td>
										<td class="text-center"></td>
										<td><div class="btn-group" role="group" aria-label="...">
											<div class="row">
												<div class="col-12">
													<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Ver mas" role="button" href=""><i class="fas fa-bars"></i>
													</a>
												</div>
											</div>
										</div>
									</td>
								</tr>
								@endif
								@endforeach

						  </tbody>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
