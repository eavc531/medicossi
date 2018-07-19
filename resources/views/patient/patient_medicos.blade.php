@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('rateyo/jquery.rateyo.css')}}">

@endsection
@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
     <div class="col-12">

      <h2 class="text-center font-title">Mis Médicos @if(isset($pending)){{$pending}}@elseif(isset($unrated)){{$unrated}}@endif</h2>
    </div>
  </div>
  @if($medicos->first() != Null)
  <div class="">
    @foreach ($medicos as $medico)
    <div class="card mt-2 card-style">
      <div class="row">
       <div class="col-8 m-auto col-sm-3 col-lg-3">
         <div class="cont-img">
           @isset($medico['image'])
           <img src="{{asset($medico['image'])}}" class="prof-img2 img-thumbnail" alt="..." >
           @else
           <img src="{{asset('img/profile.png')}}" class="prof-img2 img-thumbnail" alt="...">
           @endisset
         </div>
       </div>
       <div class="col-12 col-sm-5 col-lg-5">
        <div class="card-body p-2">
         <h5 class="card-title title-edit">{{$medico['name']}} {{$medico['lastName']}}</h5>
         <p>Cédula: {{$medico['identification']}}</p>
         <span>Especialidad:</span> <a href="#" class="outstanding mr-2"> {{$medico['specialty']}}</a>
         <div class="star-profile">

          <div class="form-inline">
            Calificación:
            <span class="ml-2 mr-2">@include('patient.star_rate_2')</span>
              @if($medico['calification'] != Null)
               <span> de "{{$medico['votes']}}" voto(s).</span>
             @else
               (Aun sin Calificar)
             @endif
          </div>

         </div>
         <div class="row align-self-end">
           <div class="col-12">
             <p class="card-text"><b>{{$medico['state']}},{{$medico['city']}}</b></p>
           </div>
         </div>
       </div>
     </div>
     <div class="col-12 col-sm-4 col-lg-4 p-2 align-self-center text-center">

         {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
         <a class="btn btn-secondary mr-2" href="{{route('medico.edit',$medico['id'])}}" data-toggle="tooltip" data-html="true" title="<em>Ver Perfil</em>"><i class="fas fa-sign-in-alt"></i></a>
         @if($medico['plan'] != 'plan_profesional' and $medico['plan'] != 'plan_platino')
           <a class="btn mr-2" href="{{route('stipulate_appointment',$medico['id'])}}" class="btn" data-toggle="tooltip" data-html="true" title="<em>Agendar cita</em>" style="color:white;background:rgb(168, 168, 168)"><i class="fas fa-notes-medical mr-0"></i></a>
         @else
           @if(Auth::check() and Auth::user()->role == 'Paciente')

           <a class="btn btn-primary mr-2" href="{{route('stipulate_appointment',$medico['id'])}}" class="btn" data-toggle="tooltip" data-html="true" title="<em>Agendar cita</em>"><i class="fas fa-notes-medical mr-0"></i></a>

           @else
           <button onclick="return verifySession()" class="btn btn-primary mr-2"  data-toggle="tooltip" data-html="true" title="<em>Agendar cita</em>"><i class="fas fa-notes-medical mr-0"></i></button>
           @endif
         @endif

         <a href="{{route('delete_patient_doctors',$medico['patients_doctor_id'])}}" class="btn btn-danger mr-2" onclick="return confirm('¿Esta Segur@ de Querer Eliminar este Médico de su lista de Médicos?')" data-toggle="tooltip" data-html="true" title="<em>Eliminar</em>"><i class="fas fa-trash mr-0"></i></a>
       {{-- <a class="btn btn-warning" href="{{route('calification_medic',$medico['id'])}}" data-toggle="tooltip" data-html="true" title="<em>Calificación</em>"><i class="fas fa-star"></i></a> --}}

<!--        <div class="form-group">

       </div>
       <div class="form-group">

         {{-- <a href="" class="btn-icon"><i class="fa fa-phone mr-0"></i>Ver Telefono</a> --}}
       </div> -->
     </div>
   </div>
 </div>
 @endforeach
 <div class="card-heading">
  {{$medicos->appends(Request::all())->links()}}
</div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No ahi Historial de Médicos con que hallas Interactuado</h4>
</div>

@endif
</div>
</div>
</section>
@endsection
@section('scriptJS')
<script src="{{asset('rateyo/jquery.rateyo.js')}}" type="text/javascript">

</script>
<script type="text/javascript">
  $(function () {

    $(".rateYo").rateYo({
      starWidth: "20px",
      rating: 3.2,

    });
  });
</script>
@endsection
