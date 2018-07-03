<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  {{-- <link rel="stylesheet" href="{{asset('tether/css/tether.min.css')}}">
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap_alpha_6.min.css')}}"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}"> --}}
  <title>Document</title>
  <style media="screen">

  </style>
</head>
<body>

  <div class="">

   <div class="">
     <div class="">
       <h4>{{$note->title}}</h4>
     </div>
     @include('medico.notes.include_data_patient')

    {{-- {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!} --}}

    <div class="" style="margin-top:90px">
      <hr>
      <h5 class="">Exploracion fisica</h5>
      <p>{{$note->Exploracion_fisica}}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Signos vitales</h5>
      <p>{!!$note->Signos_vitales!!}</p>
    </div>
    <hr>
    <div class="form-group">
      <h5 class="font-title-blue">Pruebas de laboratorio</h5>
      <p>{!!$note->Pruebas_de_laboratorio!!}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Diagnostico</h5>
      <p>{!!$note->Diagnostico!!}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Afección principal o motivo de consulta</h5>
      <p>{!!$note->Afeccion_principal_o_motivo_de_consulta!!}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Afeccion secundaria</h5>
      <p>{!!$note->Afeccion_secundaria!!}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Pronostico</h5>
      <p>{!!$note->Pronostico!!}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Tratamiento y o receta</h5>
      <p>{!!$note->Tratamiento_y_o_recetas!!}</p>
    </div>
    <hr>
    <div class="">
      <h5 class="">Indicaciones terapeuticas</h5>
      <p>{!!$note->Indicaciones_terapeuticas!!}</p>
    </div>


    <hr>

    <div class="">

      <div class="" style="width:50%;float:left">
        <p class=""><strong>Médico Tratante:</strong> {{$medico->name}} {{$medico->lastName}}</p>
        <p class=""><strong>Cedula profesional:</strong> {{$medico->identification}}</p>
      </div>

      <div class="" style="width:50%;float:right">

          <div class="">
            <p>_________________________________</p>
          </div>

          <div class="">
            <p>             <b> Firma </b>              </p>
          </div>

      </div>
    </div>
      </div>
  </div>

</body>
{{-- <script src="{{asset('jquery/jquery.js')}}"></script>
<script src="{{asset('tether/js/tether.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script> --}}
</html>