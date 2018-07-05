{{-- /////////////////////////////////////////////////////////////// --}}

{{-- //NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA U//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDO//NO SE ESTA UTILIZANDOTILIZANDO --}}



<h4 class="font-title-blue">Datos del paciente</h4>
<div class="row">

  <div class="col-lg-6 col-sm-6 col-12">
    <ul>
      <li><b>Nombres</b>:{{$patient->name}}</li>
      <li><b>Apellidos</b>:{{$patient->lastName}}</li>
      <li><b>Cedula</b>:{{$patient->identification}}</li>
      <li><b>Sexo</b>:{{$patient->gender}}</li>
    </ul>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <ul>
      @isset($patient->phone1)
      <li><b>Telefono 1:</b>{{$patient->phone1}}</li>
      @endisset
      @isset($patient->phone2)
      <li><b>Telefono 2:</b>{{$patient->phone2}}</li>
      @endisset
      <li><b>Edad:</b>{{$patient->birthdate}}</li>
      <li><b>Edad:</b>{{$patient->age}}</li>
    </ul>
  </div>
</div>
<div class="row text-left">
  <div class="col-lg-6 col-sm-6 col-12">
    <ul>
      <li><strong>Pais:</strong> {{$patient->country}}</li>
      <li><strong>Estado:</strong> {{$patient->state}}</li>
      <li><strong>Ciudad:</strong> {{$patient->city}}</li>
      <li><strong>Codigo Postal:</strong> {{$patient->postal_code}}</li>
    </ul>
  </div>
  <div class="col-lg-6 col-sm-6 col-12">
    <ul>
      <li><strong>Colonia:</strong>
        {{$patient->colony}}
      </li>
      <li><strong>Calle/av:</strong>{{$patient->street}}</li>
      <li><strong>Numero Externo:</strong> {{$patient->number_ext}}</li>
      <li><strong>Numero Interno:</strong> {{$patient->number_int}}</li>
    </ul>

  </div>
</div>
<hr>
{{-- /////////////////////////////<<<<<<<<<<<<<////////////////////////////<<<<<<<<<<<<<< --}}
