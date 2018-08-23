@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Calificación Médico: {{$medico->name}} {{$medico->lastName}}</h2>
  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}
@if($rate_medic1->first() != Null)
  <div class="card">
    <div class="card-body">
      <h3>Calificación Total: @include('medico.star_rate_calification') de {{$medico->votes}} voto(s)</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mb-3 mt-4">
      {{-- <h5 class="text-center">Calificación Otorgada por los Pacientes</h5> --}}
    </div>
  </div>
@if($type == 'no_vistas')
  <div class="row">
    <div class="col-8">
      <p>¿Desea mostrar Todos los comentarios entrantes al los usuarios de forma Predeterminada?</p>
    </div>
    <div class="col-4">
      <div class="form-inline">
        @if ($medico->show_comentary == 'Si')
          <a href="{{route('show_all_comentary_default',\Hashids::encode($medico->id))}}" class="btn btn-primary disabled" style="border:solid 3px black">Si</a>
          <a href="{{route('hide_all_comentary_default',\Hashids::encode($medico->id))}}" class="btn btn-warning ml-1">No</a>
        @else
          <a href="{{route('show_all_comentary_default',\Hashids::encode($medico->id))}}" class="btn btn-primary">Si</a>
          <a href="{{route('hide_all_comentary_default',\Hashids::encode($medico->id))}}" class="btn btn-warning ml-1 disabled" style="border:solid 3px black">No</a>
        @endif
      </div>
    </div>
  </div>
@else
  <div class="row">
    <div class="col-8">
      <p>¿Desea mostrar Todos los comentarios registrados hasta la fecha?</p>
    </div>
    <div class="col-4">
      <div class="form-inline">

        {{-- @if ($medico->show_comentary == 'Si') --}}
          <a href="{{route('show_all_comentary',\Hashids::encode($medico->id))}}" class="btn btn-primary">Si</a>
          <a href="{{route('hide_all_comentary',\Hashids::encode($medico->id))}}" class="btn btn-warning ml-1">No</a>
        {{-- @else
          <a href="{{route('show_all_comentary',\Hashids::encode($medico->id))}}" class="btn btn-primary">Si</a>
          <a href="{{route('hide_all_comentary',\Hashids::encode($medico->id))}}" class="btn btn-warning ml-1 disabled" style="border:solid 3px black">No</a>
        @endif --}}
      </div>
    </div>
  </div>
@endif

@if($type == 'no_vistas')
  @if($rate_medic2->first())
      <div class="row mt-4">
      <div class="col-8">
        <p>Marcar todos las nuevas opiniones como vistas:</p>
      </div>
      <div class="col-4">
        <a href="{{route('mark_all_see',\Hashids::encode($medico->id))}}" class="btn btn-primary"><i class="fas fa-check"></i></a>
      </div>
    </div>
  @endif
@endif

@if($type == 'no_vistas')
  @if($rate_medic2->first())
    <div class="row mt-4">
      <div class="col-8">
        <p>¿Permitir ver todos los comentarios nuevos y marcar como vistos?</p>
      </div>
      <div class="col-4">
        <div class="form-inline">

        </div>
        <a href="{{route('show_all_comentary_new',\Hashids::encode($medico->id))}}" class="btn btn-success"><i class="fas fa-eye"></i>  <i class="fas fa-check"></i>
        </a>
        {{-- <a href="{{route('hide_all_comentary_new',\Hashids::encode($medico->id))}}" class="btn btn-danger"><i class="fas fa-eye-slash"></i>
        </a> --}}
      </div>
    </div>
  @endif
@endif
<div class="row">
  <div class="col-6">
    @if($type == 'no_vistas')
      <a href="{{route('calification_medic',\Hashids::encode($medico->id))}}" class="btn btn-primary disabled">Nuevas Opiniones</a>
      <a href="{{route('calification_medic_viewed',\Hashids::encode($medico->id))}}" class="btn btn-success">Todas las Opiniones</a>
    @else
      <a href="{{route('calification_medic',\Hashids::encode($medico->id))}}" class="btn btn-primary">Nuevas Opiniones</a>
      <a href="{{route('calification_medic_viewed',\Hashids::encode($medico->id))}}" class="btn btn-success disabled">Todas las Opiniones</a>
    @endif
  </div>
</div>
@if($type == 'no_vistas')
  <div class="">
    <hr>
    <h4 class="text-center">Nuevas opiniones</h4 class="text-center">
    <hr>
  </div>
@else
  <div class="">
    <hr>
    <h4 class="text-center">Todas las opiniones</h4 class="text-center">
    <hr>
  </div>
@endif

@endif

@if($rate_medic2->first() != Null)
  @foreach ($rate_medic2 as $value)
    <div class="card mt-3">
      <div class="card-header">
        {{$value->patient['name']}} {{$value->patient['lastName']}}
      </div>
      <div class="card-body">
        <div class="form-inline">
          Puntaje otorgado:
          @include('medico.star_rate')
        </div>
        <div class="" id="comentary">
          @if(isset($value->comentary))

          <span style="">Comentario: {{$value->comentary}}</span>
          @else
            <span style="">Comentario: Sin Comentarios</span>
          @endif
        </div>
          </div>

      </div>
      <div class="card-footer">
        @if($value->show == 'Si')
          <div class="row">
            <div class="col-8">
              {{-- @if ($value->viewed == 'Si')
                ¿Mostrar Comentario?
              @else
                ¿Mostrar Comentario y marcar como visto?
              @endif --}}
            </div>
            <div class="col-4">
              <button onclick="this.disabled=true;show_comentary(this)" class="btn btn-success" style="border:solid 3px black" id="uno" name="{{$value->id}}" disabled><i class="fas fa-eye"></i></button>
              <button onclick="this.disabled=true;hide_comentary(this)" class="btn btn-danger" id="dos" name="{{$value->id}}"><i class="fas fa-eye-slash"></i></button>
              {{-- @if ($value->viewed == 'no')
                <button onclick="this.disabled=true;checked(this)" name="{{$value->id}}" class="btn btn-warning" id="tres"><i class="fas fa-check"></i></button>
              @endif --}}
            </div>
          </div>
        @else
          <div class="row">
            <div class="col-8">
              @if ($value->viewed == 'Si')
                ¿Mostrar Comentario?
              @else
                ¿Mostrar Comentario y marcar como visto?
              @endif
            </div>
            <div class="col-4">

              <button onclick="this.disabled=true;show_comentary(this)" class="btn btn-success" id="uno" name="{{$value->id}}"><i class="fas fa-ey"></i></button>
              <button style="border:solid 3px black" onclick="this.disabled=true;hide_comentary(this)" class="btn btn-danger" id="dos" name="{{$value->id}}" disabled><i class="fas fa-eye-slash"></i></button>
              @if ($value->viewed == 'no')
                <button onclick="this.disabled=true;checked(this)" name="{{$value->id}}" class="btn btn-warning" id="tres"><i class="fas fa-check"></i></button>
              @endif
            </div>
          </div>
        @endif
    </div>
  @endforeach
@else
  <div class="text-center mt-5">
    <div class="card p-4">
      <h3 class="text-primary"><strong>No ahi registro de opiniones para este panel</strong></h3>
    </div>
  </div>
@endif
{{-- <input type="button" name="btnPaciente"  id="idetest"
value="NombrePaciente" /> --}}
@endsection

@section('scriptJS')
  <script type="text/javascript">

  function checked(result){
    rate_id = result.name;
    route = "{{route('checked_comentary')}}";

    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: route,
      data:{rate_id},
      // Mostramos un mensaje con la respuesta de PHP
      success:function(result){
        console.log(result);
      },
      error:function(error){
       console.log(error);
     },

  });
  }


  function show_comentary(result){
    rate_id = result.name;

    route = "{{route('show_comentary')}}";

    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: route,
      data:{rate_id},
      // Mostramos un mensaje con la respuesta de PHP
      success:function(result){
        console.log(result);
      },
      error:function(error){
       console.log(error);
     },

  });
  $(result).css("border", "solid 3px black");
  $(result).next('button').attr("disabled", false).css("border", "white");
   $(result).next('button').attr("disabled", false).next('button').attr("disabled", true);

  }

  function hide_comentary(result){
    rate_id = result.name;
    route = "{{route('hide_comentary')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: route,
      data:{rate_id},
      // Mostramos un mensaje con la respuesta de PHP
      success:function(result){
        console.log(result);
      },
      error:function(error){
       console.log(error);
     },
  });
  $(result).css("border", "solid 3px black");
  $(result).prev('button').attr("disabled", false).css("border","white");
  $(result).next('button').attr("disabled", true);
  }

  </script>

@endsection
