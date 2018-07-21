@extends('layouts.app')

@section('content')
	<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h3 class="text-center font-title">Agregar Asistentes ya Registrados en el sistema</h3>
					</div>
				</div>
                <div class="text-right mb-1">

                </div>
                <div class="form-inline mb-5 p-3" style="border:solid 1px rgb(151, 155, 157)">
                  {!!Form::open(['route'=>'search_assistants_registered','method'=>'GET'])!!}
                  {!!Form::hidden('medico_id',$medico->id)!!}
                  {!!Form::text('search',null,['class'=>'form-control','placeholder'=>'nombre/cedula del Asistente','style'=>'width:250px'])!!}
                  {!!Form::submit('Buscar',['class'=>'btn btn-success'])!!}
                  {!!Form::close()!!}
                  <a href="{{route('add_assistant',$medico->id)}}" class="btn btn-primary ml-2">Mostrar Todos</a>
                  <a href="{{route('medico_assistants',$medico->id)}}" class="btn btn-secondary ml-2">Mis Asistentes</a>
                    </div>

				<div class="row mt-4">
					<table class="table table-bordered">
						<thead class="">
							<tr>
                                <th class="text-center">cedula</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Apellido</th>
								<th class="text-center">Email</th>
								{{-- <th class="text-center">Ciudad</th> --}}
								<th class="text-center">Opciones</th>
							</tr>
						</thead>
						<tbody>
                        @if(isset($search) and $assistants->first() != NUll)

                            <div class="col-12 text-center mb-2 text-secondary">
                                <strong>Resultados de Busqueda:</strong>
                            </div>
                            @foreach ($assistants as $assistant)
                                @if($assistant->medico_id != $medico->id)
                                <tr>
                                    <td class="text-center">{{$assistant->identification}}</td>
                                    <td class="text-center">{{$assistant->name}}</td>
                                    <td class="text-center">{{$assistant->lastName}}</td>
                                    <td class="text-center">{{$assistant->email}}</td>

                                    <td><div class="btn-group" role="group" aria-label="...">
                                        <div class="row">
                                            <div class="col-12">
                                                {{Form::open(['route'=>'add_assistant_store','method'=>'post'])}}
                                                    <input type="hidden" name="medico_id" value="{{$medico->id}}">
                                                    <input type="hidden" name="assistant_id" value="{{$assistant->id}}">
                                                    <input class="btn btn-primary" type="submit" name="" value="Agregar Asistente">
                                                {{Form::close()}}

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                </tr>
                            @endif
                        @endforeach
                        @elseif(isset($search) and $assistants->first() == Null)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-primary">No se encontraron resultados para la Busqueda</h5>
                                </div>
                            </div>
                        @elseif($assistants->first() != Null)
                            @foreach($assistants as $assistant)

								<tr>
                                    <td class="text-center">{{$assistant->identification}}</td>
									<td class="text-center">{{$assistant->name}}</td>
									<td class="text-center">{{$assistant->lastName}}</td>
									<td class="text-center">{{$assistant->email}}</td>

									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">
                                                {{Form::open(['route'=>'add_assistant_store','method'=>'post'])}}
                                                    <input type="hidden" name="medico_id" value="{{$medico->id}}">
                                                    <input type="hidden" name="assistant_id" value="{{$assistant->id}}">
                                                    <input class="btn btn-primary" type="submit" name="" value="Agregar Asistente">
                                                {{Form::close()}}
											</div>
										</div>
									</div>
								</td>

								</tr>

							@endforeach
                        @elseif($assistants->first() == Null)


                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-primary">Sin registros de Asistentes que mostrar</h5>
                                </div>
                            </div>
                        @endif


						</tbody>

					</table>

                        <div class="card-footer col-12 text-center">
    						{{$assistants->appends(request()->all())->links()}}
    					</div>


				</div>

			</div>
		</div>
	</section>


@endsection
