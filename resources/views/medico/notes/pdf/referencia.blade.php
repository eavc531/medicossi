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



    <div class="form-group" style="margin-top:90px">
      <hr>
    <h5 class="font-title-blue">Motivo de envio</h5>
    <p>{{$note->Motivo_de_envio}}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Establecimiento que envia</h5>
      <p>{{$note->Establecimiento_que_envia}}</p>
  </div>
  <hr>
  <div class="form-group">
    <h5 class="font-title-blue">Establecimiento receptor</h5>
      <p>{{$note->Establecimiento_receptor}}</p>
  </div>
  <hr>

  <div class="form-group">
    <h5 class="font-title-blue">Diagnostico</h5>
      <p>{{$note->Diagnostico}}</p>
  </div>
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
{{-- <script src="{{asset('jquery/jquery.js')}}"></script>
<script src="{{asset('tether/js/tether.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script> --}}
</html>