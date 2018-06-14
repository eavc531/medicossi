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

  @if($patients->first() != Null)
  <div class="">
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
         <a href="{{route('patient_profile',$patient['id'])}}">{{$patient['name']}}</h5></a>
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
      @if($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
      <div class="col-lg-2 col-2  col-sm-3 text-center">

          <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" data-toggle="tooltip" data-html="true" title="<em>Notas médicas</em>" class="btn btn-secondary"><i class="fas fa-notes-medical"></i></a>
      </div>
    @endif
      <div class="col-lg-2 col-2  col-sm-4 text-center">
        <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" data-toggle="tooltip" data-html="true" title="<em>Agendar cita</em>" class="btn btn-secondary"><i class="fas fa-envelope-open"></i></a>
      </div>

    </div>
    <div class="row">
      <div class="col-10 text-center mt-2">
        <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient['id']])}}" class="btn btn-primary btn-block">Agendar Cita</a>
      </div>
    </div>

    {{-- <a href="{{route('delete_patient_doctors',$patient->patients_doctor_id)}}" class="btn btn-danger" onclick="return confirm('¿Esta Segur@ de Querer Eliminar este Médico de su lista de Médicos?')">Eliminar de la lista</a> --}}
  </div>
</div>
</div>
<hr>
@endforeach
<div class="card-heading">
  {{$patients->appends(Request::all())->links()}}
</div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No ahi Historial de Pacientes con que hallas Interactuado</h4>
</div>

@endif
</div>
</div>
</section>
@endsection
