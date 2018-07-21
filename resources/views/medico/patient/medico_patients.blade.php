@extends('layouts.app')

@section('content')


<section class="box-register">

  <div class="container">

   <div class="register">
    <div class="row">
     <div class="col-12 mb-3">
      <h2 class="text-center font-title">Mis Pacientes</h2>
      <hr>
    </div>
  </div>

    <div class="form-inline mb-5">
      {!!Form::open(['route'=>'search_patients','method'=>'GET'])!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      {!!Form::text('search',null,['class'=>'form-control','placeholder'=>'nombre/cedula del paciente'])!!}
      {!!Form::submit('Buscar',['class'=>'btn btn-success'])!!}
      {!!Form::close()!!}
        </div>
    <div class="mb-2">
      <a href="{{route('medico_patients',$medico->id)}}" class="btn btn-primary ml-2">Mostrar Todos</a>
      <a href="{{route('patients_registered',$medico->id)}}" class="btn btn-warning ml-2">Buscar Paciente Registrado</a>
      <a href="{{route('medico_register_new_patient',$medico->id)}}" class="btn btn-info ml-2">Registrar nuevo Paciente</a>

    </div>

  @if($patients->first() != Null)
  <div class="card">
    <div class="card-body">
    @foreach ($patients as $patient)

    <div class="row">
     <div class="col-8 m-auto col-sm-3 col-lg-3">
       <div class="cont-img">
         @isset($patient['image'])
         <img src="{{asset($patient['image'])}}" class="prof-img2 img-thumbnail" alt="..." >
         @else
         <img src="{{asset('img/profile.png')}}" class="prof-img2 img-thumbnail" alt="...">
         @endisset
       </div>
     </div>
     <div class="col-12 col-sm-5 col-lg-5">
      <div class="card-body p-2">
       <h5 class="card-title font-title">
         <a href="{{route('patient_profile',$patient['id'])}}">{{$patient['name']}} {{$patient['lastName']}}</h5></a>
       <div class="form-inline">
         <label for="" class="font-title-grey">Cédula:</label> <span class="">{{$patient['identification']}}</span>
       </div>
       {{-- <span>Especialidad:</span> <a href="#" class="outstanding mr-2"> {{$patient['specialty']}}</a> --}}
       <div class="row align-self-end">
         <div class="col-12">
           <label class="font-title-blue my-1">{{$patient['state']}},{{$patient['city']}}</label>
         </div>
       </div>
     </div>
   </div>
   <div class="col-12 col-sm-4 col-lg-4 p-2">
     <div class="form-group">
       {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
     </div>
     <div class="row">
      <div class="col-lg-2 col-2  col-sm-3 text-center">
        <a class="btn btn-secondary" href="{{route('patient_profile',$patient['id'])}}" data-toggle="tooltip" data-html="true" title="<em>Perfil</em>"><i class="fas fa-user"></i></a>
      </div>
      <div class="col-lg-2 col-2  col-sm-3 text-center">
        <a class="btn btn-secondary" href="{{route('medico_appointments_patient',['medico_id'=>$medico->id,'patient_id'=>$patient['id']])}}" data-toggle="tooltip" data-html="true" title="<em>Lista de citas con paciente</em>"><i class="fas fa-bars"></i></a>
      </div>
      @plan_platino
        <div class="col-lg-2 col-2  col-sm-4 text-center">
          <a href="{{route('expedients_patient',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" data-toggle="tooltip" data-html="true" title="<em>Expedientes</em>" class="btn btn-secondary"><i class="fas fa-folder"></i></a>
        </div>
      <div class="col-lg-2 col-2  col-sm-3 text-center">
        <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" data-toggle="tooltip" data-html="true" title="<em>Notas médicas</em>" class="btn btn-secondary"><i class="fas fa-notes-medical"></i></a>
      </div>
  @else

      <div class="col-lg-2 col-2  col-sm-4 text-center">
        <a href="{{route('expedients_patient',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" data-toggle="tooltip" data-html="true" title="<em>Expedientes</em>" class="btn btn-secondary disabled text-secondary"><i class="fas fa-folder"></i></a>
      </div>
    <div class="col-lg-2 col-2  col-sm-3 text-center">
      <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" data-toggle="tooltip" data-html="true" title="<em>Notas médicas</em>" class="btn btn-secondary disabled text-secondary"><i class="fas fa-notes-medical"></i></a>
    </div>
    @endplan_platino


    </div>
    <div class="row">
      <div class="col-10 text-center mt-2">
          @cita_create
        <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" class="btn btn-primary btn-block">Agendar Cita</a>
    @else
        <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" class="btn btn-primary btn-block disabled" disabled>Agendar Cita</a>
        @endcita_create
      </div>
    </div>

    {{-- <a href="{{route('delete_patient_doctors',$patient->patients_doctor_id)}}" class="btn btn-danger" onclick="return confirm('¿Esta Segur@ de Querer Eliminar este Médico de su lista de Médicos?')">Eliminar de la lista</a> --}}
  </div>
</div>
<hr>
@endforeach


</div>
</div>
<div class="card-heading">
  {{$patients->appends(Request::all())->links()}}
</div>
</div>
@else
  <div class="text-center card mt-2">
    <div class="card-body">

      <h4 class="text-primary">Sin registros que mostrar</h4>
    </div>
  </div>

@endif
</div>
</div>
</section>
@endsection
