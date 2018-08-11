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
        .font-title{
            color:rgb(97, 210, 44);
            font-weight: bold;
        }
  </style>
</head>
<body>

  {{-- <div class="">
    @include('medico.notes.include_data_consultorio')
  </div> --}}
  <div class="">

  </div>
  @include('medico.notes.include_data_consultorio')
   <div class="">
     <div class="">
       <h4 style="text-decoration: underline;text-align:center;font-size: 1.5rem">{{$note->title}}</h4>
     </div>
     @include('medico.notes.include_data_patient')

    {{-- {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!} --}}
    @if($note->Exploracion_fisica_show == 'si')

    <div class="" style="margin-top:90px">

      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Exploracion fisica</h5>
      <p>{{$note->Exploracion_fisica}}</p>
    </div>
    <hr>
    @endif
    @if($note->Signos_vitales_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Signos vitales</h5>
      @include('medico.notes.pdf.vital_signs')
    </div>
    <hr>
@endif
    @if($note->Pruebas_de_laboratorio_show == 'si')
        <div class="form-group">
            <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Pruebas de laboratorio</h5>

         @include('medico.notes.pdf.test_labs')
        </div>
        <hr>
@endif
    @if($note->Diagnostico_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnostico</h5>
      <p>{!!$note->Diagnostico!!}</p>
    </div>
    <hr>
@endif
    @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Afección principal o motivo de consulta</h5>
      <p>{!!$note->Afeccion_principal_o_motivo_de_consulta!!}</p>
    </div>
    <hr>
@endif
    @if($note->Afeccion_secundaria_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Afeccion secundaria</h5>
      <p>{!!$note->Afeccion_secundaria!!}</p>
    </div>
    <hr>
@endif
    @if($note->Pronostico_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Pronostico</h5>
      <p>{!!$note->Pronostico!!}</p>
    </div>
    <hr>
@endif
    @if($note->Tratamiento_y_o_recetas_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Tratamiento y o receta</h5>
      <p>{!!$note->Tratamiento_y_o_recetas!!}</p>
    </div>
    <hr>
@endif
    @if($note->Indicaciones_terapeuticas_show == 'si')
    <div class="">
      <h5 class="" style="font-size: 1rem; color: #0060df;font-weight: 700;">Indicaciones terapeuticas</h5>
      <p>{!!$note->Indicaciones_terapeuticas!!}</p>
    </div>
    <hr>
@endif


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
