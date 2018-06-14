@extends('layouts.app')

@section('content')
<section class="box-register">
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-5">
						<h2 class="text-center font-title">Ciudades asiganadas a: {{$administrator->name}} {{$administrator->lastName}}</h2>
					</div>
				</div>


				<div class="">
					{!!Form::open(['route'=>'citiesAdminStore','method'=>'POST'])!!}
					<label for="">Asignar Ciudad a: {{$administrator->name}} {{$administrator->lastName}}</label>
					<div class="row mt-2">
						<div class="col-lg-8 col-12">
							{!!Form::select('name',$citiesAll,null,['class'=>'form-control','placeholder'=>'seleccionar Ciudad'])!!}
						</div>
						<div class="col-lg-4 col-12">
							<div class="form-group">{!!Form::submit('Asignar Ciudad', ['class' => 'btn btn-config-blue'])!!}</div>
								{!!Form::hidden('administrator_id',$administrator->id)!!}
								{!!Form::close()!!}
						</div>
					</div>

				</div >
				<div class="row" style="margin-top:30px">
						<table class="table table-responsive table-config">
						  <thead class="thead-color">
						    <tr>
						      <th class="text-center">Nombre</th>
								<th class="text-center">Acciones</th>
						    </tr>
						  </thead>
						  <tbody>
								@foreach ($cities as $city)
								<tr>
									<td class="text-center">{{$city->name}}</td>
									<td class="text-center">
										</a>
											<a  class="btn btn-danger  text-center" data-toggle="tooltip" data-placement="top" title="Ciudades que puede editar" role="button" onclick="return confirm('Esta Seguro de Deshabilitar esta Ciudad.')" href="{{route('deleteCityAdmin',$city->id)}}"><i class="fas fa-ban"></i>
										</a>
									</td>
								</tr>
								@endforeach
						  </tbody>
				              <tfoot>
				                <tr>
				                  <td colspan="4">{{ $cities->links() }}</td>
				                </tr>
				              </tfoot>
						</table>
				</div>
				<div class="row">
				  	<div class="col-lg-6 col-12 mt-2">
				  		<a href="{{route('administrators.index')}}" class="btn-config-blue btn btn-block">Cancelar</a>
				  	</div>
				</div>

			</div>
		</div>
	</section>
@endsection
