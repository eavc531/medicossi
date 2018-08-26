@extends('layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.css')}}">
<style media="screen">
.dropdown-menu {
  width: 430px !important;

}

.line{
  display: inline-block;
  float:left;
  /* border:solid 1px black; */
}

.area{
        height: 80px;
}

/* //yakusa// */
.ui-autocomplete {
  z-index:2147483647;
}
</style>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-12">
      <div class="register">
        <div class="row">
          <div class="col-12">
            <h2 class="text-center font-title">Notas de Paciente: <span>{{$patient->name }} {{$patient->lastName }}</span></h2>
          </div>
        </div>

        {{-- MENU DE PACIENTES --}}
        @include('medico.includes.main_medico_patients')

      </div>
      {{-- ////////////////////////////////////////////centro de menu////////////centro de menu// --}}

      {!!Form::model(request()->all(),['route'=>'note_search','method'=>'GET'])!!}
      <div class="form-inline p-2 my-3" style="border:solid 1px rgb(115, 115, 115)">
        <label for="">Buscar Por:</label>
        <input type="hidden" name="medico_id" value="{{$medico->id}}">
        <input type="hidden" name="patient_id" value="{{$patient->id}}">

        {!!Form::select('select',['Tipo de Nota'=>'Tipo de Nota','Tipo y Fecha'=>'Tipo y Fecha'],null,['class'=>'form-control ml-1','id'=>'select_input'])!!}

        {!!Form::select('type',['Nota Médica Inicial'=>'Nota Médica Inicial','Nota de Referencia o traslado'=>'Nota de Referencia o traslado','Nota médica de Egreso'=>'Nota médica de Egreso','Nota médica de Urgencias'=>'Nota médica de Urgencias','Nota de Interconsulta'=>'Nota de Interconsulta','Nota Médica de Evolucion'=>'Nota Médica de Evolucion','Todas'=>'Todas'],null,['class'=>'form-control ml-1','placeholder'=>'Opciones de notas','id'=>'type'])!!}
        @if(request()->date != Null)
            {!!Form::date('date',null,['class'=>'form-control ml-1','placeholder'=>'Fecha','id'=>'date1'])!!}
        @elseif(request()->select == 'Tipo y Fecha')
            {!!Form::date('date',null,['class'=>'form-control ml-1','placeholder'=>'Fecha','id'=>'date1','style'=>''])!!}
        @else
            {!!Form::date('date',null,['class'=>'form-control ml-1','placeholder'=>'Fecha','id'=>'date1','style'=>'display:none'])!!}
        @endif

        <button class="btn btn-primary ml-1" type="submit" name="button"><i class="fas fa-search"></i></button>
        <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-info ml-1">Todas</a>
      </div>
      {!!Form::close()!!}
        @include('medico.notes.main_notes_create_config')
          {{-- <a class="btn btn-info" href="{{route('type_notes',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient->id)])}}" data-toggle="tooltip" data-placement="top" title="Tipos de Notas"><i class="fas fa-file-medical"></i></a> --}}
          <a href="{{route('data_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Datos del Paciente">Datos Cabecera Pdf<span style="font-size:11"></span></a>

        </div>

        @if($notes->first() != Null and !isset($search))

          <table class="table table-bordered mt-2">
            <thead>
              <td>Nombre</td>
              <td>Creación</td>
              <td>ultima Edicion</td>
              <td>Acciones</td>
            </thead>
            <tbody>

              @foreach ($notes as $note)
                {{-- <input type="hidden" name="" value="{{$}}"> --}}
                <tr>
                  <td>{{$note->title}}</td>
                  <td>{{\Carbon\Carbon::parse($note->date_start)->format('d-m-Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($note->date_edit)->format('d-m-Y')}}</td>
                  <td>


                    <a class="mr-2 btn btn-secondary" href="{{route('view_preview',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'n_id'=>\Hashids::encode($note->id)])}}"><i class="fas fa-eye"></i></a>
                    <a class="mr-2 btn btn-primary" href="{{route('note_edit',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'n_id'=>\Hashids::encode($note->id)])}}"><i class="fas fa-edit"></i></a>
                    <a href="{{route('download_pdf',\Hashids::encode($note->id))}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
                    <a href="{{route('note_move',\Hashids::encode($note->id))}}" class="mr-2 btn btn-warning" data-toggle="tooltip" data-placement="top" title="Mover a"><i class="fas fa-exchange-alt"></i></a>
                      {{-- <a onclick="return confirm('¿Esta Segur@ de eliminar esta Nota Médica del expediente?, la nota seguira exisitiendo en el panel ´Notas del Paciente´ despues de realizar esta acción.');" href="{{route('expedient_note_delete',\Hashids::encode($note->id))}}" class="mr-2 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a> --}}
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="">
            {{$notes->appends(Request::all())->links()}}
          </div>
        @elseif($notes->first() == Null and isset($search))
          <div class="card mt-5">
            <div class="card-body">
              <button type="close" name="button" class="close"></button>
              <h5 class="font-title-blue text-center">No se encontraron resultados para la busqueda</h5>
            </div>
          </div>
        @elseif($notes->first() == Null)
          <div class="card mt-5">
            <div class="card-body">
              <h5 class="font-title-blue text-center">No ahi registro de notas</h5>
            </div>
          </div>
        @endif
      {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
    </div>

    {{-- <div class="col-12 col-sm-6 m-sm-auto col-lg-3 bg-primary">


    </div> --}}

  </div>
</div>
</div>

@isset($salubridad_report->status)

    <input type="hidden" name="" value="{{$salubridad_report->status}}" id="report">
@else
    <input type="hidden" name="" value="" id="report">

@endisset


@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
{{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}

<script src="{{asset('jqueryui/jquery-ui.js')}}"></script>
<script>

    function verify_empty(result){

      $('#select').val(result.value);
      if(result.value == 'no' || result.value == 'no_recordar'){

          $('#select').val(result.value);
           $('#form-report').submit();
           return false;
      }

      text = $('#diagnostic_report').val();

      if(text.length == 0){
          $('#alert_campo').html('El campo diagnostico para el reporte no puede estar vacio, rellene el campo o seleccione otra opcion para continar')

          return false;
      }else{

          question = confirm('¿Esta Segu@ de Crear el reporte de salubridad con el diagnostico descrito?');
          if(question == true){
              $('#form-report').submit();
          }else{
              return false;
          }


      }
  }

function verify_report(result){

    if(result.id == 'Nota Médica Inicial' || result.id == 'Nota Médica de Evolucion'){
        window.location.href = result.name;
        return false;
    }

    report = $('#report').val();


    if(report.length == 0){
        $('#url_form').val(result.name);
        $('#modal-report').modal('show');
        return false;
    }
    window.location.href = result.name;
}


$(function()
{
  $("#diagnostic_report").autocomplete({
    source: "{{route('autocomplete_diagnostic')}}",
    minLength: 2,
    select: function(event, ui) {
      $('#q').val(ui.item.value);
    }
  });
});

      $(document).ready(function(){
        if($('#select_input').val() == 'Tipo y Fecha'){
            $('#date1').show();
        }

      });

      $('#select_input').change(function(){

        if($('#select_input').val() == 'Tipo y Fecha'){
          $('#date1').show();
        }else{
          $('#date1').hide();
        }
      });

    </script>

    @endsection
