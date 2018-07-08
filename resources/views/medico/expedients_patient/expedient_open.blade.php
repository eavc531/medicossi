@extends('layouts.app-panel')
@section('css')

<style media="screen">
.dropdown-menu {
  width: 430px !important;

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
    <div class="col-lg-9 col-12">
      <div class="register">
        <div class="row">
          <div class="col-12">
            <h2 class="text-center font-title">Notas expediente: <span>{{$expedient->name}}, Paciente: {{$patient->name}} {{$patient->lastName}}</span></h2>
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
        <div class="mb-3">
          <div class="btn-group">

            {{-- <button type="button" class="btn btn-primary">Agregar Nota a Expediente</button> --}}
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">

              @foreach ($notes_pre as $note)
                <div class="dropdown-item" style="border:solid 1px rgb(187, 178, 178);background:rgb(231, 240, 249)">
                  <div class="row col-12">
                    <div class="col-8">
                        <span class="mr-3">{{$note->title}}</span>
                    </div>

                  @if($note->title == 'Nota Médica Inicial')
                    <div class="col-4">
                  <a href="{{route('note_medic_ini_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
                  <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a>
                  </div>
                  </div>
                  </div>
                  @elseif($note->title == 'Nota Médica de Evolucion')
                      <div class="col-4">
                  <a href="{{route('note_evo_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
                  <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a>
                </div>
                </div>
                </div>
                  @elseif($note->title == 'Nota de Interconsulta')
              <div class="col-4">
                  <a href="{{route('note_inter_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
                  <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a>
                </div>
                </div>
                </div>
                  @elseif($note->title == 'Nota médica de Urgencias')
              <div class="col-4">
                  <a href="{{route('note_urgencias_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
                  <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a>
                </div>
                </div>
                </div>
                  @elseif($note->title == 'Nota médica de Egreso')
              <div class="col-4">
                    <a href="{{route('note_egreso_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
                      <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a>
                    </div>
                    </div>
                    </div>
                  @elseif($note->title == 'Nota de Referencia o traslado')
              <div class="col-4">
                    <a href="{{route('note_referencia_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary mr-2 " data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus"></i></a>
                      <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Configurar"><i class="fas fa-cog"></i></a>
                    </div>
                    </div>
                    </div>
                  @endif

              @endforeach
            </div>
          </div>

          <a href="{{route('data_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Datos del Paciente"><i class="far fa-file-alt"></i><span style="font-size:11"></span></a>


        {{-- <input type="hidden" name="" value="{{$name_exp = 'expediente Nro'$expedients->count() + 1}}"> --}}

        @if($notes->first() != Null and !isset($search))

          <table class="table table-bordered">
            <thead>
                <td>Nombre</td>
                <td>Creación</td>
                <td>ultima Edicion</td>
                <td>Acciones</td>
            </thead>
            <tbody>
              @foreach ($notes as $note)
              <tr>
                <td>{{$note->name}}</td>
                <td>{{\Carbon\Carbon::parse($note->created_at)->format('d-m-Y')}}</td>
                <td>{{$note->date_edit}}</td>
                <td>
                  <div class="form-inline">
                    {!!Form::open(['route'=>'expedient_open','method'=>'POST'])!!}
                      <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                          <input type="hidden" name="expedient_id" value="{{$note->id}}">
                          <button type="submit" class="btn btn-success m-1"><i class="fas fa-folder-open"></i></button>
                    {!!Form::close()!!}
                    <a href="{{route('expedient_edit',$note->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="{{route('expedient_delete',$note->id)}}" class="btn btn-danger"> Eliminar</a>
                  </div>

                </td>

              </tr>
                @endforeach
            </tbody>
          </table>
            <div class="">
            {{$notes->appends(Request::all())->links()}}
            </div>

        @elseif($notes->first() != Null)

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
<script type="text/javascript">

</script>

    @endsection
