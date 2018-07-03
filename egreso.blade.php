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
    <div class="card-body">
      <div class="text-center mb-3">
        <h4>{{$note->title}}</h4>
      </div>
      @include('medico.notes.include_data_patient')

        <div class="row">
          <div class="col-lg-6 col-sm-6 col-12">
            <h5 class="font-title-blue">Fecha de ingreso:</h5>

            <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_ingreso)->format('d-m-Y')}}">
            {{$fecha_egreso}}
          </div>
          <div class="col-lg-6 col-sm-6 col-12">
            <h5 class="font-title-blue">Fecha de egreso:</h5>
            <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_egreso)->format('d-m-Y')}}">
            {{$fecha_egreso}}
          </div>
        </div>
  <hr>
        <div class="form-group mt-3">
          <h5 class="font-title-blue">Motivo del egreso</h5>
          {{$note->Motivo_del_egreso}}
        </div>
  <hr>
  <div class="form-group">
          <h5 class="font-title-blue">Diagnosticos finales</h5>
          {{$note->Diagnosticos_finales}}
        </div>
  <hr>
        <div class="form-group">
          <h5 class="font-title-blue">Resumen de evolucion y estado actual</h5>
          {{$note->Resumen_de_evolucion_y_estado_actual}}
        </div>
  <hr>
        <div class="form-group">
          <h5 class="font-title-blue">Manejo durante la estancia hospitalaria</h5>
          {{$note->Manejo_durante_la_estancia_hospitalaria}}
        </div>
  <hr>
        <div class="form-group">
          <h5 class="font-title-blue">Problemas clinicos pendientes</h5>
          {{$note->Problemas_clinicos_pendientes}}
        </div>
  <hr>
        <div class="form-group">
          <h5 class="font-title-blue">Plan de manejo y tratamiento</h5>
          {{$note->Plan_de_manejo_y_tratamiento}}
        </div>
  <hr>
        <div class="form-group">
          <h5 class="font-title-blue">Recomendaciones para vigilancia ambulatoira</h5>
          {{$note->Recomendaciones_para_vigilancia_ambulatoira}}
        </div>
  <hr>
        <div class="form-group">
          <h5 class="font-title-blue">Otros Datos</h5>

  <hr>

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

</html>
