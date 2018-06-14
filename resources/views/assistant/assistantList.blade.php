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
						<table class="table table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Apellido</th>
									 <th class="text-center">Email</th>
						      <th class="text-center">Ciudad</th>
						      <th class="text-center">Opciones</th>
						    </tr>
						  </thead>
						  <tbody>
								@foreach ($assistants as $assistant)
								<tr>
									<th scope="row">{{$assistant->id}}</th>
									<td class="text-center">{{$assistant->name}}</td>
									<td class="text-center">{{$assistant->lastName}}</td>
									<td class="text-center">{{$assistant->email}}</td>
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
								@endforeach

						  </tbody>
							<tfoot>
								<tr>

								</tr>
							</tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
