@extends('layouts.app')

@section('content')
<section class="">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Administradores</h2>
					</div>

				</div>
					<div class="row mb-3">
						<div class="col-6 text-left">
							<a class="btn btn-config-green" href="{{route('administrators.create')}}">Agregar Administrador</a>
						</div>
						<div class="col-6 text-right">
							<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
						</div>
					</div>
				<div class="row">
						<table class="table table-responsive table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Apellido</th>
									<th class="text-center">Email</th>
									<th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>

								@foreach ($administrators as $admin)
								<tr>
									<th scope="row">{{$admin->id}}</th>
									<td class="text-center">{{$admin->name}}</th>
									<td class="text-center">{{$admin->lastName}}</td>
									<td class="text-center">{{$admin->email}}</td>
									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">

												<div class="btn-group" role="group" aria-label="...">
													<div class="row">
														<div class="col-4">
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Editar" role="button" href="{{route('administrators.edit',$admin->id)}}"><i class="fas fa-edit"></i>
															</a>
														</div>
														<div class="col-4">
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Ciudades que puede editar" role="button" href="{{route('citiesAdmin',$admin->id)}}"><i class="fas fa-bars"></i>
															</a>

														</div>
														<div class="col-4">
															<a  class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Permisos" role="button" href="{{route('listPermissionSet',$admin->id)}}"><i class="fas fa-key"></i>
															</a>
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
                  <td colspan="4">{{ $administrators->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
