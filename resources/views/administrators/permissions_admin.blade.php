@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
@endsection
@section('content')
	<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h5 class="text-center font-title-blue">Panel en desarrollo (aun no establece los persimos)</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mb-5">
						<h4 class="text-center font-title">Permisos administrador: {{$administrator->name}} {{$administrator->lastName}}</h4>
					</div>
				</div>

				<div class="text-right">
					<a href="{{route('assistant_medicos',$administrator->id)}}" class="btn btn-secondary">Atras</a>
				</div>


				<div class="row mt-4">

					<table class="table table-bordered table-striped">
						<thead class="">
							<tr>
								<th class="">Nombre del Permiso</th>
								<th class="">Descripción</th>
								<th class="">Estado</th>
							</tr>
						</thead>

                        {!!Form::model($permissions,['route'=>'assistant_permissions_store','method'=>'POST'])!!}
						<tbody>
                            <input type="hidden" name="permission_id" value="{{$permissions->id}}">

                            <input type="hidden" name="administrator_id" value="{{$administrator->id}}">

								<tr>
									<th class="">Crear Administradores</th>
									<td class="text-justify">Permisoso para agregar nuevos administradores al sistema</td>
									<td class="text-justify">


											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('admin_create')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>

                                    </td>
								</tr>
								<tr>
									<th class="">Editar datos administradores</th>
									<td class="text-justify">Permisos para editar datos de los administradores</td>
									<td class="text-justify">


											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('admin_edit')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>

                                    </td>
								</tr>
                                <tr>
									<th class="">Borrar usuarios administradores</th>
									<td class="text-justify">Permiso para borrar usuarios de tipo administrador</td>
									<td class="text-justify">
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('admin_delete')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
                                        </td>
								</tr>
								<tr>
									<th class="">Crear promotores</th>
									<td class="text-justify">Permsiso para Agregar nuevos promotores al sistema</td>
									<td class="text-justify">

											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('promoter_create')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>

                                        </td>
								</tr>

                                <tr>
									<th class="">Marcar pagos a promotores</th>
									<td class="text-justify">Permiso para maracar depisitos de promotores como pagados</td>
									<td class="text-justify">

											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('promoter_check_deposit')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>

                                        </td>
								</tr>
                                <tr>
									<th class="">Bloquear/habilitar promotores</th>
									<td class="text-justify">permisos para bloquear o habilitar promotores</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_change_date == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('promoter_desactivate')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

                                        </td>
								</tr>
								<tr>
									<th class="">Bloquear/Habilitar Asistentes</th>
									<td class="text-justify">Permisos para bloquear y habilitar usuarios de tipo asistentes</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->assistant_desactivate == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('assistant_desactivate')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Establecer precios de planes</th>
									<td class="text-justify">Permisos para establecer precios y porcentajes de los planes</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->plans_set_price == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('plans_set_price')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Cambiar Permisos de administradores</th>
									<td class="text-justify">Privilegios para Editar permisos de los administradores</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->change_permissions == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('change_permissions')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>

						</tbody>



					</table>

                    <div class="text-right col-12">
                    	@assistant

					@else
						<a href="{{redirect()->getUrlGenerator()->previous()}}" class="btn btn-secondary">Cancelar</a>
						<input type="submit" class="btn btn-success disabled" name="" value="Guardar Cambios">
						@endassistant
                    </div>
                    {!!Form::close()!!}
				</div>
			</div>
		</div>
	</section>


@endsection
