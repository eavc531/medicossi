@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">
<style media="screen">
.dropdown-menu {
  width: 430px !important;

}

.line{
  display: inline-block;
  float:left;
  /* border:solid 1px black; */
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
        <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-info ml-1">Todas</a>
      </div>
      {!!Form::close()!!}
        @include('medico.notes.main_notes_create_config')
          {{-- <a class="btn btn-info" href="{{route('type_notes',['medico_id'=>$medico->id,'patient_id'=>$patient->id])}}" data-toggle="tooltip" data-placement="top" title="Tipos de Notas"><i class="fas fa-file-medical"></i></a> --}}
          <a href="{{route('data_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Datos del Paciente">Datos Cabecera Pdf<span style="font-size:11"></span></a>

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


                    <form class="line" action="{{route('view_preview')}}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="medico_id" value="{{$medico->id}}">
                      <input type="hidden" name="patient_id" value="{{$patient->id}}">
                      <input type="hidden" name="note_id" value="{{$note->id}}">

                      <button type="submit" name="button" class="mr-2 btn btn-secondary"><i class="fas fa-eye"></i></button>
                    </form>
                    @if($note->title == 'Nota Médica Inicial')

                      <form class="line" action="{{route('note_ini_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>


                    @elseif($note->title == 'Nota Médica de Evolucion')
                      <form class="line" action="{{route('note_evo_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>

                    @elseif($note->title == 'Nota de Interconsulta')
                      <form class="line" action="{{route('note_inter_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>


                    @elseif($note->title == 'Nota médica de Urgencias')
                      <form class="line" action="{{route('note_urgencias_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>

                    @elseif($note->title == 'Nota médica de Egreso')
                      <a class="mr-1 btn btn-primary" href="{{route('note_egreso_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}"><i class="fas fa-pencil-alt"></i></a>


                    @elseif($note->title == 'Nota de Referencia o traslado')
                      <form class="line" action="{{route('note_referencia_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>

                    @endif
                    <a href="{{route('download_pdf',$note->id)}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
                    <a href="{{route('note_move',$note->id)}}" class="mr-2 btn btn-warning" data-toggle="tooltip" data-placement="top" title="Mover a"><i class="fas fa-exchange-alt"></i></a>
                      {{-- <a onclick="return confirm('¿Esta Segur@ de eliminar esta Nota Médica del expediente?, la nota seguira exisitiendo en el panel ´Notas del Paciente´ despues de realizar esta acción.');" href="{{route('expedient_note_delete',$note->id)}}" class="mr-2 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a> --}}
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="">
            {{$notes->appends(Request::all())->links()}}
          </div>

        @elseif($notes->first() != Null)
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

                    <form class="line" action="{{route('view_preview')}}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="medico_id" value="{{$medico->id}}">
                      <input type="hidden" name="patient_id" value="{{$patient->id}}">
                      <input type="hidden" name="note_id" value="{{$note->id}}">

                      <button type="submit" name="button" class="mr-2 btn btn-secondary"><i class="fas fa-eye"></i></button>
                    </form>
                    @if($note->title == 'Nota Médica Inicial')

                      <form class="line" action="{{route('note_ini_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>


                    @elseif($note->title == 'Nota Médica de Evolucion')
                      <form class="line" action="{{route('note_evo_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>

                    @elseif($note->title == 'Nota de Interconsulta')
                      <form class="line" action="{{route('note_inter_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>


                    @elseif($note->title == 'Nota médica de Urgencias')
                      <form class="line" action="{{route('note_urgencias_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>

                    @elseif($note->title == 'Nota médica de Egreso')
                      <a class="mr-1 btn btn-primary" href="{{route('note_egreso_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}"><i class="fas fa-pencil-alt"></i></a>


                    @elseif($note->title == 'Nota de Referencia o traslado')
                      <form class="line" action="{{route('note_referencia_edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="note_id" value="{{$note->id}}">

                        <button type="submit" name="button" class="mr-2 btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                      </form>

                    @endif
                    <a href="{{route('download_pdf',$note->id)}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
                      {{-- <a onclick="return confirm('¿Esta Segur@ de eliminar esta Nota Médica del expediente?, la nota seguira exisitiendo en el panel ´Notas del Paciente´ despues de realizar esta acción.');" href="{{route('expedient_note_delete',$note->id)}}" class="mr-2 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a> --}}
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
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
          <div class="card my-3">
            <div class="card-body">
              <h5 class="font-title-blue text-center">No ahi registro de Expedientes</h5>
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
