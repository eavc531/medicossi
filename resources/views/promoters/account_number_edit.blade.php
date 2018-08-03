@extends('layouts.app')

@section('content')
	<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Editar Numero de Cuenta</h2>
					</div>
					</div>

					<div class="col-12 mb-5">
						{{-- <button type="button" name="button" class="btn btn-primary" id="mostrar">Agregar Numero de Cuenta</button> --}}
						<a class="btn btn-secondary float-right" href="{{route('accounts_number',$account->promoter_id)}}">Atras</a>
					</div>



	<div class="my-5 card" id="formulario">
		<div class="card-header bg-warning">
			{{-- <button type="button" class="close float-right" name="button" onclick="cerrar()">x</button> --}}
			<h5 class="text-white"> Editar Numero Cuenta</h5>
		</div>
		<div class="card-body">
			{{Form::model($account,['route'=>'account_number_update','method'=>'POST'])}}
			<input type="hidden" name="account_id" value="{{$account->id}}">
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
					<input type="hidden" name="" value="{{$nameComplete = $account->name.' '.$account->lastName}}">
					<label for="" class="font-title">Nombre del Titular</label>
					{{Form::text('name_titular',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">identificación</label>
					{{Form::text('identification',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<label for="" class="font-title">Email</label>
					{{Form::text('email',null,['class'=>'form-control'])}}
				</div>
				<div class="col-6">
					<div class="row mt-4">
						<div class="col-6">
							<button type="submit" name="button" class="btn btn-block btn-success">Guardar Cambios</button>
						</div>
						<div class="col-6">
							<a class="btn btn-secondary btn-block" href="{{route('accounts_number',$account->promoter_id)}}">Cancelar</a>
						</div>
					</div>
				</div>
			</div>
			{{Form::close()}}
		</div>
	</div>



					</div>
				</section>


			@endsection

			@section('scriptJS')


			@endsection
