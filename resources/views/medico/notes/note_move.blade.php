\Hashids::encode($note->patient_id)@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')


<div class="register container col-12">
<div class="row">
  <div class="col-12">
    <h3 class="text-center font-title">Mover "{{$note->title}} {{\Carbon\Carbon::parse($note->date_start)->format('d-m-Y')}}" a ?</span></h3>
  </div>
</div>

{{-- {{$_SERVER['REQUEST_URI']}} --}}
@if(Session::Has('success2'))
    <div class="div-alert" style="padding:20px">
      <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h5>{{Session::get('success2')}}</h5>

         <div class="mt-2">
             <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id),'exp_id'=>\Hashids::encode(Session::get('exp_id'))] )}}" class="btn btn-outline-success">ir a Expediente: {{Session::get('exp')}}</a>
             <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id)] )}}" class="btn btn-outline-success">ir a Notas</a>
             <a href="{{route('expedients_patient',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id)] )}}" class="btn btn-outline-success">ir a expedientes</a>
         </div>
      </div>
    </div>

   @endif

   @if(Session::Has('warning2'))
       <div class="div-alert" style="padding:20px">
         <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('warning2')}}
            <div class="mt-2">
                <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id),'exp_id'=>\Hashids::encode(Session::get('exp_id'))] )}}" class="btn btn-outline-warning">ir a Expediente: {{Session::get('exp')}}</a>
                <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id)] )}}" class="btn btn-outline-warning">ir a Notas</a>
                <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id),'exp_id'=>\Hashids::encode(Session::get('exp_id'))] )}}" class="btn btn-outline-warning">ir a expedientes</a>
            </div>
         </div>
       </div>

      @endif
      <div class="text-right">
          @isset(request()->expedient_id)
              <a class="btn btn-secondary" href="{{route('expedient_open',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id),'ex_id'=>\Hashids::encode(request()->expedient_id)])}}">atras</a>

          @else
            <a class="btn btn-secondary" href="{{route('notes_patient',['m_id'=>\Hashids::encode($note->medico_id),'p_id'=>\Hashids::encode($note->patient_id)])}}">atras</a>
        @endisset
      </div>

<div class="row mt-5">
  <div class="col-12">
    <h5 class="text-center font-title-blue">Seleccione el Expediente a donde desea mover la nota: "{{$note->title}} {{\Carbon\Carbon::parse($note->date_start)->format('d-m-Y')}}".</span></h5>
  </div>
</div>
<div class="row mt-5">


    @if($expedients->first() != Null)

      <table class="table table-bordered">
        <thead>
            <td>Nombre de Expediente</td>
            <td>Creación</td>

            <td>Seleccionar: </td>
        </thead>
        <tbody>
          @foreach ($expedients as $expedient)
          <tr>
            <td><span class="pre">{{$expedient->name}}</span>
              <form class="" action="{{route('expedient_update',\Hashids::encode($expedient->id))}}" method="post">
                {{csrf_field()}}

              <div class="input-group" style="display:none">
                  <input name="name_exp" type="text" value="{{$expedient->name}}" class="form-control inp">
                <div class="input-group-append">
                  <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="fas fa-save"></i></button>
                    <button class="cancel_edit" type="button" name="button" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></button>
                </div>
              </div>
              </form>
             </td>
            <td>{{\Carbon\Carbon::parse($expedient->created_at)->format('d-m-Y')}}</td>

            <td>
                <a href="{{route('note_move_store',['note_id'=>$note->id,'ex_id'=>\Hashids::encode($expedient->id)])}}" class="btn btn-success"><i class="fas fa-check"></i></a>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
        <div class="">
        {{$expedients->appends(Request::all())->links()}}
        </div>
      @else
        <div class="card">
          <div class="card-body">
            <h5 class="font-title-blue text-center">No ahi expedientes registrados para este Paciente</h5>
          </div>
        </div>

    @endif

</div>
</div>




@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
{{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script>

    </script>

    @endsection
