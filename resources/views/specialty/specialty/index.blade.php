@extends('layouts.app')

@section('content')
<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Especialidades Medicas</h2>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-6 text-left">
						<a class="btn btn-config-green" href="{{route('specialty.create')}}">Crear Nueva Especialidad</a>
					</div>
					<div class="col-6 text-right">
						<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
					</div>
				</div>
				<div class="row">
						<table class="table table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Nombre</th>
									 <th class="text-center">Otros Nombres</th>
						      <th class="text-center">Descripción</th>
									 <th class="text-center">Categoria</th>
									<th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>

								@foreach ($specialties as $specialty)
								<tr>
									<th scope="row">{{$specialty->id}}</th>
									<td class="text-center">{{$specialty->name}}</th>
									<td class="text-center">
										<ul style="list-style:none">
											@isset($specialty->synonymous1)
												<li>{{$specialty->synonymous1}}</li>
											@endisset
											@isset($specialty->synonymous2)
												<li>{{$specialty->synonymous2}}</li>
											@endisset
											@isset($specialty->synonymous3)
												<li>{{$specialty->synonymous3}}</li>
											@endisset

										 </ul>
									</td>
									<td class="text-center">{{$specialty->description}}</td>
									<td class="text-center">{{$specialty->specialty_category->name}}</td>
									<td><div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">



												<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Editar" role="button" href="{{route('specialty.edit',\Hashids::encode($specialty->id))}}">Editar
												</a>
												<a class="btn btn-danger text-center" data-toggle="tooltip" data-placement="top" title="Editar" role="button" href="">Eliminar
												</a>

											</div>
										</div>
									</div>
								</td>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">{{ $specialties->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>

@endsection
