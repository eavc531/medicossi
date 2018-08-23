
@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
                        <h2 class="text-center font-title">Profesionales Médicos</h2>

					</div>
					</div>
					<div class="row mb-3">
								<div class="col-12">
                                    	<a href="{{route('panel_control_administrator')}}" class="btn btn-secondary float-right">Atras</a>
                                </div>
					</div>

					@if($medicos->first() != Null)
						<div class="col-12">
							<table class="table table-responsive table-config table-bordered">
								<thead class="thead-color">
									<tr>

										<th class="text-center">Fecha de Alta</th>
										<th class="text-center">cedula</th>
										<th class="text-center">Nombre Completo</th>
										<th class="">Email</th>
										<th class="text-center">Plan Actual</th>
										<th>Comisiones</th>
										<th>Calificación</th>
										<th>perfil</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($medicos as $medico)
										<tr style="font-size:14px">

											<td class="text-center">{{$medico->created_at->format('d-m-Y')}}</td>
											<td class="text-center">{{\Hashids::encode($medico->id)entification}}</td>

											<td class="text-center">{{$medico->name}} {{$medico->lastName}}</td>

											{{-- <td class="text-center">{{$medico->lastName}}</td> --}}
											<td class="" style="font-size:12px">{{$medico->email}}</td>
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
											{{$medico->records_of_plans_medico->sum('comision')}} <a href="{{route('promoter_medico_comisions',\Hashids::encode($medico->id))}}" class="btn btn-info btn-sm float-right">ver</a>
											</td>
											<td>
												<a href="{{route('calification_medic',\Hashids::encode($medico->id))}}" class="btn btn-info btn-sm float-right">ver</a>
												@if($medico->cailification == Null)
													0/5
												@else
													{{$medico->cailification}}/5
												@endif
												de {{$medico->votes}} voto(s)
											</td>
											<td>
												<a href="{{route('medico.edit',\Hashids::encode($medico->id))}}" class="btn btn-primary btn-sm">Perfil</a>
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
													<td colspan="8">{{ $medicos->links() }}</td>
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
