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

      <div class="d-flex justify-content-end mb-5">
        <div class="form-row">
          <div class="form-group col-12 col-sm-8">
            {!!Form::open(['route'=>'search_patients','method'=>'GET'])!!}
            {!!Form::hidden('medico_id',$medico->id)!!}
            {!!Form::text('search',null,['class'=>'form-control sizePaciente','placeholder'=>'nombre / cédula del paciente'])!!}
          </div>
          <div class="form-group col-12 col-sm-4 text-center pl-md-3">
            {!!Form::submit('Buscar',['class'=>'btn btn-azul'])!!}
            {!!Form::close()!!}
          </div>
        </div>
      </div>

      <div class="mb-2 text-center">
        <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn btn-azul ml-md-2">Mostrar Todos</a>
        <a href="{{route('patients_registered',\Hashids::encode($medico->id))}}" class="btn btn-green mt-2 mt-sm-0 ml-md-2">Buscar Paciente Registrado</a>
        <a href="{{route('medico_register_new_patient',\Hashids::encode($medico->id))}}" class="btn btn-azul mt-2 mt-sm-0 ml-md-2">Registrar Nuevo Paciente</a>
      </div>

      @if($patients->first() != Null)
      <div class="card">
        <div class="card-body">
          @foreach ($patients as $patient)
          <div class="row">
            <div class="col-12 col-sm-3 ">
              <div class="cont-img">
                @isset($patient['image'])
                <img src="{{asset($patient['image'])}}" class="prof-img2 img-thumbnail" alt="avatar" >
                @else
                <img src="{{asset('img/profile.png')}}" class="prof-img2 img-thumbnail" alt="avatar">
                @endisset
              </div>
            </div>
            <div class="col-12 col-sm-5 py-2">
              <h5 class="text-center text-sm-left">
                <a class="textGray anclaNone text-capitalize" href="{{route('patient_profile',\Hashids::encode($patient['id']))}}">{{$patient['name']}} {{$patient['lastName']}}
                </a>
              </h5>
              <div class="form-inline">
                <label class="m-0" for="" class="textGray">Cédula: &nbsp;</label>
                <span class="">{{$patient['identification']}}</span>
              </div>
              <div class="row align-self-end">
                <div class="col-12">
                  <label class="text-azul font-italic my-1">{{$patient['state']}},{{$patient['city']}}</label>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-4 p-2">
              <div class="form-group">
                {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
              </div>
              <div class="row">

                <div class="col-12 col-sm-10 text-center">
                  <div class="btn-group" role="group" aria-label="Buttons">
                     <a class="btn btn-azul" href="{{route('manage_patient',['medico_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient['id'])])}}" data-toggle="tooltip" data-html="true" title="Panel Paciente"><i class="fas fa-tasks"></i>
                     </a>
                    <a class="btn btn-green" href="{{route('patient_profile',['p_id'=>\Hashids::encode($patient['id']),'back'=>\Hashids::encode($medico->id)])}}" data-toggle="tooltip" data-html="true" title="Perfil"><i class="fas fa-user"></i>
                    </a>
                  </div>
                </div>
                {{-- <div class="col-lg-2 col-2  col-sm-3 text-center">
                  <a class="btn btn-secondary" href="{{route('medico_appointments_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" data-toggle="tooltip" data-html="true" title="<em>citas con paciente</em>"><i class="far fa-calendar-alt"><span style="font-size:11"></span></i></a>
                </div> --}}

              </div>
              <div class="row">
                <div class="col-12 col-sm-10 mt-2">
                  @cita_create
                  <a href="{{route('medico_stipulate_appointment',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-azul btn-block">Agendar Cita</a>
                  @else
                  <a href="{{route('medico_stipulate_appointment',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-azul btn-block disabled" disabled>Agendar Cita</a>
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
        <h4 class="text-green">Sin registros que mostrar</h4>
      </div>
    </div>
    @endif
  </div>
</div>
</section>
@endsection
