@extends('layouts.app')

@section('content')
<section class="box-register">
	<div class="container">
		<div class="register">
			<div class="row">
				<div class="col-12 mb-5">
					<h2 class="text-center font-title">profesionales de la Salud</h2>
				</div>
			</div>
			<div class="row">
				<table class="table table-responsive table-config">
					<thead class="thead-color">
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">identification</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Apellido</th>
							<th class="text-center">email</th>
							<th class="text-center">teléfono</th>
							{{-- <th class="text-center">Ciudad</th> --}}
							<th class="text-center">Opciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach ($medicos as $medico)
						<tr>
							<th scope="row">{{$medico->id}}</th>
							<td class="text-center">{{$medico->identification}}</td>
							<td class="text-center">{{$medico->name}}</td>
							<td class="text-center">{{$medico->lastName}}</td>
							<td class="text-center">{{$medico->email}}</td>
							<td class="text-center">{{$medico->phone}}</td>
							{{-- <td class="text-center">{{$medico->medicalCenter->id}}</td> --}}
							<td><div class="btn-group" role="group" aria-label="...">
								<div class="row">
									<div class="col-12">
										<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Ver mas" role="button" href=""><i class="fas fa-bars"></i>
										</a>
									</div>
								</div>
							</div>
						</td>

						@endforeach

					</tbody>
				</table>
			</div>

		</div>
	</div>
</section>


@endsection
