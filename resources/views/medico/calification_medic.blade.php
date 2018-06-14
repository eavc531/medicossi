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
  <h3>Calificación Total: @include('medico.star_rate_calification') de {{$medico->votes}} voto(s)</h3>

</div>

<div class="row">
  <div class="col-12 mb-3 mt-4">
    <h5 class="text-center">Calificación Otorgada por los Pacientes</h5>

  </div>
</div>
<div class="row">
  <div class="col-8">
    <p>¿Desea mostrar Todos los comentarios entrantes de forma Predeterminada?</p>
  </div>
  <div class="col-4">
    <div class="form-inline">
      @if ($medico->show_comentary == 'Si')
        <a href="{{route('show_all_comentary_default',$medico->id)}}" class="btn btn-primary disabled" style="border:solid 3px black">Si</a>
        <a href="{{route('hide_all_comentary_default',$medico->id)}}" class="btn btn-warning ml-1">No</a>
      @else
        <a href="{{route('show_all_comentary_default',$medico->id)}}" class="btn btn-primary">Si</a>
        <a href="{{route('hide_all_comentary_default',$medico->id)}}" class="btn btn-warning ml-1 disabled" style="border:solid 3px black">No</a>
      @endif

    </div>

  </div>
</div>



<div class="row">
  <div class="col-6">
    @if($type == 'no_vistas')
      <a href="{{route('calification_medic',$medico->id)}}" class="btn btn-primary disabled">Nuevas Opiniones</a>
      <a href="{{route('calification_medic_viewed',$medico->id)}}" class="btn btn-success">Todas las Opiniones</a>
    @else

      <a href="{{route('calification_medic',$medico->id)}}" class="btn btn-primary">Nuevas Opiniones</a>
      <a href="{{route('calification_medic_viewed',$medico->id)}}" class="btn btn-success disabled">Todas las Opiniones</a>

    @endif


  </div>
  <div class="col-6 text-rigth">
    @if($type == 'no_vistas')
    <a href="{{route('mark_all_see',$medico->id)}}" class="btn btn-primary">Marcar todas como vistas</a>
    @endif
    <a href="{{route('show_all_comentary',$medico->id)}}" class="btn btn-success">Mostrar Todos los comentarios registrados hasta ahora a los usuarios</a>
    <a href="{{route('hide_all_comentary',$medico->id)}}" class="btn btn-danger">Ocultar todos los comentarios registrados hasta ahora a los usuarios</a>
  </div>
</div>
@endif

@if($rate_medic2->first() != Null)
  @foreach ($rate_medic2 as $value)
    <div class="card mt-2">
      <div class="card-header">
        {{$value->patient['name']}} {{$value->patient['lastName']}}
      </div>
      <div class="card-body">
        <div class="form-inline">
          Puntaje otorgado:
          @include('medico.star_rate')
        </div>

        @if($value->show == 'Si')
          <button onclick="this.disabled=true;show_comentary(this)" class="btn btn-success" style="border:solid 3px black" id="uno" name="{{$value->id}}" disabled>Mostrar Comentario a Visitantes y Marcar como vista</button>
          <button onclick="this.disabled=true;hide_comentary(this)" class="btn btn-danger" id="dos" name="{{$value->id}}">Ocultar Comentario a Visitantes y Marcar como vista</button>

        @else
          <button onclick="this.disabled=true;show_comentary(this)" class="btn btn-success" id="uno" name="{{$value->id}}">Mostrar Comentario a Visitantes y Marcar como vista</button>
          <button style="border:solid 3px black" onclick="this.disabled=true;hide_comentary(this)" class="btn btn-danger" id="dos" name="{{$value->id}}" disabled>Ocultar Comentario a Visitantes y Marcar como vista</button>

        @endif
        @if ($value->viewed == 'no')
          <button onclick="this.disabled=true;checked(this)" name="{{$value->id}}" class="btn btn-warning" id="tres">Marcar como vista</button>
        @endif


      </div>
      <div class="card-footer">
        {{-- @if($value->show == 'Si') --}}
          <div class="" id="comentary">
            @if(isset($value->comentary))
            <span style="">Comentario: {{$value->comentary}}</span>
            @else
              <span style="">Comentario: Sin Comentarios</span>
            @endif
          </div>
        {{-- @else
          <div class="" id="comentary">
            @if(isset($value->comentary))
            <span style="display:none">Comentario: {{$value->comentary}}</span>
            @else
              <span style="display:none">Comentario: Sin Comentarios</span>
            @endif
        @endif --}}
          {{-- </div> --}}
      </div>
    </div>
  @endforeach
@else
  <div class="text-center mt-5">
    <h3 class="text-primary"><strong>No Existen Opiniones sin comprobar</strong></h3>

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
   $(result).next('button').attr("disabled", false).next('button').hide();

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
  $(result).prev('button').attr("disabled", false).css("border", "white");

  }

  </script>

@endsection
