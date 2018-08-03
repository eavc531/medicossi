@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Numeros de Cuenta: {{$promoter->name}} {{$promoter->lastName}}</h2>
					</div>
					</div>
					
					<div class="col-12 mb-5">
						@if(Auth::user()->promoter_id == $promoter->id)

						<button type="button" name="button" class="btn btn-primary" id="mostrar">Agregar Numero de Cuenta</button>
					@endif
					@if(isset(request()->back))
						<a class="btn btn-secondary float-right" href="{{redirect()->getUrlGenerator()->previous()}}">Atras</a>
					@else
						<a class="btn btn-secondary float-right" href="{{route('home',request()->id)}}">Atras</a>
					@endisset

					</div>

@if (Session::Has('error_form'))


	<div class="my-5 card" id="formulario">
		<div class="card-header">

			<button type="button" class="close float-right" name="button" onclick="cerrar()">x</button>
			<h5 class="font-title"> Agregar Cuenta</h5>
		</div>
		<div class="card-body">
			{{Form::open(['route'=>'account_number_store','method'=>'POST'])}}
			<input type="hidden" name="promoter_id" value="{{$promoter->id}}">
			<div class="row">
				<div class="col-6">
					<label for="" class="font-title">Nombre del Banco</label>
					{{Form::text('name_banco',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">Numero de Cuenta</label>
					{{Form::number('number_account',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<input type="hidden" name="" value="{{$nameComplete = $promoter->name.' '.$promoter->lastName}}">
					<label for="" class="font-title">Nombre del Titular</label>
					{{Form::text('name_titular',$nameComplete,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">identificación</label>
					{{Form::text('identification',$promoter->id_promoter,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">Email</label>
					{{Form::text('email',$promoter->email,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<div class="row mt-4">
						<div class="col-6">
							<button type="submit" name="button" class="btn btn-block btn-success">Agregar</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-secondary btn-block" name="button" onclick="cerrar()">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			{{Form::close()}}
		</div>
	</div>
@else

	<div class="my-5 card" id="formulario" style="display:none">
		<div class="card-header">
			<button type="button" class="close float-right" name="button" onclick="cerrar()">x</button>
			<h5 class="font-title"> Agregar Cuenta</h5>
		</div>
		<div class="card-body">
			{{Form::open(['route'=>'account_number_store','method'=>'POST'])}}
			<input type="hidden" name="promoter_id" value="{{$promoter->id}}">
			<div class="row">
				<div class="col-6">
					<label for="" class="font-title">Nombre del Banco</label>
					{{Form::text('name_banco',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">Numero de Cuenta</label>
					{{Form::text('number_account',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<input type="hidden" name="" value="{{$nameComplete = $promoter->name.' '.$promoter->lastName}}">
					<label for="" class="font-title">Nombre del Titular</label>
					{{Form::text('name_titular',$nameComplete,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">identificación</label>
					{{Form::text('identification',$promoter->id_promoter,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">Email</label>
					{{Form::text('email',$promoter->email,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<div class="row mt-4">
						<div class="col-6">
							<button type="submit" name="button" class="btn btn-block btn-success">Agregar</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-secondary btn-block" name="button" onclick="cerrar()">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			{{Form::close()}}
		</div>
	</div>

@endif

					@if($account_numbers->first() != Null)
						<div class="row">
							<table class="table table-responsive table-config table-bordered">
								<thead class="thead-color">
									<tr>

										<th class="text-center">Banco</th>
										<th class="text-center">Numero de Cuenta</th>
                                        {{-- <th class="text-center">Tipo de Cuenta</th> --}}
										<th class="text-center">Nombre Titular</th>
										<th class="text-center">Cedula Titular</th>
										<th class="text-center">Email Titular</th>
										@if(Auth::user()->promotor_id == $promoter->id)
											<th class="text-center">Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>

									@foreach ($account_numbers as $account)
										<tr>

											<td class="text-center">{{$account->name_banco}}</td>
											<td class="text-center">{{$account->number_account}}</td>

											<td class="text-center">{{$account->name_titular}} </td>
											<td class="text-center">{{$account->identification}} </td>
											{{-- <td class="text-center">{{$medico->lastName}}</td> --}}
											<td class="text-center">{{$account->email}}</td>
										@if(Auth::user()->promotor_id == $promoter->id)
											<td>
												<a href="{{route('account_number_edit',$account->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
												<a onclick="return confirm('¿Esta segur@ de eliminar este Numero de Cuenta?')"href="{{route('account_number_delete',$account->id)}}" class="btn btn-danger"><i class="fas fa-times"></i></a>
											</td>
										@endif


											@endforeach
										</tbody>
										<tfoot>
											<tr>
													<td colspan="8">{{ $account_numbers->links() }}</td>
												</tr>

										</tfoot>
									</table>
								</div>
							@else
								<div class="card mt-5 text-center">
									<div class="card-body">
										<h5 class="font-title-blue">No ahi numeros de Cuenta registrados</h5>
								</div>
							</div>
                        @endif
						</div>
					</div>
				</section>


			@endsection

			@section('scriptJS')
				<script type="text/javascript">
					$('#mostrar').click(function(){
						$('#formulario').fadeIn();
					});

					function cerrar(){
						$('#formulario').fadeOut();
						$('.div-alert').fadeOut();

					}

				</script>

			@endsection
