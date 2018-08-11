@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('rateyo/jquery.rateyo.css')}}">

@endsection
@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row mb-5">
     <div class="col-12">

      <h2 class="text-center font-title">Mis Médicos @if(isset($pending)){{$pending}}@elseif(isset($unrated)){{$unrated}}@endif</h2>
    </div>
  </div>
  @if($medicos->first() != Null)
  <div class="">
      @foreach ($medicos as $medico )
        {{-- <input type="hidden" name="" value="{!!$position = $position + 1!!}"> --}}
     <div class="card">
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
             <span class="ml-2 mr-2">@include('home.star_rate')</span>
                      @if($medico['calification'] != Null)
                         <span> de "{{$medico['votes']}}" voto(s).</span>
                     @endif
           </div>
           {{-- <button onclick="show_calification(this)" type="button" name="{{$medico['id']}}">test</button>
           <a href"{{route('list_calification_medico',['medico_id'=>$medico['id']])}}">Opiniones de los usuarios</a> --}}
         </div>
         <div class="row mt-3 align-self-end">
           {{-- <div class="col-12">
             <a href="{{route('detail_medic_map',$medico['id'])}}" class="btn btn-primary btn-sm text-white"><p class="card-text">({{$position}}) - <i class="fas fa-map-marker-alt mr-1"></i><b>{{$medico['state']}},{{$medico['city']}}</b></p></a>
           </div> --}}
         </div>
       </div>
     </div>
     <div class="col-12 col-sm-4 col-lg-4 p-4">
       <div class="form-group">
         {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
         {{-- {{Route::currentRouteName()}} --}}

         <a class="btn btn-primary" href="{{route('medico.edit',[$medico['id'],'back'=>Request::fullUrl()])}}"><i class="fas fa-cogs mr-2"></i>Ver perfíl</a>
       </div>
       <div class="form-group">
       @if ($medico['plan'] != 'plan_profesional' and $medico['plan'] != 'plan_platino')

         <a href="{{route('stipulate_appointment',['id'=>$medico['id'],'back'=>Request::fullUrl()])}}" class="btn" style="background:rgb(151, 156, 159);color:white"><i class="fa fa-envelope-open mr-2" ></i> cita</a>
       @else
         @if(Auth::check() and Auth::user()->role == 'Paciente')
         <a href="{{route('stipulate_appointment',['id'=>$medico['id'],'back'=>Request::fullUrl()])}}" class="btn btn-info"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</a>
         @else
         <button onclick="return verifySession()" class="btn"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</button>
         @endif
       @endif
       </div>
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
