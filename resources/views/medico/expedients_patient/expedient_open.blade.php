@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch.css')}}">
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
          @include('medico.includes.main_medico_patients')

        </div>


    @include('medico.expedients_patient.main_notes_create_config')

    <a href="{{route('data_patient',['m_id'=>$medico->id,'p_id'=>$patient->id,'expedient'=>$expedient->id])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Datos del Paciente">Datos Cabecera Pdf<span style="font-size:11"></span></a>

    <a href="{{route('expedients_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary float-right ml-1">atras</a>

@if($expedient_notes->first() != Null and !isset($search))


  <div class="my-5 text-center">
    <h5 class="font-title-blue">Notas expediente: {{$expedient->name}}</h5>

  </div>

  <div class="" style="background:red">
    <a href="{{route('download_expedient_pdf',$expedient->id)}}" class="btn btn-info float-right mb-2 ml-1">Descargar Expediente pdf</a>
    <a href="{{route('expedient_preview',$expedient->id)}}" class="btn btn-secondary float-right mb-2">Vista previa Expediente</a>

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
          <td>{{\Carbon\Carbon::parse($expedient_n->note->date_start)->format('d-m-Y')}}</td>
          <td>{{\Carbon\Carbon::parse($expedient_n->note->date_edit)->format('d-m-Y')}}</td>

          <td>

              <a class="mr-2 btn btn-secondary" href="{{route('view_preview',['m_id'=>$expedient_n->medico_id,'p_id'=>$expedient_n->note->patient_id,'n_id'=>$expedient_n->note->id,'expedient_id'=>$expedient->id])}}"><i class="fas fa-eye"></i></a>

              <a class="mr-2 btn btn-primary" href="{{route('note_edit',['m_id'=>$expedient_n->medico_id,'p_id'=>$expedient_n->note->patient_id,'n_id'=>$expedient_n->note->id,'expedient_id'=>$expedient->id])}}"><i class="fas fa-edit"></i></a>
              <a href="{{route('download_pdf',[$expedient_n->note_id,'expedient_id'=>$expedient->id])}}" class="mr-2 btn btn-info" data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i></a>
              <a href="{{route('note_move',[$expedient_n->note_id,'expedient_id'=>$expedient->id])}}" class="mr-2 btn btn-warning" data-toggle="tooltip" data-placement="top" title="Mover a"><i class="fas fa-exchange-alt"></i></a>
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
  {{-- <script type="text/javascript">
  function toogle(result){
    label = result.parentNode;
    div = label;
    note_id = "{{$note->id}}";
    variable = result.id;

    route = "{{route('check_input_notes')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: route,
      data:{variable:variable,note_id:note_id},

      success:function(result){
        console.log(result);
        // alert(result.variable);
        // CKEDITOR.instances['Signos_vitales'].setReadOnly(true);
          //
          // $(div).next('.form-control').hide();
          // $(div).prev().css('color','grey');
        }
        // $(result).next('.form-control').css({"height":"1px"}).attr("disabled","true");
      },
      error:function(error){
       console.log(error);
     },
  });
  } --}}
  </script>

@endsection
