@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
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


@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="register">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center font-title"><span> Paciente: {{$patient->name}} {{$patient->lastName}}, Expediente: {{$expedient->name}}</span></h2>
            </div>
          </div>

          {{-- MENU DE PACIENTES --}}
          {{-- @include('medico.includes.main_medico_patients') --}}

        </div>


    @include('medico.expedients_patient.main_notes_create_config')

    <button onclick="show()" type="button" name="button" class="btn btn-green">Adjuntar/Subir Archivo</button>
    {{-- //card - adjuntar archivo --}}
    @if($errors->any() or Session::has('warning'))
        <div class="card mt-4" style="max-width:400px" style="" id="div_upload">
            <div class="card-header bg-primary text-white">
                Subir Archivo o Imagen
                <button type="button" name="button" class="btn close" onclick="$(this).parent('.card-header').parent('.card').hide()">x</button>

            </div>
            <div class="card-body">

                    {{Form::open(['route'=>'patient_file_store','method'=>'POST','files'=>true])}}
                    {{Form::hidden('expedient_id',$expedient->id)}}
                    {{Form::hidden('patient_id',$patient->id)}}
                    {{Form::hidden('medico_id',$medico->id)}}
                    {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Archivo (Opcional)'])}}
                    {{Form::text('description',null,['class'=>'form-control mt-2','placeholder'=>'Descripción (Opcional)'])}}

                    <label for="">
                    {{Form::file('archivo',['class'=>'mt-3'])}}
                    </label>

                    <div class="mt-3">
                        <button type="submit" name="button" class="btn btn-primary"><i class="fas fa-upload"></i> subir</button>
                    </div>

                    {{Form::close()}}


            </div>
        </div>
    @else

        <div class="card mt-4" style="max-width:400px;display:none" id="div_upload">
            <div class="card-header bg-primary text-white">
                Subir Archivo o Imagen
                <button type="button" name="button" class="btn close" onclick="$(this).parent('.card-header').parent('.card').hide()">x</button>
            </div>
            <div class="card-body">

                    {{Form::open(['route'=>'patient_file_store','method'=>'POST','files'=>true])}}
                    {{Form::hidden('expedient_id',$expedient->id)}}
                    {{Form::hidden('patient_id',$patient->id)}}
                    {{Form::hidden('medico_id',$medico->id)}}
                    {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Archivo (Opcional)'])}}
                    {{Form::text('description',null,['class'=>'form-control mt-2','placeholder'=>'Descripción (Opcional)'])}}

                    <label for="">
                    {{Form::file('archivo',['class'=>'mt-3'])}}
                    </label>

                    <div class="mt-3">
                        <button type="submit" name="button" class="btn btn-primary"><i class="fas fa-upload"></i> subir</button>

                    </div>

                    {{Form::close()}}


            </div>
        </div>
    @endif

    <a href="{{route('expedients_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-secondary float-right ml-1">atras</a>

@if($expedient_notes->first() != Null and !isset($search))


  <div class="my-5 text-center">
    <h5 class="font-title-blue">Notas expediente: {{$expedient->name}}</h5>

  </div>

  <div class="" style="background:red">

    <a href="{{route('expedient_preview',\Hashids::encode($expedient->id))}}" class="btn btn-secondary float-right mb-2">Vista previa Expediente</a>
    <a href="{{route('download_expedient_pdf',\Hashids::encode($expedient->id))}}" class="btn btn-info float-right mb-2 ml-1">Descargar Expediente pdf</a>
  </div>

  <table class="table table-bordered mt-2">
    <thead>
      <td>Nombre</td>
      <td>Creación</td>
      <td>ultima Edicion</td>
      <td>Acciones</td>
    </thead>
    <tbody>

      @foreach ($expedient_notes as $expedient_n)
        {{-- <input type="hidden" name="" value="{{$}}"> --}}
        <tr>
          <td>{{$expedient_n->note->title}}</td>
          <td>{{\Carbon\Carbon::parse($expedient_n->note->created_at)->format('d-m-Y H:i')}}</td>
          <td>{{\Carbon\Carbon::parse($expedient_n->note->updated_at)->format('d-m-Y H:i')}}</td>

          <td>

              <a class="mr-2 btn btn-secondary" href="{{route('view_preview',['m_id'=>\Hashids::encode($expedient_n->medico_id),'p_id'=>\Hashids::encode($expedient_n->note->patient_id),'n_id'=>\Hashids::encode($expedient_n->note->id),'expedient_id'=>\Hashids::encode($expedient->id)])}}"><i class="fas fa-eye"></i></a>

              <a class="mr-2 btn btn-primary" href="{{route('note_edit',['m_id'=>\Hashids::encode($expedient_n->medico_id),'p_id'=>\Hashids::encode($expedient_n->note->patient_id),'n_id'=>\Hashids::encode($expedient_n->note->id),'expedient_id'=>\Hashids::encode($expedient->id)])}}"><i class="fas fa-edit"></i></a>
              <a href="{{route('download_pdf',[\Hashids::encode($expedient_n->note_id),'expedient_id'=>\Hashids::encode($expedient->id)])}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
              <a href="{{route('note_move',[\Hashids::encode($expedient_n->note_id),'expedient_id'=>\Hashids::encode($expedient->id)])}}" class="mr-2 btn btn-warning" data-toggle="tooltip" data-placement="top" title="Mover a"><i class="fas fa-exchange-alt"></i></a>
               <a onclick="return confirm('¿Esta Segur@ de eliminar esta Nota?');" href="{{route('expedient_note_delete',['exp_id'=>\Hashids::encode($expedient_n->expedient_id),'n_id'=>\Hashids::encode($expedient_n->note_id)])}}" class="mr-2 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="">
    {{$expedient_notes->appends(Request::all())->links()}}
  </div>

@elseif($expedient_notes->first() != Null)

@elseif($expedient_notes->first() == Null and isset($search))
  <div class="card">
    <div class="card-body">
      <button type="close" name="button" class="close"></button>
      <h5 class="font-title-blue text-center">No se encontraron resultados para la busqueda</h5>
    </div>
  </div>
@elseif($expedient_notes->first() == Null)
  <div class="card my-3">
    <div class="card-body">
      <h5 class="font-title-blue text-center">No ahi registro de Notas para este expediente</h5>
    </div>
  </div>
@endif


@if($expedient_files->first() != Null)

    <div class="card">
        <div class="card-header">
            Archivos Adjuntos
        </div>
        <div class="card-body">
            <div class="row">
            @foreach ($expedient_files as $files)
                <div class="col">
                        {{$files->name}}
                        <a onclick="return confirm('¿Esta seguro de eliminar el archivo de este expediente?')" href="{{route('file_delete_expedient',Hashids::encode($files->id))}}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>

                        <a onclick="" href="{{route('file_download',Hashids::encode($files->file_id))}}" class="btn btn-info btn-sm"><i class="fas fa-download"></i></a>
                </div>

            @endforeach
        </div>

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
{{-- //yakuza// --}}
@isset($salubridad_report->status)

    <input type="hidden" name="" value="{{$salubridad_report->status}}" id="report">
@else
    <input type="hidden" name="" value="" id="report">

@endisset

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
    <script src="{{asset('jqueryui/jquery-ui.js')}}"></script>
  <script type="text/javascript">

      function show(){
          $('#div_upload').fadeIn();
      }


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


  </script>

@endsection
