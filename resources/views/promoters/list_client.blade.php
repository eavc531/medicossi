@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">

						@admin
						<h2 class="text-center font-title">Clientes Invitados de {{$promoter->name}}  {{$promoter->lastName}} @if(isset($activated)) Activos
						@elseif(isset($desactivated)) Inactivos @endif
					@else
						<h2 class="text-center font-title">Clientes Invitados @if(isset($activated)) Activos
						@elseif(isset($desactivated)) Inactivos @endif
						@endadmin
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6 text-left form-inline">
							{!!Form::open(['route'=>['list_client_activated',request()->id],'method'=>'post'])!!}
							{!!Form::hidden('stateAccount','Activo')!!}

							@isset($active)
								<input type="submit" name="Activa" value="Activo" class="btn btn-success mr-1" disabled>
							@else
								<input type="submit" name="Activa" value="Activo" class="btn btn-success mr-1">
							@endisset

							{!!Form::close()!!}

							{!!Form::open(['route'=>['list_client_desactivated',request()->id],'method'=>'post'])!!}
							{!!Form::hidden('stateAccount','Inactivo')!!}
							@isset($inactive)
								<input type="submit" name="" value="Inactivo" class="btn btn-warning mr-1" disabled>
							@else
								<input type="submit" name="" value="Inactivo" class="btn btn-warning mr-1">
							@endisset
							{!!Form::close()!!}
							@if(isset($inactive) or isset($active))
								<a href="{{route('list_client',request()->id)}}" class="btn btn-primary">Todos</a>
							@else
								<a href="{{route('list_client',request()->id)}}" class="btn btn-primary disabled">Todos</a>
							@endif

						</div>
						<div class="col-6  text-right">
							@admin
								<a class="btn btn-secondary" href="{{route('promoters.index',$promoter->id)}}">Atras</a>

							@else
									<a class="btn btn-secondary" href="{{route('panel_control_promoters',request()->id)}}">Atras</a>
							@endadmin

						</div>
					</div>

					@if($client->first() != Null)
						<div class="row">
							<table class="table table-responsive table-config table-bordered">
								<thead class="thead-color">
									<tr>

										<th class="text-center">Fecha de Alta</th>
										<th class="text-center">cedula</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Apellido</th>
										<th class="text-center">Email</th>
										<th class="text-center">Plan Actual</th>
										<th>Comisones</th>
										<th>perfil</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($client as $medico)
										<tr>

											<td class="text-center">{{$medico->created_at->format('d-m-Y')}}</td>
											<td class="text-center">{{$medico->identification}}</td>

											<td class="text-center">{{$medico->name}} </td>
											<td class="text-center">{{$medico->lastName}} </td>
											{{-- <td class="text-center">{{$medico->lastName}}</td> --}}
											<td class="text-center">{{$medico->email}}</td>
											<td>@if($medico->plan == 'plan_agenda')
												Plan Agenda
											@elseif($medico->plan == 'plan_profesional')
												Plan Profesional
											@elseif($medico->plan == 'plan_platino')
												Plan Platino
											@else
												Plan basico (sin comisiones)
											@endif
											</td>


											<td>
											{{$medico->records_of_plans_medico->sum('comision')}} <a href="{{route('promoter_medico_comisions',$medico->id)}}" class="btn btn-info btn-sm float-right">ver</a>
											</td>
											<td>
												<a href="{{route('medico.edit',$medico->id)}}" class="btn btn-primary btn-sm">Perfil</a>
											</td>
											@endforeach
										</tbody>
										<tfoot>
											@if(!isset($inactive))
											<tr>
												<td colspan="6"><strong class="float-right">COMISIONES TOTALES:</strong></td>
												<td colspan="2"><strong>{{$suma}}</strong></td>
											</tr>
											@endif

												<tr>
													<td colspan="8">{{ $client->links() }}</td>
												</tr>

										</tfoot>
									</table>
								</div>
							@elseif(isset($activated))

								<div class="card mt-5 text-center">
									<div class="card-body">
										<h5 class="font-title-blue">No ahi registro de Médicos con algun plan activo</h5>
									</div>
								</div>

							@elseif(isset($desactivated))
								<div class="card mt-5 text-center">
									<div class="card-body">
										<h5 class="font-title-blue">No ahi registro de Médicos con  planes inactivos</h5>
									</div>
								</div>

							@else
								<div class="card mt-5 text-center">
									<div class="card-body">
										<h5 class="font-title-blue">No existen Médicos Registrados</h5>
									@endif
								</div>
							</div>
						</div>
					</div>
				</section>


			@endsection
