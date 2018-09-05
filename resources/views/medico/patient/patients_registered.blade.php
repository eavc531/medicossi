@extends('layouts.app')
@section('content')
<section class="box-register">
  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12 mb-3">
          <h2 class="text-center font-title">Pacientes Registrados en MédicosSi</h2>
          <hr>
        </div>
      </div>
      {{--       <div class="text-right">
        <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn btn-gray">Mis Pacientes</a>
      </div> --}}
      <div class="d-flex justify-content-end mb-5">
        <div class="form-row">
          <div class="form-group col-12 col-sm-8">
            {!!Form::open(['route'=>'search_patients_registered','method'=>'GET'])!!}
            {!!Form::hidden('medico_id',$medico->id)!!}
            {!!Form::text('search',null,['class'=>'form-control sizePaciente','placeholder'=>'nombre/cedula del paciente'])!!}
          </div>
          <div class="form-group col-12 col-sm-4 text-center pl-md-3">
            {!!Form::submit('Buscar',['class'=>'btn btn-azul'])!!}
            {!!Form::close()!!}
          </div>
        </div>
      </div>
      <div class="mb-2 text-center">
        <a href="{{route('patients_registered',\Hashids::encode($medico->id))}}" class="btn btn-azul ml-md-2">Mostrar Todos</a>
        @if(\Request::is('patients_registered'))
        <a href="{{route('patients_registered',\Hashids::encode($medico->id))}}" class="btn btn-green ml-md-2 mt-2 mt-sm-0 disabled">Buscar Paciente Registrado</a>
        @endif
        <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn btn-green ml-md-2 mt-2 mt-sm-0">Mis Pacientes</a>
        <a href="{{route('medico_register_new_patient',\Hashids::encode($medico->id))}}" class="btn btn-azul ml-md-2 mt-2 mt-sm-0">Registrar nuevo Paciente</a>
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
              <a class="textGray anclaNone text-capitalize" href="{{route('patient_profile',$patient['id'])}}">
                {{$patient['name']}} {{$patient['lastName']}}
              </a>
              </h5>
              <div class="form-inline">
                <label class="m-0" for="" class="textGray">Cédula: &nbsp;</label>
                <span class="">{{$patient['identification']}}</span>
              </div>
              <div class="row align-self-end">
                <div class="col-12">
                  <label class="text-azul font-italic my-1">{{$patient['state']}}, {{$patient['city']}}</label>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 p-2">
              <div class="form-group">
                {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
              </div>
              <div class="row">
                <div class="col-12 col-sm-10 mt-2">
                  {!!Form::open(['route'=>'add_patient_registered','method'=>'POST'])!!}
                  <input type="hidden" name="medico_id" value="{{$medico->id}}">
                  <input type="hidden" name="patient_id" value="{{$patient['id']}}">
                  <button type="submit" name="button" class="btn btn-azul btn-block">Agregar Paciente</button>
                  {!!Form::close()!!}
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
      @if(isset(request()->search))
      <div class="card-body">
        <h4 class="text-green">No se encontraron resultados para la Busqueda: {{request()->search}}</h4>
      </div>
      @else
      <div class="card-body">
        <h4 class="text-green">Sin registros que mostrar</h4>
      </div>
      @endif
    </div>
    @endif
  </div>
</div>
</section>
@endsection
<script type="text/javascript">
/////////////////////////////
$('#state').on('change', function() {
state = $('#state').val();
route = "{{route('inner_cities_select3')}}";
$.ajax({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
type:'post',
url: route,
data:{name:state},
success:function(result){
console.log(result);
$("#city").empty();
$('#city').append($('<option>', {
value: null,
text: 'opciones'
}));
$.each(result,function(key, val){
$('#city').append($('<option>', {
  value: val,
  text: val
  }));
  });
  },
  error:function(error){
  console.log(error);
  },
  });
  })
  </script>