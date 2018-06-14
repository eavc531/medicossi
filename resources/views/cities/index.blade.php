@extends('layouts.app')

@section('content')
<section class="">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Ciudades</h2>
					</div>

				</div>
					<div class="row mb-3">
						<div class="col-6 text-left">
							<a class="btn btn-config-green" href="{{route('administrators.create')}}">Agregar Administrador</a>
						</div>
						<div class="col-6 text-right">
							<a class="btn btn-secondary" href="{{route('home')}}">Atras</a>
						</div>
					</div>
				<div class="row">
						<table class="table table-responsive table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Nombre</th>
						      <th class="text-center">Apellido</th>
									<th class="text-center">Email</th>
									<th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>

								@foreach ($cities as $city)
								<tr>
									<th scope="row">{{$city->id}}</th>
									<td class="text-center">{{$city->name}}</th>
									<td class="text-center">{{$city->longitud}}</td>
									<td class="text-center">{{$city->latitud}}</td>
								@endforeach

						  </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">{{ $cities->links() }}</td>
                </tr>
              </tfoot>
						</table>
				</div>

			</div>
		</div>
	</section>


@endsection
