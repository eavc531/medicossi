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
  <div class="card">
    @include('medico.notes.include_data_consultorio')

    <div class="card-body">
      <div class="text-center mb-3">
        <h4 style="text-decoration: underline;text-align:center;font-size: 1.5rem">{{$note->title}}</h4>
      </div>
      @include('medico.notes.include_data_patient')

      <table style="margin-top:100px">
          <tr>
               <td width="350px">
                   <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Fecha de ingreso:</h5>

                   <input type="hidden" name="" value="{{$fecha_ingreso = \Carbon\Carbon::parse($note->fecha_ingreso)->format('d-m-Y')}}">
                   {{$fecha_ingreso}}
              </td>
               <td width="350px">
                   <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Fecha de egreso:</h5>
                   <input type="hidden" name="" value="{{$fecha_egreso = \Carbon\Carbon::parse($note->fecha_egreso)->format('d-m-Y')}}">
                   {{$fecha_egreso}}
              </td>
          </tr>
      </table>


      <hr>
      @if($note->Motivo_del_egreso_show == 'si')

        <div class="form-group mt-3">
          <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Motivo del egreso:</h5>
          {{$note->Motivo_del_egreso}}
        </div>
        <hr>
      @endif
      @if($note->Diagnosticos_finales_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Diagnosticos finales:</h5>
        {{$note->Diagnosticos_finales}}
      </div>
      <hr>
      @endif
      @if($note->Resumen_de_evolucion_y_estado_actual_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Resumen de evolucion y estado actual:</h5>
        {{$note->Resumen_de_evolucion_y_estado_actual}}
      </div>
      <hr>
      @endif
      @if($note->Manejo_durante_la_estancia_hospitalaria_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Manejo durante la estancia hospitalaria:</h5>
        {{$note->Manejo_durante_la_estancia_hospitalaria}}
      </div>
      <hr>
      @endif
      @if($note->Problemas_clinicos_pendientes_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Problemas clinicos pendientes:</h5>
        {{$note->Problemas_clinicos_pendientes}}
      </div>
      <hr>
      @endif
      @if($note->Plan_de_manejo_y_tratamiento_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Plan de manejo y tratamiento:</h5>
        {{$note->Plan_de_manejo_y_tratamiento}}
      </div>
      <hr>
      @endif
      @if($note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Recomendaciones para vigilancia ambulatoira:</h5>
        {{$note->Recomendaciones_para_vigilancia_ambulatoira}}
      </div>
      <hr>
      @endif
      @if($note->Otros_datos_show == 'si')
      <div class="form-group">
        <h5 style="font-size: 1rem; color: #0060df;font-weight: 700;">Otros datos:</h5>
        {{$note->Otros_datos}}
      </div>
      <hr>
      @endif
      <div class="mt-5" style="">

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
