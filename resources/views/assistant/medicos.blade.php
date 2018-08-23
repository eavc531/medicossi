@extends('layouts.app')

@section('content')
	<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Médicos que asisto</h2>
					</div>
				</div>
				<div class="text-center text-secondary">
					Seleccione el Médico al que desea asistir
				</div>
				<div class="row mt-4">
					<table class="table table-bordered">
						<thead class="">
							<tr>

								<th class="text-center">Nombre</th>
								<th class="text-center">Apellido</th>
								<th class="text-center">Email</th>
								{{-- <th class="text-center">Ciudad</th> --}}
								<th class="text-center">Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($assistant_medicos as $a_m)
								<tr>

									<td class="text-center">{{$a_m->medico->name}}</td>
									<td class="text-center">{{$a_m->medico->lastName}}</td>
									<td class="text-center">{{$a_m->medico->email}}</td>

									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="form-inline col-12">
                                                {{Form::open(['route'=>'assist_medico','type'=>'post'])}}
                                                <input type="hidden" name="medico_id" value="{{$a_m->medico_id}}">
                                                <input type="hidden" name="permission_id" value="{{$a_m->permission_id}}">
                                                <input type="submit" class="btn btn-primary mr-2" name="" value="Asistir">
                                                {{Form::close()}}

                                                <a href="{{route('assistant_permissions',\Hashids::encode($a_m->permission_id))}}"class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="permisos" role="button" >Permisos Otorgados
                                                </a>




											</div>
										</div>
									</div>
								</td>

								</tr>
							@endforeach

						</tbody>

					</table>
					<div class="card-footer col-12 text-center">
						{{$assistant_medicos->links()}}
					</div>
				</div>

			</div>
		</div>
	</section>


@endsection
