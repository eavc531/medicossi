@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Planes</h2>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12 text-right">
						<a href="{{route('plans_porcentages')}}" class="btn btn-success">Porcentajes de comision para Promotores</a>
						<a class="btn btn-secondary" href="{{route('home')}}">inicio</a>

					</div>

				</div>
				<div class="row">
					<div class="col-12 mb-5">
						<h3>Planes para Medicos y Especialistas</h3>
					</div>

					<table class="table table-responsive table-config">
						<thead class="thead-color">
							<tr>
								<th class="text-center">Nombre</th>
								<th class="text-center">Aplicable a</th>
								<th class="text-center">Precio</th>

							</tr>
						</thead>
						<tbody>

							@foreach ($plans1 as $plan)
								<tr>
									<td>{{$plan->name}}</td>
										<td class="text-center">{{$plan->applicable}}</td>
										<td class="text-center">
											{!!Form::open(['route'=>'plans.store','method'=>'POST'])!!}

											<input type="hidden" name="plan_id" value="{{$plan->id}}">
											<div class="input-group">
												<div class="form-inline">
													<span>Mensual: </span>
													<input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2" name="price1" value="{{$plan->price1}}">
													<span>6 Meses</span>
													<input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2" name="price2" value="{{$plan->price2}}">
													<span>1 año</span>
													<input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2" name="price3" value="{{$plan->price3}}">
													<button class="btn btn-config-blue" data-toggle="tooltip" data-placement="top" title="Guardar precio" type="submit"><i class="fas fa-save"></i></button>
												</div>
											</div>

											{!!Form::close()!!}
										</td>

									@endforeach

								</tbody>
								<tfoot>
									<tr>

									</tr>
								</tfoot>
							</table>

							<div class="col-12 mb-5">
								<h3>Planes para Medicina Alternativa, Psicologos y Terapeutas</h3>
							</div>

							<table class="table table-responsive table-config">
								<thead class="thead-color">
									<tr>
										<th class="text-center">Nombre</th>
										<th class="text-center">Aplicable a</th>
										<th class="text-center">Precio</th>

									</tr>
								</thead>
								<tbody>



									@foreach ($plans2 as $plan)
										<tr>
											<td>{{$plan->name}}</th>
												<td class="text-center">{{$plan->applicable}}</td>
												<td class="text-center">
													{!!Form::open(['route'=>'plans.store','method'=>'POST'])!!}

													<input type="hidden" name="plan_id" value="{{$plan->id}}">
													<div class="input-group">
														<div class="form-inline">
															<span>Mensual: </span>
															<input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2" name="price1" value="{{$plan->price1}}">
															<span>6 Meses</span>
															<input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2" name="price2" value="{{$plan->price2}}">
															<span>1 año</span>
															<input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2" name="price3" value="{{$plan->price3}}">
															<button class="btn btn-config-blue" data-toggle="tooltip" data-placement="top" title="Guardar precio" type="submit"><i class="fas fa-save"></i></button>
														</div>
														{!!Form::close()!!}
													</div>


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

							{{-- modal-price edit --}}



							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Editar Precio plan: <span id="namePlan"></span></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											{!!Form::open(['route'=>'assistant.store','method'=>'POST'])!!}
											<label for="">Precio de <span id="namePlan"></span></label>
											{!!Form::number('price',null,['class'=>'form-control','id'=>'price'])!!}

											{!!Form::hidden('plan_id',null,['class'=>'form-control','placeholder'=>'Apellido','id'=>'plan_id'])!!}

											{!!Form::submit('Establecer Precio',['class'=>'btn btn-primary'])!!}
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											{!!Form::close()!!}
										</div>
										<div class="modal-footer">


										</div>
									</div>
								</div>
							</div>

						@endsection
