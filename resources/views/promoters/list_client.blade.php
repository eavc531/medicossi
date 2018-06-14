@extends('layouts.app')

@section('content')
<section class="box-register">

		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Clientes Invitados @if(isset($activated)) Activos
						@elseif(isset($desactivated)) Inactivos @endif

						
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-6 text-left form-inline">
						{!!Form::open(['route'=>['list_client_activated',request()->id],'method'=>'post'])!!}
						{!!Form::hidden('stateAccount','Activo')!!}
						@isset($activated)
							<input type="submit" name="Activa" value="Activo" class="btn btn-success" disabled>
						@else
							<input type="submit" name="Activa" value="Activo" class="btn btn-success">
						@endisset

						{!!Form::close()!!}

						{!!Form::open(['route'=>['list_client_desactivated',request()->id],'method'=>'post'])!!}
						{!!Form::hidden('stateAccount','Inactivo')!!}
						@isset($desactivated)
							<input type="submit" name="" value="Inactivo" class="btn btn-warning" disabled>
						@else
							<input type="submit" name="" value="Inactivo" class="btn btn-warning">
						@endisset
						{!!Form::close()!!}
						<a href="{{route('list_client',request()->id)}}" class="btn">Todos</a>
					</div>
					<div class="col-6  text-right">
						<a class="btn btn-secondary" href="{{route('panel_control_promoters',request()->id)}}">Atras</a>
					</div>
				</div>

        @if($client->first() != Null)
          <div class="row">
              <table class="table table-responsive table-config">
                <thead class="thead-color">
                  <tr>
										<th class="text-center">Tipo de Cliente</th>
                    <th class="text-center">Fecha de Alta</th>
                    <th class="text-center">Nombre</th>
										<th class="text-center">Estado de Cuenta</th>
										<th class="text-center">Plan Contratado</th>
										<th>Acciones</th>
										<th>Estado de Cuenta</th>

                  </tr>
                </thead>
                <tbody>

                  @foreach ($client as $medico)
                  <tr>
										<td class="text-center">@if($medico->role == 'medico')Médico @else Centro Médico @endif</td>

                    <td class="text-center">{{$medico->created_at->format('d-m-Y')}}</td>
										@if($medico->role == 'medico')
										<td class="text-center">{{$medico->name}} {{$medico->lastName}}</td>
										@else
										<td class="text-center">{{$medico->name}}</td>
										@endif
                    {{-- <td class="text-center">{{$medico->lastName}}</td> --}}
                    <td class="text-center">{{$medico->email}}</td>
										<td>Plan</td>
                    <td><a class="btn btn-secondary">Plan Contratado</a>
                    <a class="btn btn-secondary">Comisión Generada</a>
                    <a class="btn btn-secondary">Depositos a sus Cuentas</a>
										@if($medico->role == 'medico')<a href="{{route('medico.edit',$medico->id)}}" class="btn btn-primary">Perfil</a> @else <a href="{{route('medicalCenter.edit',$medico->id)}}" class="btn btn-primary">Perfil</a>  @endif
									</td>
									<td>{{$medico->stateAccount}}</td>
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">{{ $client->links() }}</td>
                  </tr>
                </tfoot>
              </table>
          </div>
        @elseif(isset($activated))
          <h4>No existen Médicos Activos Registrados</h4>
				@elseif(isset($desactivated))
					<h4>No existen Médicos Inactivos Registrados</h4>
				@else
					<h4>No existen Médicos Registrados</h4>
        @endif


			</div>
		</div>
	</section>


@endsection
