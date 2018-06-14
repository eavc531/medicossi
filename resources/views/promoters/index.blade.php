@extends('layouts.app')

@section('content')
<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Promotores</h2>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-6 text-left">
						<a class="btn btn-config-blue" href="{{route('promoters.create')}}">Agregar Nuevo Promotor</a>
					</div>
					<div class="col-6  text-right">
						<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
					</div>
				</div>


				<div class="row">
						<table class="table table-responsive table-config">
						  <thead class="thead-color">
						    <tr>
									<th class="text-center">Inicio</th>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Apellido</th>
									<th class="text-center">Email</th>
									<th class="text-center">id#Promotor</th>
									<th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>

								@foreach ($promoters as $promoter)
								<tr>
									<td class="text-center">{{$promoter->created_at->format('d-m-Y')}}</th>
									<td class="text-center">{{$promoter->name}}</th>
									<td class="text-center">{{$promoter->lastName}}</td>
									<td class="text-center">{{$promoter->email}}</td>
									<td class="text-center">{{$promoter->id_promoter}}</td>
									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">
<!-- 													<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Clientes del promotor" role="button" href=""><i class="fas fa-users"></i>
													</a> -->
<!-- 														<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Comisiones Pagadas" role="button" href=""><i class="fas fa-list"></i>
														</a> -->

												</div>
												<div class="col-12">
													<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Clientes del promotor" role="button" href="{{route('clientsPromoter',$promoter->id)}}"><i class="fas fa-users"></i>
													</a>
													<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Ciudades Atendidas" role="button" href="{{route('listPermissionSet',$promoter->id)}}"><i class="fas fa-filter"></i>
													</a>
													<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Cuentas Bancarias" role="button" href="{{route('listPermissionSet',$promoter->id)}}"><i class="fas fa-money-bill-alt"></i>
													</a>
													<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Planes Que Puede Ofrecer" role="button" href="{{route('listPermissionSet',$promoter->id)}}"><i class="fas fa-ban"></i>
														</a>
												</div>
											</div>
										</div>
									</div>
								</td>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">{{ $promoters->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
