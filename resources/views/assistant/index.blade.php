@extends('layouts.app')

@section('content')
	<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Asistentes</h2>
					</div>
				</div>
				<div class="row">
					<a href="{{route('medico_assistant_create',\Hashids::encode($medico->id))}}" class="btn btn-primary mr-2">Registrar Asistente</a>
					<a href="{{route('add_assistant',\Hashids::encode($medico->id))}}" class="btn btn-success">Agregar Asistente ya registrado</a>
				</div>
				<div class="row mt-4">
					<table class="table table-bordered">
						<thead class="">
							<tr>

								<th class="text-center">Nombre</th>
								<th class="text-center">Apellido</th>
								<th class="text-center">Email</th>
								{{-- <th class="text-center">Ciudad</th> --}}
								<th class="text-center">Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($medico_asistants as $m_a)
								<tr>

									<td class="text-center">{{$m_a->assistant->name}}</td>
									<td class="text-center">{{$m_a->assistant->lastName}}</td>
									<td class="text-center">{{$m_a->assistant->email}}</td>

									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">
												<a href="{{route('assistant_permissions',\Hashids::encode($m_a->permission_id))}}"class="btn btn-warning btn-block" data-toggle="tooltip" data-placement="top" title="permisos" role="button" >Permisos
												</a>
											</div>
										</div>
									</div>
								</td>

								</tr>
							@endforeach

						</tbody>

					</table>
					<div class="card-footer col-12 text-center">
						{{$medico_asistants->links()}}
					</div>
				</div>

			</div>
		</div>
	</section>


@endsection
