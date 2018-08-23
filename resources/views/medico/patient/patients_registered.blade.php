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
  <div class="text-right">
    <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn btn-secondary">Mis Pacientes</a>

  </div>
    <div class="form-inline mb-5">

      {!!Form::open(['route'=>'search_patients_registered','method'=>'GET'])!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      {!!Form::text('search',null,['class'=>'form-control','placeholder'=>'nombre/cedula del paciente'])!!}
      {!!Form::submit('Buscar',['class'=>'btn btn-success'])!!}
      {!!Form::close()!!}

      </div>

    <div class="mb-2">
      <a href="{{route('patients_registered',\Hashids::encode($medico->id))}}" class="btn btn-primary ml-2">Mostrar Todos</a>
      <a href="{{route('patients_registered',\Hashids::encode($medico->id))}}" class="btn btn-warning ml-2 disabled">Buscar Paciente Registrado</a>
      <a href="{{route('medico_register_new_patient',\Hashids::encode($medico->id))}}" class="btn btn-info ml-2">Registrar nuevo Paciente</a>
    </div>
<hr>
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
      <div class="col-10 text-center mt-2">
        {!!Form::open(['route'=>'add_patient_registered','method'=>'POST'])!!}
          <input type="hidden" name="medico_id" value="{{$medico->id}}">
          <input type="hidden" name="patient_id" value="{{$patient['id']}}">
          <button type="submit" name="button" class="btn btn-primary btn-block">Agregar Paciente</button>
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

      <h4 class="text-primary">No se encontraron resultados para la Busqueda: {{request()->search}}</h4>
    </div>
  @else
    <div class="card-body">

      <h4 class="text-primary">Sin registros que mostrar</h4>
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
