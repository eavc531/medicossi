@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Depositos @if(isset($pendientes))
							 Pendientes
						@elseif(isset($realizados))
							Realizados
						 @endif
						 de: {{$promoter->name}} {{$promoter->lastName}}
						</div>
					</div>
					<div class="row mb-3">

						<div class="col-6">
							@if(isset($pendientes))
								<a href="{{route('promoter_deposits_paid_out',$promoter->id)}}" class="btn btn-success">Pagados</a>
								<a href="{{route('promoter_deposits_pending',$promoter->id)}}" class="btn btn-warning disabled">pendientes</a>

								<a href="{{route('promoter_deposits',$promoter->id)}}" class="btn btn-primary">Todos</a>
							@elseif(isset($realizados))
								<a href="{{route('promoter_deposits_paid_out',$promoter->id)}}" class="btn btn-success disabled">Pagados</a>
								<a href="{{route('promoter_deposits_pending',$promoter->id)}}" class="btn btn-warning">pendientes</a>

								<a href="{{route('promoter_deposits',$promoter->id)}}" class="btn btn-primary">Todos</a>
							@else
								<a href="{{route('promoter_deposits_paid_out',$promoter->id)}}" class="btn btn-success">Pagados</a>
								<a href="{{route('promoter_deposits_pending',$promoter->id)}}" class="btn btn-warning">pendientes</a>

								<a href="{{route('promoter_deposits',$promoter->id)}}" class="btn btn-primary disabled">Todos</a>
							@endif


						</div>
						<div class="col-6  text-right">
							<a class="btn btn-secondary" href="{{route('promoters.index',request()->id)}}">Atras</a>
						</div>
					</div>

					@if($record_plans->first() != Null)
						<div class="row">
							<table class="table table-responsive table-config table-bordered">
								<thead class="thead-color">
									<tr>

										<th class="text-center">Fecha Pago Cliente</th>
										<th class="text-center">Cedula Cliente</th>
										<th class="text-center">nombre Cliente</th>
										{{-- <th class="text-center">Email Cliente</th> --}}
										<th class="text-center">Plan</th>
                                        <th class="text-center">Periodo</th>
                                        <th class="text-center">precio</th>
                                        <th class="text-center">comision</th>
										<th>Estado del Deposito</th>
										<th>fecha deposito</th>
                                        <th>Acciones</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($record_plans as $record)
										<tr>

											<td class="text-center">{{$record->created_at->format('d-m-Y')}}</td>
                                            <td class="text-center">{{$record->medico->identification}}</td>
											<td class="text-center">{{$record->medico->nameComplete}}</td>

											<td class="text-center">{{$record->name}} </td>
                                            <td class="text-center">{{$record->period}}</td>
                                            <td class="text-center">{{$record->price}}</td>
											<td class="text-center">{{$record->comision}} </td>
                                            <td class="text-center">@if($record->state_payment == 'no')<span class="text-warning">Pendiente</span>  @else <span class="text-success">Pagado</span> @endif </td>
													<td class="text-center">{{$record->date_payment}} </td>
		                                            <td class="text-center">
														@if($record->state_payment == 'no')
															@if(Auth::user()->role == 'Administrador')
																<a class="btn btn-success" href="{{route('deposit_establish_payment',$record->id)}}"><i class="fas fa-check"></i></a>
															@endif
														@else
															<a class="btn btn-info" href="{{route('deposit_details',$record->id)}}"><i class="fas fa-info"></i></a>
														@endif
														{{$record->info_payment}}

													</td>
                                            </tr>

											@endforeach
										</tbody>
										<tfoot>
											<tr>
												<td colspan="8"><strong class="float-right">COMISIONES PENDIENTES:</strong></td>
												<td colspan="2"><strong>{{$comisions_pending}}</strong></td>
											</tr>
											<tr>
												<td colspan="8"><strong class="float-right">COMISIONES PAGADAS:</strong></td>
												<td colspan="2"><strong>{{$comisions_paid_out}}</strong></td>
											</tr>
											<tr>
												<td colspan="8"><strong class="float-right">COMISIONES TOTALES:</strong></td>
												<td colspan="2"><strong>{{$total_comisiones}}</strong></td>
											</tr>


												<tr>
													<td colspan="10">{{ $record_plans->links() }}</td>
												</tr>

										</tfoot>
									</table>
								</div>

							@else
								<div class="card mt-5 text-center">
									<div class="card-body">
										@if(isset($pendientes))
											<h5 class="font-title-blue">No ahi registro de depositos Pendientes</h5>
			@elseif(isset($realizados))
				<h5 class="font-title-blue">No ahi registro de depositos Pagados</h5>
				@else
					<h5 class="font-title-blue">No ahi registro de depositos</h5>
			@endif


								</div>
							</div>
                        @endif
						</div>
					</div>
				</section>


			@endsection
