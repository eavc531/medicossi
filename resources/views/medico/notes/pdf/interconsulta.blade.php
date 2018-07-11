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

  <div class="card">
    <div class="row">
      <!--   <div class="col-8">
      <img style="float:left;width: 50%;" src="http://127.0.0.1:8000/img/Medicossi-Marca original-01.png" alt="">
    </div> -->
    <div class="col-4">
      @include('medico.notes.include_data_consultorio')
    </div>
  </div>
  <div class="card-body">
    <h2 style="text-decoration: underline;text-align:center;font-size: 1.5rem">{{$note->title}}</h2>

    @include('medico.notes.include_data_patient')

    <div class="form-group" style="margin-top:90px">

      @if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si')
        <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Afección principal o motivo de consulta</h4>
        <p>{{$note->Afeccion_principal_o_motivo_de_consulta}}</p>
      </div>
      <hr>
    @endif
    @if($note->Afeccion_secundaria_show == 'si')
      <div class="form-group">
        <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Afeccion secundaria</h4>
        <p>{{$note->Afeccion_secundaria}}</p>

      </div>
      <hr>
    @endif
    @if($note->Pronostico_show == 'si')
      <div class="form-group">
        <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pronostico</h4>
        <p>{{$note->Pronostico}}</p>

      </div>
      <hr>
    @endif
    @if($note->Pruebas_de_laboratorio_show == 'si')
      <div class="form-group">
        <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Pruebas de laboratorio</h4>
        <p>{!!$note->Pruebas_de_laboratorio!!}</p>

      </div>
      <hr>
    @endif
    @if($note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si')
      <div class="form-group">
        <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Evolucion y actualizacion del cuadro clinico</h4>
        <p>{{$note->Evolucion_y_actualizacion_del_cuadro_clinico}}</p>

      </div>
      <hr>
    @endif
    @if($note->Sugerencias_y_tratamiento_show == 'si')
      <div class="form-group">
        <h4 style="font-size: 1rem; color: #0060df;font-weight: 700;">Sugerencias y tratamiento</h4>
        <p>{{$note->Sugerencias_y_tratamiento}}</p>

      </div>
      <hr>
    @endif

    <div class="mt-5">

      <div class="" style="width:50%;float:left">
        <p class="font-title-grey"><strong>Médico Tratante:</strong> {{$medico->name}} {{$medico->lastName}}</p>
        <p class="font-title-grey"><strong>Cedula profesional:</strong> {{$medico->identification}}</p>
      </div>

      <div class="" style="width:50%;float:right">

        <div class="text-center">
          <p>_________________________________</p>
        </div>

        <div class="text-center">
          <p>             <b> Firma </b>              </p>
        </div>

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
