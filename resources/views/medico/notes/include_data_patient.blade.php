<div class="mt-5" style="margin-bottom:60px">

<div class="text-center">
  <h5 class="" style="text-align:center;">Datos del Paciente</h5>
</div>

<div class="row">
  <div class="col-6" style="width:50%;float:left">
    <div class=""><b>Nombre(s): </b>:{{$patient->name}}</div>
    <div class=""><b>Apellido(s): </b>:{{$patient->lastName}}</div>
    <div class=""><b>Cedula:</b>{{$patient->identification}}</div>
    <div class=""><b>Sexo: </b>:{{$patient->gender}}</div>
  </div>
  <div class="col-6" style="width:50%;float:right">
    <div class=""><b>Telefono 1: </b>{{$patient->phone1}}</div>
    <div class=""><b>Telefono 2: </b>{{$patient->phone2}}</div>
    <div class=""><b>Fecha de nacimiento: </b>{{$patient->birthdate}}</div>
    <div class=""><b>Edad: </b>{{$patient->age}}</div>
  </div>
</div>


<div class="">

  <div class="text-center">
    <h5 class="mt-3" style="text-align:center;">Dirección</h5>
  </div>
  <div class="row">
    <div class="col-6" style="width:50%;float:left">
      <div class=""><strong>Estado:</strong> {{$patient->state}}</div>
      <div class=""><strong>Ciudad:</strong> {{$patient->city}}</div>
      <div class=""><strong>Codigo Postal:</strong> {{$patient->postal_code}}</div>
      <div class=""><strong>Colonia:</strong>
        {{$patient->colony}}
      </div>
    </div>

    <div class="col-6" style="width:50%;float:right;">
      <div class=""><strong>Calle/av:</strong>{{$patient->street}}</div>
      <div class=""><strong>Numero Externo:</strong> {{$patient->number_ext}}</div>
      <div class=""><strong>Numero Interno:</strong> {{$patient->number_int}}</div>

    </div>
  </div>

</div>

</div>
