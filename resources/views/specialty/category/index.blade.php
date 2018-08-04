@extends('layouts.app')

@section('content')
<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Categorias</h2>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-6 text-left">
						<a class="btn btn-config-green" href="{{route('specialty_category.create')}}">Crear Categoria</a>
					</div>
					<div class="col-6 text-right">
						<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
					</div>
				</div>
				<div class="row">
						<table class="table table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Descripción</th>
									  <th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>

								@foreach ($categories as $category)
								<tr>
									<td class="text-center">{{$category->name}}</th>
									<td class="text-center">{{$category->description}}</td>
									<td class="text-center">
										@if($category->name != 'Dentistas' and $category->name != 'Medicina Alternativa' and $category->name != 'Medicos y Especialistas' and $category->name != 'Terapeutas y Nutricion')
										<div class="btn-group" role="group" aria-label="...">
										<div class="row">
											<div class="col-12">
												<a class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Editar" role="button" href="{{route('specialty_category.edit',$category->id)}}">Editar
												</a>
												<a onclick="return confirm('¿Esta segur@ de Eliminar Esta Categoria?')" class="btn btn-secondary  text-center" data-toggle="tooltip" data-placement="top" title="Editar" role="button" href="{{route('specialtyC_delete',$category->id)}}">Eliminar
												</a>
											</div>
										</div>
									</div>
								@else
											<span class="text-secondary">Categoria Indispensable</span>
									@endif
								</td>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">{{ $categories->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>

@endsection
