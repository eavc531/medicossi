@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
      <div class="col-12 mb-3">
        <h2 class="text-center font-title">Calificar Médico: {{$medico->name}} {{$medico->lastName}} </h2>


      </div>
    </div>
    <div class="text-center my-5">
    @isset($you_rate)
        <h5 class="text-success">Ya has calificado al Profesional Médico {{$medico->nameComplete}}, sin embargo si has cambiado tu opinion respecto a su servicio, puedes editar tu antigua opinion, solo puedes calificar o editar una vez por cita.</h5>

    @else
        <h5 class="text-primary">Por favor seleccione las respuestas o a las siguientes incognitas  referentes a su opinion en cuanto al servicio prestado por el Profesional Médico {{$medico->nameComplete}}</h5>
    @endisset

    </div>

        <div class="card">
            {{-- <div class="card-header">
                Calificación Médico: {{$medico->nameComplete}}
            </div> --}}
            <div class="card-body">
                {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
                <input type="hidden" name="medico_id" value="{{$medico->id}}">
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <br>
                <div class="form-inline">
                    <label for=""><strong>1 <i class="fas fa-check text-danger"></i> Instalaciones donde se presta el servicio:</strong></label>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer1','Pésima',null)}} <span class="ml-1">Pésima</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer1','Mala',null)}} <span class="ml-1">Mala</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer1','Regular',null)}} <span class="ml-1">Regular</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer1','Buena',null)}} <span class="ml-1">Buena</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer1','Excelente',null)}} <span class="ml-1">Excelente</span>
                    </div>
                </div>
                <br>
                <div class="form-inline">
                    <label for=""><strong>2 <i class="fas fa-check text-danger"></i> Puntualidad:</strong></label>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer2','Pésima',null)}} <span class="ml-1">Pésima</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer2','Mala',null)}} <span class="ml-1">Mala</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer2','Regular',null)}} <span class="ml-1">Regular</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer2','Buena',null)}} <span class="ml-1">Buena</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer2','Excelente',null)}} <span class="ml-1">Excelente</span>
                    </div>
                </div>

                <br>
                <div class="form-inline">
                    <label for=""><strong>3 <i class="fas fa-check text-danger"></i> Calidad de Atención y Profesionalismo del servicio:</strong></label>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer3','Pésima',null)}} <span class="ml-1">Pésima</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer3','Mala',null)}} <span class="ml-1">Mala</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer3','Regular',null)}} <span class="ml-1">Regular</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer3','Buena',null)}} <span class="ml-1">Buena</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer3','Excelente',null)}} <span class="ml-1">Excelente</span>
                    </div>
                </div>
                <br>


                <div class="form-inline">
                    <label for=""><strong> 4 <i class="fas fa-check text-danger"></i> ¿Recomendarias el servico otorgado por este Médico a algun Familiar o amigo?:</strong></label>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer4','No',null)}} <span class="ml-1">No</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer4','Quisas',null)}} <span class="ml-1">Quisas</span>
                    </div>
                    <div class="form-inline ml-3">
                        {{Form::radio('answer4','Si',null)}} <span class="ml-1">Si</span>
                    </div>

                </div>
                <br>
                <div class="">
                    <label for=""><strong> 5 <i class="fas fa-check text-danger"></i> Describa su opinion respecto al servicio prestado por el Médico profesional: {{$medico->nameComplete}} (Opcional)</strong></label>
                    {{Form::textarea('answer5',null,['class'=>'form-control','style'=>'height:100px','placeholder'=>'...'])}}

                </div>

                <div class="card mt-5">
                    <div class="card-body">
                        <label for="" class="text-success"><strong>¿Podria señalar que cosas le agradaron del servicio? (Opcional)</strong></label>
                        {{Form::textarea('answer6',null,['class'=>'form-control','style'=>'border-color:green;height:100px'])}}
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <label for="" class="text-danger"><strong>Si pudiera agregar alguna recomendación para mejorar nuestro servicio, por favor describala (Opcional)</strong></label>
                        {{Form::textarea('answer7',null,['class'=>'form-control','style'=>'border-color:red;height:100px'])}}
                    </div>
                </div>

                <div class="text-right mt-5">
                    <a href="{{route('patient_appointments',\Hashids::encode(Auth::user()->patient_id))}}" class="btn btn-secondary">cancelar</a>
                    <button type="submit" name="button" class="btn btn-primary">Guardar mi Opinion</button>

                </div>
                {!!Form::close()!!}
            </div>
        </div>
        </div>
      </div>
    </section>
@endsection

@section('scriptJS')
<script type="text/javascript">
  function editar(){
    $('#create').show();
    $('#edit').hide();

  }

</script>

@endsection
