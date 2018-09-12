@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center font-title"><span> Calificación: {{$medico->nameComplete}}</span></h2>
      </div>
    </div>

    <div class="mt-5">
        @if(request()->get('back') != Null)
            <div class="float-right mb-2">
                <a href="{{route(request()->get('back'),Hashids::encode($medico->id))}}"  class="btn btn-secondary">Volver</a>

            </div>
        @endif

        @rol_edit
    @isset($views)
        <a href="{{route('calification_medic',Hashids::encode($medico->id))}}" class="btn btn-primary">Nuevas Calificaciónes</a>
        <a href="{{route('calification_medic_viewed',Hashids::encode($medico->id))}}" class="btn btn-success disabled">Calificaciónes verificadas</a>
    @else
        <a href="{{route('calification_medic',Hashids::encode($medico->id))}}" class="btn btn-primary disabled">Nuevas Calificaciónes</a>
        <a href="{{route('calification_medic_viewed',Hashids::encode($medico->id))}}" class="btn btn-success">Calificaciónes verificadas</a>
    @endisset

    @endrol_edit

    @if($medico->calification != Null)
        <div class="card mt-2" style="max-width:300px">
            <div class="card-body">
                <strong>Calificación General:</strong>
                <h4 class="mt-2">@include('medico.calification.star_rate') de: {{$medico->votes}} Voto(s)</h4>

            </div>
        </div>
    @endif


    </div>

    <div class="text-center my-5">
        @rol_edit
            @isset($views)
                <h4 class="text-primary">Calificaciónes Vistas</h4>

            @else
                <h4 class="text-warning">Calificaciónes sin comprobar</h4>
                <div class="my-4 card p-2">
                    @if($rate_medic->first() != Null)
                    <p class="text-left text-success">Mostrar todos los comentarios nuevos a los usuarios y marcar como vistos <a href="{{route('check_all_view',Hashids::encode($medico->id))}}" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a></p>
                    <p class="text-left text-primary">Marcar todas las calificaciones nuevas como vistas <a href="{{route('check_all_view_show',Hashids::encode($medico->id))}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> <i class="fas fa-check"></i></a>
                    </p>
                    @endif
                </div>
            @endisset
        @else
            <h4 class="text-primary">Opiniones de los usuarios</h4>
        @endrol_edit

    </div>
    <div class="mt-5">
        @if($rate_medic->first() != Null)
        @foreach ($rate_medic as $value)

            <div class="card mt-4">
                <div class="card-header">

                        <div class="form-inline">
                            <h5>Calificación otorgada por Paciente <span class="text-primary">{{$value->patient->nameComplete}}:</span></h5>
                            <div class="ml-2" style="font-size:18px">
                                @include('medico.star_rate')
                            </div>

                            @if($value->renews == 'si') <span class="text-warning ml-2">(Actualizada)</span> @endif
                        </div>
                            @rol_edit
                        @if(!isset($views))
                            <div class="form-inline justify-content-end my-2 este3" id="este3">
                                <span class="text-info"><strong>¿Calificación Vista?</strong></span>
                                <button onclick="check_view(this)" type="button" name="button" class="btn btn-primary ml-3" id="{{$value->id}}"><i class="fas fa-check"></i></button>
                            </div>
                        @endif





                        <div class="text-right mt-2 este2" id="este2">
                            <div class="form-inline float-right este" id="este">
                                <span class="text-success"><strong>¿Mostrar Detalles a los Visitantes?</strong></span>
                                <label class="switch text-center ml-2 id_label" style="display:block;margin-left:auto;">
                                   {{Form::checkbox('show','si',$value->show,['onclick'=>'show(this)','id'=>$value->id])}}
                                   <span class="slider round text-white"><span class="ml-1">SI </span> NO</span>
                                </label>
                            </div>

                        </div>
                        @endrol_edit



                </div>
                    @if($value->show == 'si')
                <div class="card-body">
                    <div class="form-inline float-right este" id="este">
                        <span class="text-info">Ver detalles</span>
                        <label class="switch text-center ml-2 id_label" style="" id="id_label">
                           {{Form::checkbox('name', 'value', false,['onclick'=>'toogle(this)','id'=>''])}}
                           <span class="slider round text-white"><span class="ml-1">on </span> of</span>
                        </label>
                    </div>

                    <div class="div_detail" style="display:none">

                        <h5>Detalles</h5>

                    <p><i class="fas fa-check"></i> <strong>Opinion sobre Instalaciones donde se presta el servicio:</strong> <span class="">{{$value->answer1}}</span></p>
                    <p><i class="fas fa-check"></i> <strong>Puntualidad:</strong> <span class="">{{$value->answer2}}</span></p>
                    <p><i class="fas fa-check"></i> <strong>Calidad de Atención y Profesionalismo del servicio:</strong> <span class="">{{$value->answer3}}</span></p>
                    <p><i class="fas fa-check"></i> <strong>¿Recomendarias el servico otorgado por este Médico a algun Familiar o amigo?:</strong> <span class="">{{$value->answer4}}</span></p>

                    <p><i class="fas fa-check"></i> <strong>Opinion respecto al servicio prestado por el Médico profesional:</strong> </p>
                    <p class="ml-4"><span class="">@if($value->answer5 == Null) <span class="text-secondary">No especifica @else {{$value->answer5}} @endif</span></span></p>
                    <p><i class="fas fa-check"></i> <strong>Lo que le agrado del servicio:</strong>
                        <p class="ml-4"><span class="">@if($value->answer6 == Null) <span class="text-secondary">No especifica @else {{$value->answer6}} @endif</span></span></p>
                    @rol_edit
                    <p><i class="fas fa-check"></i> <strong class="text-danger">Recomendaciones:</strong><span class="text-secondary ml-2">(No se mostrara a los visitantes)</span>
                        <p class="ml-4"><span class="">@if($value->answer6 == Null) <span class="text-secondary">No especifica @else {{$value->answer6}} @endif</span></span></p>
                    @endrol_edit
                </div>
            </div>
        @endif {{-- final if $rate_medic->show  --}}

        </div>
        @endforeach
        <div class="card-header mt-2">
            {!! $rate_medic->links() !!}
        </div>
@elseif(isset($views))
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">No ahi registro de calificaciones</h5>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">No ahi registro de calificaciones sin comprobar</h5>
            </div>
        </div>
    @endif
    </div>
@endsection

@section('scriptJS')
  <script type="text/javascript">
        function toogle(result){
            if( $(result).parent('.id_label').parent('.este').next('.div_detail').css('display') == 'none'){
                result = $(result).parent('.id_label').parent('.este').next('.div_detail').show();
            }else{
                result = $(result).parent('.id_label').parent('.este').next('.div_detail').hide();

            }
        }

        function show(result){
            element = result;
            valor = $(result).val();
            rate_id = result.id;
            route = "{{route('check_show_rate')}}";
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              url: route,
              data:{valor:valor,rate_id:rate_id},

              success:function(result){
                console.log(result);
                 $(element).parent('.id_label').parent('.este').parent('.este2').prev('.este3').find('.btn').css('background','rgb(223, 223, 223)').css('color','grey').css('border-color','grey');

            },
            error:function(error){
             console.log(error);

           },
        });
        }

        function check_view(result){
            element = result;
            rate_id = result.id;
            route = "{{route('check_view_ajax')}}";
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              url: route,
              data:{rate_id:rate_id},
              success:function(result){
                $(element).css('background','rgb(223, 223, 223)').css('color','grey').css('border-color','grey');
            },
            error:function(error){
             console.log(error);

           },
        });
        }


  </script>

@endsection
