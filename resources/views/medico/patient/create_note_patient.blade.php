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
    <div class="col-lg-11 m-lg-auto col-sm-12 col-12">
      <div class="register">
        <div class="row">
          <div class="col-12">
            <h2 class="text-center font-title-grey">Crear Nueva Nota para Paciente: <span class="font-title-blue">{{$patient->name }} {{$patient->lastName }}</span></h2>
          </div>
        </div>
        <div class="row justify-content-center my-3">
          <div class="col-lg-8 col-12 m-auto">
            <div class="row">
              <div class="col-lg-4 col-6">
                <a href="#" onclick="calendario()"><img src="{{asset('img/botones-medicossi-26.png')}}" alt=""></a>
              </div>
              <div class="col-lg-4 col-6">
                <img src="{{asset('img/botones-medicossi-27.png')}}" alt="">
              </div>
              <div class="col-lg-4 mt-3 col-5 m-auto">
                <a href=""><img src="{{asset('img/botones-medicossi-32.png')}}" alt=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg mt-3 col-12 col-sm-6 inline">
            <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn btn-primary mr-2 mt-1" data-toggle="tooltip" data-html="true" title="<em>Lista de Pacientes</em>"><i class="fas fa-bars mr-2"></i>Lista de Pacientes</a>
            <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-primary mr-2 mt-1" data-toggle="tooltip" data-html="true" title="<em>Notas Médicas</em>"><i class="fas fa-notes-medical mr-2"></i>Notas Médicas</a>
          </div>
        </div>
      </div>
      <hr>
      {{-- ////////////////////////////////////////////centro de menu////////////centro de menu// --}}
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-12 mt-2">
          <h4 class="font-title-blue mb-0">Nueva {{$note->title}}</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mt-2">
          <a href="{{route('admin_data_patient',['med_id'=>\Hashids::encode($medico->id),'pat_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-primary mb-2" data-toggle="tooltip" data-html="true" title="<em>Modelos Notas Médicas</em>"><i class="far fa-file mr-2"></i>Modelos Notas Médicas</a>
        </div>
      </div>
      {!!Form::open(['route'=>'note_store','method'=>'POST'])!!}
      <div class="row">
        <div class="col-sm-6 col-lg col-12 my-1">
          <label for="" class="mx-1 font-title-grey">Titulo de la Nota: </label>
          {!!Form::text('title',$note->title,['class'=>'form-control'])!!}
        </div>
        <div class="col-sm-6 col-lg col-12 my-1">
          <label for="" class="mx-1 font-title-grey">Fecha: </label>
          {!!Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control'])!!}
        </div>

      </div>
      {!!Form::textarea('content',$note->content,['id'=>'editor1'])!!}
      {!!Form::hidden('patient_id',$patient->id)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}

      <div class="form-group mt-4">
        <h4 class="font-title-blue">Datos del Paciente</h4>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6 col-sm-6">
          <div class="form-group">
            <label for="" class="font-title-grey">Nombre:</label>
            {!!Form::text('name',$patient->name,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            <label for="" class="font-title-grey">Cedula:</label>
            {!!Form::text('identification',$patient->name,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            <label for="" class="font-title-grey">Fecha de Nacimiento:</label>
            {!!Form::date('birthdate',null,['class'=>'form-control','placeholder'=>'Fecha de Nacimiento'])!!}
          </div>
        </div>
        <div class="col-12 col-lg-6 col-sm-6">
          <div class="form-group">
            <label for="" class="font-title-grey">Apellido:</label>
            {!!Form::text('lastName',$patient->name,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            <label for="" class="font-title-grey">Genero:</label>
            {!!Form::select('gender',['Masculino','Femenino'],$patient->gender,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            <label for="" class="font-title-grey">Edad:</label>
            {!!Form::text('age',$patient->age,['class'=>'form-control'])!!}
          </div>
        </div>
      </div>
      {!!Form::model($patient,['route'=>['patient_store_address',\Hashids::encode($patient->id)],'method'=>'update'])!!}
      <div class="card p-3">
        <h5 class="font-title-blue"><b>Dirección del Paciente</b></h5>
        <div class="row mt-3">
          <div class="col-lg col-12">
            <div class="form-group">
              <label for="" class="font-title-grey">Pais</label>
              {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
            </div>
          </div>
          <div class="col-lg col-12">
            <div class="form-group">
              <label for="" class="font-title-grey">Estado</label>
              {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
            </div>
          </div>
          <div class="col-lg col-12">
            <div class="form-group">
              <label for="" class="font-title-grey" >Codigo Postal</label>
              {{Form::number('postal_code',null,['class'=>'form-control'])}}
            </div>
          </div>
          <div class="col-lg col-12">
            <div class="form-group">
              <label for="" class="font-title-grey">Ciudad</label>
              {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}

            </div>
          </div>
        </div>
        <div class= "row mt-2">
          <div class="col-lg col-12">
            <div class="form-group">
              <label for="" class="font-title-grey" >Colonia</label>
              {{Form::text('colony',null,['class'=>'form-control'])}}
            </div>
          </div>
          <div class="col-lg col-12">
            <div class="form-group">

             <label for="[object Object]" class="font-title-grey">Calle/Av (especifique)</label>
             {{Form::text('street',null,['class'=>'form-control'])}}
           </div>
         </div>
         <div class="col-lg col-12">
          <div class="form-group">
            <label for="" class="font-title-grey">Numero Externo</label>
            {{Form::text('number_ext',null,['class'=>'form-control'])}}
          </div>
        </div>
        <div class="col-lg col-12">
          <div class="form-group">
            <label for="" class="font-title-grey">Numero Interno</label>
            {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2'])}}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      {{-- @if($patient->stateConfirm == 'complete')
      <div class="col-lg-6 col-12 mt-2">
        <a href="{{route('patient.edit',$patient->id)}}" class="btn btn-primary btn-block">Cancelar</a>
      </div>
      @endif --}}
<!--       <div class="col-lg-12 col-12 mt-2 text-center">
        <button type="submit" class="btn btn-config-green">Guardar</button>
      </div> -->
    </div>
    {!!Form::close()!!}
    <div class="form-inline mt-2">
      <label for="" class="font-title-grey mx-2">Médico Tratante: </label>
      {!!Form::text('name_medico',$medico->name.' '.$medico->lastName,['class'=>'form-control'])!!}
    </div>
    <div class="row">
     <div class="col-12 text-center">
      {!!Form::submit('Guardar', ['class' => 'btn btn-config-green mt-2'])!!}
    </div>
  </div>

  {!!Form::close()!!}
  {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
</div>
</div>
</div>




@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
{{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script>
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
    </script>





    @endsection
