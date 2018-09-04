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
            <h2 class="text-center font-title mb-5">Notas Eliminadas: <span>{{$patient->name }} {{$patient->lastName }}</span></h2>
          </div>
        </div>

      </div>
      <div class="text-right">
          <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary ml-1">Atras</a>
      </div>


        {{-- <div class="my-5 text-center">
            <h5>Notas</h5>
        </div> --}}
        @if($notes->first() != Null)

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
                  <td>{{\Carbon\Carbon::parse($note->created_at)->format('d-m-Y H:i')}}</td>
                  <td>{{\Carbon\Carbon::parse($note->updated_at)->format('d-m-Y H:i')}}</td>
                  <td>
                      
                      <a onclick="return confirm('¿Esta Segur@ de restaurar esta Nota?');" href="{{route('note_restart',\Hashids::encode($note->id))}}" class="mr-2 btn btn-info">Restaurar</a>
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
              <h5 class="font-title-blue text-center">No ahi registro de notas Eliminadas</h5>
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
