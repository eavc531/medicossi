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
						@assistant
								<h4 class="text-center font-title"><span class="font-title-blue">Permisos Asistente:</span> {{$assistant->nameComplete}} <span class="font-title-blue">Otorgados por el Médico:</span> {{$medico->nameComplete}}</h4>

						@else
									<h3 class="text-center font-title">Permisos Asistente: {{$assistant->nameComplete}}</h3>
						@endassistant

					</div>
				</div>
				@if(Auth::user()->role == 'Asistente')
				<div class="text-right">
					<a href="{{route('assistant_medicos',\Hashids::encode($assistant->id))}}" class="btn btn-secondary">Atras</a>
				</div>
				<div class="text-center">
					<p class="text-secondary"></p>

				</div>
				@endif
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
                            <input type="hidden" name="medico_id" value="{{$medico->id}}">
                            <input type="hidden" name="assistant_id" value="{{$assistant  ->id}}">
							<tr>
								<td colspan="4" class="bg-warning text-center text-white"><strong>Citas Médicas</strong></td>
							</tr>
								<tr>
									<th class="">Agendar Citas con pacientes</th>
									<td class="text-justify">El asistente puede agendar citas dentro de el horario preestablecido por el Médico</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_patient_create == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_patient_create')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif
                                    </td>
								</tr>
								<tr>
									<th class="">Agendar evento personal</th>
									<td class="text-justify">El asistente puede crear eventos personales, para marcar horas de ausencia del Médico al que asiste</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_person_create == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_person_create')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif
                                    </td>
								</tr>
                                <tr>
									<th class="">Editar Citas</th>
									<td class="text-justify">El asistente puede editar datos de las citas tales como el precio entre otros.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_edit == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_edit')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif
                                        </td>
								</tr>
								<tr>
									<th class="">Rechazar Citas</th>
									<td class="text-justify">El asistente puede Rechazar las citas agendadas por un paciente de forma online</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_refuse == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_refuse')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif
                                        </td>
								</tr>

                                <tr>
									<th class="">Cancelar Citas</th>
									<td class="text-justify">El asistente puede cancelar las citas, y eliminarlas de las citas pendientes o por realizar</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_cancel == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_cancel')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif
                                        </td>
								</tr>
								{{-- <tr>
									<th class="">Confirmar Cita</th>
									<td class="text-justify">El asistente puede Confirmar las citas solicitadas desde las cuentas médicossi pacientes de forma online.</td>
									<td class="text-justify">
										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_confirm == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_confirm')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

                                        </td>
								</tr> --}}

                                <tr>
									<th class="">Cambiar o Posponer Citas</th>
									<td class="text-justify">El asistente puede cambiar la fecha de las citas, para otros dias disponibles dentro del horario</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_change_date == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_change_date')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

                                        </td>
								</tr>
								<tr>
									<th class="">marcar citas como pagadas</th>
									<td class="text-justify">El asistente puede marcar citas como pagadas</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_confirm_payment == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_confirm_payment')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">marcar citas como completadas</th>
									<td class="text-justify">El asistente puede marcar citas como completadas</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_confirm_completed == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_confirm_completed')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Confirmar Citas</th>
									<td class="text-justify">El asistente puede confirmar las citas agendadas por los pasientes desde su cuenta de pasiente Médicossi, (opcion disponible para el plan profesional o platino.)</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->cita_confirm == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('cita_confirm')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Editar Horario</th>
									<td class="text-justify">El asistente puede editar el horario de trabajo del medico.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->edit_schedule == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('edit_schedule')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>

								<tr>
									<td colspan="4" class="bg-warning text-center text-white"><strong>Recordatorios</strong></td>
								</tr>

								<tr>
									<th class="">Crear recordatorios</th>
									<td class="text-justify">El asistente puede crear recordatorios.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->reminder_create == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('reminder_create')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Editar recordatorios</th>
									<td class="text-justify">El asistente puede editar los  recordatorios ya creados.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->reminder_edit == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('reminder_edit')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Borrar recordatorios</th>
									<td class="text-justify">El asistente puede borrar recordatorios.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->reminder_delete == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('reminder_delete')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<td colspan="4" class="bg-warning text-center text-white"><strong>Notas Médicas</strong></td>
								</tr>
								<tr>
									<th class="">Crear Notas Médicas</th>
									<td class="text-justify">El asistente puede Crear Notas Médicas</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->note_create == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('note_create')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Editar Notas Médicas</th>
									<td class="text-justify">El asistente puede Editar Notas Médicas creadas con anticipacion</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->note_edit == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('note_edit')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Configurar Notas Médicas</th>
									<td class="text-justify">El asistente puede Configurar las preguntas de las notas medicas.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->note_config == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('note_config')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Borrar Notas Médicas</th>
									<td class="text-justify">El asistente puede Borrar las notas medicas.</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->note_delete == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('note_delete')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Bajar Notas Médicas o Expedientes en pdf</th>
									<td class="text-justify">El asistente puede descargar las Notas Médicas o expedientes completos en formato pdf</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->note_pdf == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('note_pdf')}}
											   <span class="slider round text-white"><span class="ml-1">on</span> of</span>
											</label>
										@endif

										</td>
								</tr>
								<tr>
									<th class="">Mover Notas Médicas</th>
									<td class="text-justify">El asistente puede mover notas médicas de un expediente a otro</td>
									<td class="text-justify">

										@if(Auth::user()->role == 'Asistente')
											@if($permissions->note_move == Null)
												<i class="fas fa-times text-secondary"></i>
											@else
												<i class="fas fa-check"></i>
											@endif
										@else
											<label class="switch disabled" style="display:block;margin-left:auto;">
											{{Form::checkbox('note_move')}}
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
						<a href="{{route('medico_assistants',\Hashids::encode($medico->id))}}" class="btn btn-secondary">Cancelar</a>
						<input type="submit" class="btn btn-success " name="" value="Guardar Cambios">
						@endassistant
                    </div>
                    {!!Form::close()!!}
				</div>
			</div>
		</div>
	</section>


@endsection
