@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						@admin
						<h3 class="text-center font-title">Comisiones Generadas por Médico: {{$medico->name}} {{$medico->lastName}} @isset($medico->promoter->id) al Promotor: <span class="text-primary">{{$medico->promoter->name}} {{$medico->promoter->lastName}}</span></h3>
						@endisset

					@else
						<h2 class="text-center font-title">Comisiones Generadas por Médico: {{$medico->nameComplete}} </h2>
						@endadmin





						</div>
					</div>
					<div class="mb-3 text-right">
						<a class="btn btn-secondary" href="{{Session::get('back')}}">Atras</a>
					</div>

					@if($record_plans->first() != Null)
						<div class="row">
							<table class="table table-responsive table-config table-bordered">
								<thead class="thead-color">
									<tr>

										<th class="text-center">Plan</th>
										<th class="text-center">periodo</th>
										<th class="text-center">precio</th>
										<th class="text-center">desde</th>
										<th class="text-center">hasta</th>
										<th class="text-center">Cosmision generada</th>

									</tr>
								</thead>
								<tbody>

									@foreach ($record_plans as $plan)
										<tr>

											<td class="text-center">{{$plan->name}}</td>
											<td class="text-center">{{$plan->period}}</td>

											<td class="text-center">{{$plan->price}} </td>
											<td class="text-center">{{\Carbon\Carbon::parse($plan->date_start)->format('d-m-Y')}}</td>

											<td class="text-center">{{\Carbon\Carbon::parse($plan->date_end)->format('d-m-Y')}}</td>
											<td>{{$plan->comision}}</td>

											@endforeach

										</tbody>
										<tfoot>
											<tr>
												<th colspan="5"><span class="float-right">TOTAL COMISIONES:</span></th>
												<th colspan="1">{{ $record_plans->sum('comision') }}</th>
											</tr>
											<tr>
												<td colspan="6">{{ $record_plans->links() }}</td>
											</tr>
										</tfoot>
									</table>
								</div>
@else
								<div class="card mt-5 text-center">
									<div class="card-body">
										<h5 class="font-title-blue">No se han generado comisiones por parte de este Médico</h5>
									@endif
								</div>
							</div>



						</div>
					</div>
				</section>


			@endsection
