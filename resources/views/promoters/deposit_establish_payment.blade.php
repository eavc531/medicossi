@extends('layouts.app')

@section('content')
<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h3 class="text-center font-title">Marcar Deposito como Pagado</h3>
					</div>
				</div>

                <div class="card mt-5">
                    <div class="card-body">
                        {{Form::model($record,['route'=>'deposit_establish_payment_store'])}}
                        <h4 class="font-title-blue my-3 text-center">Datos cliente Invitado</h4>
                        <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">Fecha de Pago Cliente</label>
                                        {{Form::text('date_start',\Carbon\Carbon::parse($record->date_start)->format('d-m-Y'),['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">identificación Cliente</label>
                                        {{Form::text('name_client',$record->medico->identification,['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">Nombre del Cliente</label>
                                        {{Form::text('name_client',$record->medico->nameComplete,['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">Nombre del Plan</label>
                                        {{Form::text('name_client',$record->name,['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">Periodo del plan</label>
                                        {{Form::text('name_client',$record->period,['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">Precio del plan</label>
                                        {{Form::text('name_client',$record->price,['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">comision por plan</label>
                                        {{Form::text('name_client',$record->comision,['class'=>'form-control','disabled'])}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="font-title">Estado del Pago</label>
                                        @if($record->state_payment == 'no') {{Form::text('name_client','Pendiente',['class'=>'form-control','disabled'])}} @else {{Form::text('name_client','Pagado',['class'=>'form-control','disabled'])}} @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h4 class="font-title-blue my-3 text-center">Cuenta a depositar</h4>
                                </div>
                                <div class="col-12 form-inline">
                                    <label for="" class="font-title mr-2">Agregar Cuenta: </label>
									@if($account_numbers->first() != Null)
										{{Form::select('account_select',['select_account'=>'pre-agregadas por promotor','Otra'=>'Otra'],null,['class'=>'form-control','id'=>'account_select'])}}
									@else
										{{Form::select('account_select',['select_account'=>'pre-agregadas por promotor','Otra'=>'Otra'],'Otra',['class'=>'form-control','id'=>'account_select'])}}
									@endif

                                </div>
								@if($account_numbers->first() != Null)
									<div class="mt-3 card" id="list_account">
								@else
									<div class="mt-3 card" id="list_account" style="Display:none">
								@endif

									@if($account_numbers->first() != Null)

                                    <div class="card-header ">
                                        <h5>Lista de Cuentas Promotor</h5>
                                    </div>
                                    <div class="card-body">


                                    <table class="table table-config table-bordered">
                                        <thead>
                                            <th>Nombre Banco</th>
                                            <th>Numero de Cuenta</th>
                                            <th>Nombre del Titular </th>
                                            <th>Cedula del titular</th>
                                            <th>Email</th>
                                            <th>Seleccionar</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($account_numbers as $account)
                                            <tr>
                                                <td><span class="valor">{{$account->name_banco}}</span></td>
                                                <td><span class="valor">{{$account->number_account}}</span></td>
                                                <td><span class="valor">{{$account->name_titular}}</span></td>
                                                <td><span class="valor">{{$account->identification}}</span></td>
                                                <td><span class="valor">{{$account->email}}</span></td>
                                                <td>
                                                    <button onclick="select(this)" type="button" class="btn btn-secondary select-button"><i class="fas fa-check"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    </div>
								@else
									<div class="card-body text-center bg-warning text-white">
										No ahi Numeros de Cuenta registrados por el promotor
									</div>

								@endif
                                </div>

                                {{Form::open(['route'=>'deposit_establish_payment_store','method'=>'POST','id'=>'form_id'])}}
                                <div class="col-12 row mt-5">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" class="font-title">Nombre del Banco</label>
                                            {{Form::text('name_banco',null,['class'=>'form-control','id'=>'name_banco'])}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" class="font-title">Numero de Cuenta</label>
                                            {{Form::text('number_account',null,['class'=>'form-control','id'=>'number_account'])}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" class="font-title">Nombre del titular</label>
                                            {{Form::text('name_titular',null,['class'=>'form-control','id'=>'name_titular'])}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" class="font-title">identificación</label>
                                            {{Form::text('identification',null,['class'=>'form-control','id'=>'identification'])}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" class="font-title">Email</label>
                                            {{Form::text('email',null,['class'=>'form-control','id'=>'email'])}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" class="font-title">Fecha de Deposito</label>
                                            {{Form::date('date_payment',\carbon\carbon::now(),['class'=>'form-control','id'=>'email'])}}
                                        </div>
                                    </div>
                                    {{Form::hidden('record_id',$record->id)}}
                                    <div class="col-12 mt-5">
                                        <a href="{{route('promoter_deposits_pending',$record->promoter_id)}}" class="btn btn-secondary float-right ml-2   ">Cancelar</a>
                                        <button type="submit" name="button" class="btn btn-success float-right">Guardar y marcar deposito como pagado</button>

                                    </div>

                                </div>
                                {{Form::close()}}
                        </div>
                    </div>
                </div>
		</div>
	</section>


@endsection
@section('scriptJS')
    <script type="text/javascript">
        function select(result){
            $('.select-button').removeClass('btn-success');
            $('.select-button').addClass('btn-secondary');
            $(result).addClass('btn-success');

            valor1 = $(result).parents('tr').find('td').eq(0).find('.valor').html();
            valor2 = $(result).parents('tr').find('td').eq(1).find('.valor').html();
            valor3 = $(result).parents('tr').find('td').eq(2).find('.valor').html();
            valor4 = $(result).parents('tr').find('td').eq(3).find('.valor').html();
            valor5 = $(result).parents('tr').find('td').eq(4).find('.valor').html();

            $('#name_banco').val(valor1);
            $('#number_account').val(valor2);
            $('#name_titular').val(valor3);
            $('#identification').val(valor4);
            $('#email').val(valor5);
        }

        $('#account_select').change(function(){
            if($(this).val() == 'Otra'){
                $('#list_account').fadeOut();
                $('#name_banco').val("");
                $('#number_account').val("");
                $('#name_titular').val("");
                $('#identification').val("");
                $('#email').val("");


            }else{
                $('#list_account').fadeIn();
            }

        });
    </script>
@endsection
