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
					@if ($promoters->first() != Null)


						<table class="table table-responsive table-config">
						  <thead class="thead-color">

									<th class="text-center">Inicio</th>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Apellido</th>
									<th class="text-center">Email</th>
									<th class="text-center">id#Promotor</th>
									<th class="text-center">Acciones</th>

						  </thead>
						  <tbody>

								@foreach ($promoters as $promoter)
								<tr>
									<td class="text-center">{{$promoter->created_at->format('d-m-Y')}}</td>
									<td class="text-center">{{$promoter->name}}</td>
									<td class="text-center">{{$promoter->lastName}}</td>
									<td class="text-center">{{$promoter->email}}</td>
									<td class="text-center">{{$promoter->id_promoter}}</td>
									<td>

									<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Clientes del promotor" role="button" href="{{route('list_client',$promoter->id)}}"><i class="fas fa-users"></i>
									</a>
									<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Depositos" role="button" href="{{route('promoter_deposits_pending',$promoter->id)}}"><i class="fas fa-filter"></i>
									</a>
									<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Cuentas Bancarias" role="button" href="{{route('accounts_number',['p_id'=>$promoter->id,'back'=>'back'])}}"><i class="fas fa-money-bill-alt"></i>
									</a>
									{{-- <a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Planes Que Puede Ofrecer" role="button" href="{{route('listPermissionSet',$promoter->id)}}"><i class="fas fa-ban"></i>
										</a> --}}

								</td>
								</tr>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="6">{{ $promoters->links() }}</td>
                </tr>
              </tfoot>
						</table>
						@else

						<div class="card col-12 mt-5">
							<div class="card-body text-center">
								<h5 class="font-title-blue">No ahi registros que mostrar</h5>
							</div>
						</div>
						@endif
				</div>

			</div>
		</div>
	</section>


@endsection
