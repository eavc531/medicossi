@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Gestionar Datos Paciente: {{$patient->name}} {{$patient->lastName}} </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
@include('medico.includes.main_medico_patients')

<div class="mt-4 row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Datos Personales:
            </div>
            <div class="card-body row">
                <div class="col-6">
                    <ul>
                        <li><b>Nombres</b>:{{$data_patient->name}}</li>
                        <li><b>Apellidos</b>:{{$data_patient->lastName}}</li>
                        <li><b>Cedula</b>:{{$data_patient->identification}}</li>
                        <li><b>Sexo</b>:{{$data_patient->gender}}</li>
                        <li><b>Telefono 1:</b>{{$data_patient->phone1}}</li>
                        <li><b>Telefono 2:</b>@isset($data_patient->phone2){{$data_patient->phone2}}@else <span class="text-secondary">No especifica @endisset</span></li>
                        <li><b>Fecha de Nacimiento:</b>@isset($data_patient->birthdate) {{\Carbon\Carbon::parse($data_patient->birthdate)->format('m-d-Y')}}@else <span class="text-secondary">No especifica @endisset</li>
                        <li><b>Edad:</b>{{$data_patient->age}}</li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul>
                      <li><strong>Pais:</strong> @isset($data_patient->country){{$data_patient->country}}@else <span class="text-secondary">No especifica @endisset</li>
                      <li><strong>Estado:</strong> @isset($data_patient->state){{$data_patient->state}}@else <span class="text-secondary">No especifica @endisset</li>
                      <li><strong>Ciudad:</strong> @isset($data_patient->city){{$data_patient->city}}@else <span class="text-secondary">No especifica @endisset</li>
                      <li><strong>Codigo Postal:</strong> @isset($data_patient->postal_code){{$data_patient->postal_code}}@else <span class="text-secondary">No especifica @endisset</li>
                          <li><strong>Colonia:</strong>
                            @isset($data_patient->colony){{$data_patient->colony}}@else <span class="text-secondary">No especifica @endisset
                          </li>
                          <li><strong>Calle/av:</strong>@isset($data_patient->street){{$data_patient->street}}@else <span class="text-secondary">No especifica @endisset</li>
                          <li><strong>Numero Externo:</strong> @isset($data_patient->number_ext){{$data_patient->number_ext}}@else <span class="text-secondary">No especifica @endisset</li>
                          <li><strong>Numero Interno:</strong> @isset($data_patient->number_int){{$data_patient->number_int}}@else <span class="text-secondary">No especifica @endisset</li>
                    </ul>
                </div>
                <a class="btn btn-success ml-auto mr-3" href="{{route('data_patient',['m_id'=>Hashids::encode($medico->id),'p_id'=>Hashids::encode($patient->id)])}}">Editar datos de paciente</a>
            </div>
        </div>
    </div>

    <div class="col-6 mt-3">

        <div class="card">
            <div class="card-header">
                <strong>Citas</strong>
            </div>
            <div class="card-body">
                <li>totales: {{$appointments_all}}</li>
                <li>Sin Confirmar: {{$appointments_no_confirmed}}</li>
                <li>Confirmada: {{$appointments_confirmed}}</li>
                <li>Pagadas y pendientes: {{$appointments_paid}}</li>
                <li>Pasadas y por Cobrar: {{$appointments_past}}</li>
                <li>Canceladas/Rechazadas: {{$appointments_cancel}}</li>
                <li>Completadas: {{$appointments_completed}}</li>

            </div>
        </div>
    </div>

    <div class="col-6 mt-3">
        <div class="card">
            <div class="card-header">
                <strong>Documentos:</strong>
            </div>
            <div class="card-body">
                <li>Notas: {{$note_count}}</li>
                <li>Expedientes: {{$exp_count}}</li>
                <li>Archivos/imagenes: {{$files_count}} </li>

            </div>
        </div>
    </div>
</div>
@endsection
