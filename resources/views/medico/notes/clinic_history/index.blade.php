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
            <h2 class="text-center font-title">Historia clinica Paciente: <span>{{$patient->name }} {{$patient->lastName }}</span></h2>
          </div>
        </div>

        {{-- MENU DE PACIENTES --}}
        @include('medico.includes.main_medico_patients')

      </div>
      {{-- ////////////////////////////////////////////centro de menu////////////centro de menu// --}}
      <div class="row">
          <div class="col-6">
              <a href="{{route('history_clinic_create',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-primary" onclick="loader()">Generar Nueva Historia Clinica
              </a>
          </div>
          <div class="col-6">
              <div class="text-right">
                  <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary">atras
                  </a>
              </div>
          </div>
      </div>



        <div class="my-5 text-center">
            <h5>Historias Clinicas</h5>
        </div>
        @if($clinic_histories->first() != Null)

          <table class="table table-bordered mt-2">
            <thead>
              <td>Nombre</td>
              <td>Creación</td>

              <td>Acciones</td>
            </thead>
            <tbody>

              @foreach ($clinic_histories as $clinic_history)
                {{-- <input type="hidden" name="" value="{{$}}"> --}}
                <tr>
                  <td>Historia Clinica</td>
                  <td>{{\Carbon\Carbon::parse($clinic_history->created_at)->format('d-m-Y H:i')}}</td>

                  <td>

                    <a class="btn btn-secondary" href="{{route('clinic_history_view_preview',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'h_id'=>\Hashids::encode($clinic_history->id)])}}"><i class="fas fa-eye"></i></a>

                    <a href="{{route('clinic_history_pdf',\Hashids::encode($clinic_history->id))}}" class="btn btn-info"><i class="fas fa-download"></i></a>

                    <a onclick="return confirm('¿Esta seguro de eliminar, esta historia clinica?, podra generar otra en cualquier momento.')" href="{{route('clinic_history_delete',\Hashids::encode($clinic_history->id))}}" class="btn btn-danger"><i class="fas fa-times"></i></a>
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="">
            {{$clinic_histories->appends(Request::all())->links()}}
          </div>
        @elseif($clinic_histories->first() == Null and isset($search))
          <div class="card mt-5">
            <div class="card-body">
              <button type="close" name="button" class="close"></button>
              <h5 class="font-title-blue text-center">No se encontraron resultados para la busqueda</h5>
            </div>
          </div>
        @elseif($clinic_histories->first() == Null)
          <div class="card mt-5">
            <div class="card-body">
              <h5 class="font-title-blue text-center">No ahi registro de Historias Clinicas</h5>
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

<script src="{{asset('jqueryui/jquery-ui.js')}}"></script>
<script>



    </script>

    @endsection
