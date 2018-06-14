@extends('layouts.app')

@section('content')
  <section class="box-register">

		<div class="container">

			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Mis Pacientes @if(isset($pending)){{$pending}}@elseif(isset($unrated)){{$unrated}}@endif</h2>
						<hr>
					</div>
				</div>
        @if($patients->first() != Null)
        <div class="">
          @foreach ($patients as $patient)
            <hr>
            <div class="row">

             <div class="col-8 m-auto col-sm-3 col-lg-3">
               <div class="cont-img">
                 @isset($patient['image'])
                 <img src="{{asset($patient['image'])}}" class="prof-img img-thumbnail" alt="..." >
                 @else
                 <img src="{{asset('img/profile.png')}}" class="prof-img img-thumbnail" alt="...">
                 @endisset
               </div>
             </div>
             <div class="col-12 col-sm-5 col-lg-5">
              <div class="card-body p-2">
               <h5 class="card-title title-edit">{{$patient['name']}}</h5>
               <p>Cédula: {{$patient['identification']}}</p>
               {{-- <span>Especialidad:</span> <a href="#" class="outstanding mr-2"> {{$patient['specialty']}}</a> --}}

               <div class="row mt-3 align-self-end">
                 <div class="col-12">
                   <p class="card-text"><b>{{$patient['state']}},{{$patient['city']}}</b></p>
                 </div>
                 <div class="col-12">
                  <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient])}}" class="btn btn-success">Agendar Cita</a>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-12 col-sm-4 col-lg-4 p-4">
             <div class="form-group">
               {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
               <a class="" href="{{route('patient_profile',$patient['id'])}}"><i class="fas fa-cogs mr-2"></i>Ver perfíl</a>
             </div>
                <a class="btn btn-secondary" href="{{route('medico_appointments_patient',['medico_id'=>$medico->id,'patient_id'=>$patient['id']])}}">Lista de Citas con Paciente</a>
                <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary btn-lg">Notas Médicas</i></a>
                <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient])}}" class="btn btn-secondary btn-lg">agendar cita</a>
                <a href="{{route('admin_data_patient',['medico_id'=>$medico->id,'patient_id'=>$patient->id])}}" class="btn btn-secondary">Administrar Paciente</a>
             <div class="form-group">

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
