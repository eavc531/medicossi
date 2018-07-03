@extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-12">
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
        <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-info ml-1">Todas</a>
      </div>
      {!!Form::close()!!}

        <a class="btn btn-info mb-3" href="{{route('type_notes',['medico_id'=>$medico->id,'patient_id'=>$patient->id])}}" data-toggle="tooltip" data-placement="top" title="Crear Nueva Nota"><i class="fas fa-file-medical"></i></a>




      @if($notes->first() != Null and !isset($search))
      <ul class="list-group">
        @foreach ($notes as $note)

        <li class="list-group-item d-flex justify-content-between align-items-sm-start align-items-end"><span class="mr-auto">{{$note->title}} {{\Carbon\Carbon::parse($note->created_at)->format('d-m-Y H:i')}}</span>
            <a href="{{route('view_preview',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Vista previa/Descargar"><i class="fas fa-eye"></i></a>
          @if($note->title == 'Nota Médica Inicial')

          <a href="{{route('note_ini_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>

          @elseif($note->title == 'Nota Médica de Evolucion')

          <a href="{{route('note_evo_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
          @elseif($note->title == 'Nota de Interconsulta')
          <a href="{{route('note_inter_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>

          @elseif($note->title == 'Nota médica de Urgencias')
          <a href="{{route('note_urgencias_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
          @elseif($note->title == 'Nota médica de Egreso')
          <a href="{{route('note_egreso_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
          @elseif($note->title == 'Nota de Referencia o traslado')
          <a href="{{route('note_referencia_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
          @endif

            <a href="{{route('download_pdf',$note->id)}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
        </li>
        @endforeach
      </ul>
      <div class="">
      {{$notes->appends(Request::all())->links()}}
      </div>
    @elseif($notes->first() != Null)
        <ul class="list-group">
          @foreach ($notes as $note)

          <li class="list-group-item d-flex justify-content-between align-items-sm-start align-items-end"><span class="mr-auto">{{$note->title}} {{\Carbon\Carbon::parse($note->created_at)->format('d-m-Y H:i')}}</span>
              <a href="{{route('view_preview',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Vista previa/Descargar"><i class="fas fa-eye"></i></a>
            @if($note->title == 'Nota Médica Inicial')

            <a href="{{route('note_ini_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>

            @elseif($note->title == 'Nota Médica de Evolucion')

            <a href="{{route('note_evo_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
            @elseif($note->title == 'Nota de Interconsulta')
            <a href="{{route('note_inter_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>

            @elseif($note->title == 'Nota médica de Urgencias')
            <a href="{{route('note_urgencias_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
            @elseif($note->title == 'Nota médica de Egreso')
            <a href="{{route('note_egreso_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
            @elseif($note->title == 'Nota de Referencia o traslado')
            <a href="{{route('note_referencia_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="mr-2 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
            @endif

              <a href="{{route('download_pdf',$note->id)}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
          </li>
          @endforeach
        </ul>
        <div class="">
        {{$notes->appends(Request::all())->links()}}
        </div>
      @elseif($notes->first() == Null and isset($search))
        <div class="card">
          <div class="card-body">
            <button type="close" name="button" class="close"></button>
            <h5 class="font-title-blue text-center">No se encontraron resultados para la busqueda</h5>
          </div>
        </div>
      @elseif($notes->first() == Null)
        <div class="card">
          <div class="card-body">
            <h5 class="font-title-blue text-center">No ahi registro de Notas</h5>
          </div>
        </div>
      @endif
      {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
    </div>

    <div class="col-12 col-sm-6 m-sm-auto col-lg-3 bg-primary">


    </div>

  </div>
</div>
</div>

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
{{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}


<script>

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
