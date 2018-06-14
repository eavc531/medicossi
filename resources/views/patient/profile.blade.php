@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">

    <h2 class="font-title text-center">Perfil de Paciente</h2>
  </div>
</div>


<div class="col-12">
  <h4 class="font-title-blue">Datos del Paciente: {{$patient->name}} {{$patient->lastName}}</h4>
</div>

{{-- <p>La información que se registra en su cuenta,le permite ser ubicado con mayor facilidad por sus clientes a travez del sistema, ademas le permite brindar, una mejor descripción de su profesión.</p> --}}

<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">


  </div>
  <div class="row mt-3">
   <div class="col-lg-7 col-12">

    @isset($photo->path)
    <div class="cont-img my-2">
      <img src="{{asset($photo->path)}}" class="prof-img" alt="" id="img">
    </div>
    @else
      <div class="cont-img my-2">
        <img src="{{asset('img/profile.png')}}" class="prof-img" alt="" id="img">
      </div>
    @endisset

    {!!Form::open(['route'=>'patient_image_profile','method'=>'POST','files'=>true])!!}
    {!!Form::hidden('email',$patient->email)!!}
    {!!Form::hidden('patient_id',$patient->id)!!}
    <input type="file" name="image" value="">

    {!!Form::submit('Subir')!!}
    {!!Form::close()!!}
  </div>
  {{-- <div class="col-lg-5 col-12">
    <label for="">Barra de progreso</label>
    <div class="progress">
      <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%; vertical-align: center;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div> --}}
</div>
<hr>

<div class="m-2">
  <div class="row my-2">
    <div class="col-12">
      <h4 class="font-title-blue text-center">Datos personales:</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <ul>
        <li><b>Nombres</b>:{{$patient->name}}</li>
        <li><b>Apellidos</b>:{{$patient->lastName}}</li>
        <li><b>Cedula</b>:{{$patient->identification}}</li>
        <li><b>Sexo</b>:{{$patient->gender}}</li>

      </ul>
    </div>
    <div class="col-6">
      <ul>
        <li><b>Telefono 1:</b>{{$patient->phone1}}</li>
        <li><b>Telefono 2:</b>{{$patient->phone2}}</li>
        <li><b>Edad:</b>{{$patient->birthdate}}</li>
        <li><b>Edad:</b>{{$patient->age}}</li>
      </ul>
        <a href="{{route('patient_edit_data',$patient->id)}}" class="btn btn-block btn-success">Editar</a>
    </div>
  </div>
</div>
<hr>
<div class="row my-4">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Dirección</h4>
  </div>
</div>
<div class="row text-left">
  <div class="col-6">
    <ul>
      <li><strong>Pais:</strong> {{$patient->country}}</li>
      <li><strong>Estado:</strong> {{$patient->state}}</li>
      <li><strong>Ciudad:</strong> {{$patient->city}}</li>
      <li><strong>Codigo Postal:</strong> {{$patient->postal_code}}</li>
    </ul>
  </div>
  <div class="col-6">
    <ul>
      <li><strong>Colonia:</strong>
        {{$patient->colony}}
      </li>
      <li><strong>Calle/av:</strong>{{$patient->street}}</li>
      <li><strong>Numero Externo:</strong> {{$patient->number_ext}}</li>
      <li><strong>Numero Interno:</strong> {{$patient->number_int}}</li>
    </ul>

    <a href="{{route('address_patient',$patient->id)}}" class="btn btn-block btn-success">Editar</a>
  </div>
</div>
<hr>
{{-- section mapa --}}

</div>
</div>
</div>
</div>

</section>

{{-- //////////////////Modals///////////////////////////////////////MODALS//////////////// --}}




<!-- Modal add experience-->
<div class="modal fade" id="modal-experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_experience" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_experience"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agrega el nombre del trastorno o enfermedad, en la que tengas mas experiencia.</h4>
     </div>

     <div class="col-12 mt-3">


      {!!Form::text('name',null,['class'=>'form-control','id'=>'name_experience'])!!}
      {!!Form::hidden('patient_id',$patient->id,['class'=>'form-control','id'=>'patient_id'])!!}

    </div>

  </div>
  <div class="row mt-3">
    <div class="col-12">

      <button onclick="service_patient_experience()" name="button" class="btn btn-block btn-primary">Agregar</button>
    </div>
  </div>
</div>
</div>
</div>
</div>



@endsection

@section('scriptJS')

@endsection
