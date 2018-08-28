
    <div class="row">
      <div class="col-12">
        <h2 class="text-center font-title"><span> Calificación: {{$medico->nameComplete}}</span></h2>
      </div>
    </div>

    <div class="mt-5">

        @rol_edit
    @isset($views)
        <a href="{{route('calification_medic',Hashids::encode($medico->id))}}" class="btn btn-primary">Calificaciónes sin comprobar</a>
        <a href="{{route('calification_medic_viewed',Hashids::encode($medico->id))}}" class="btn btn-success disabled">Calificaciónes Vistas</a>
    @else
        <a href="{{route('calification_medic',Hashids::encode($medico->id))}}" class="btn btn-primary disabled">Calificaciónes sin comprobar</a>
        <a href="{{route('calification_medic_viewed',Hashids::encode($medico->id))}}" class="btn btn-success">Calificaciónes Vistas</a>
    @endisset

    @endrol_edit

    @if($medico->calification != Null)
        <div class="card" style="max-width:300px">
            <div class="card-body">
                <strong>Calificaión General:</strong>
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

            @endisset
        @else
            <h4 class="text-primary">Opiniones de los usuarios</h4>
        @endrol_edit

    </div>
    <div class="mt-5">
        @if($rate_medic->first() != Null)
            <input type="hidden" name="" value="{{$skip = 0}}">
        @foreach ($rate_medic as $value)
            <input type="hidden" name="" value="{{$skip = $skip + 1}}">
            <div class="card mt-4">
                <div class="card-header">

                        <div class="form-inline">
                            <h5>Calificación otorgada por Paciente <span class="text-primary">{{$value->patient->nameComplete}}:</span></h5>
                            <div class="ml-2" style="font-size:18px">
                                @include('medico.star_rate')
                            </div>

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
        @endif

        </div>
        @endforeach
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

@if($rate_medic->first() != Null)

    <div class="text-right my-3 padre">
        <button onclick="show_more(this)" type="button" name="{{$skip}}" class="btn btn-secondary btn-sm" id="{{$medico->id}}">Mostrar mas</button>
    </div>
    <div class="sig">
    </div>

@endif