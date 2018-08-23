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
						<table class="table table-responsive table-bordered">
						  <thead class="thead-color">
						    <tr>

						      <th class="text-center">Nombre del Centro medico</th>
						      <th class="text-center">Nombre del administrador</th>
							 <th class="text-center">Email del administrador</th>
							 <th class="text-center">Teléfono Administrador</th>

						      <th class="text-center">Teléfonos</th>
						      <th class="text-center">Opciones</th>

						    </tr>
						  </thead>
						  <tbody>
								@foreach ($medicalCenters as $medicalCenter)
									@if ($medicalCenter->tradename != 'Otro')


								<tr>

										<td class="text-center">{{$medicalCenter->name}}</td>
										<td class="text-center">{{$medicalCenter->nameAdmin}}</td>
										<td class="text-center">{{$medicalCenter->emailAdmin}}</td>
										<td class="text-center">{{$medicalCenter->phone_admin}}</td>
										<td class="text-center">
											<ul style="list-style:none">
											<li>{{$medicalCenter->phone}}</li>
											<li>{{$medicalCenter->phone2}}</li>
										</ul>
										</td>
										<td><div class="btn-group" role="group" aria-label="...">
											<div class="row">
												<div class="col-12">
													<a class="btn btn-info  text-center" data-toggle="tooltip" data-placement="top" title="Ver mas" role="button" href="{{route('medicalCenter.edit',\Hashids::encode($medicalCenter->id))}}">Perfil</i>
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
