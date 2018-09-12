@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-12">
    <h2 class="font-title text-center">Perfil de Paciente</h2>
  </div>
</div>
<div class="col-12 text-center">
  <h3 class="text-azul subRayado"><span class="text-capitalize">{{$patient->name}} {{$patient->lastName}}</span></h3>
</div>
<div class="">
  @isset(request()->back)
  <div class="text-right">
    <a href="{{route('medico_patients',request()->back)}}" class="btn btn-green">atras</a>
  </div>
  @endisset
</div>
<section class="box-register">
  <div class="container">
    <div class="register">
      <div class="row">
      </div>
      <div class="row mt-3">
        @isset($photo->path)
        <div class="col-12">
          <div class="my-2 d-flex justify-content-center">
            {!!Form::open(['route'=>'patient_image_profile','method'=>'POST','files'=>true])!!}
            {!!Form::hidden('email',$patient->email)!!}
            {!!Form::hidden('patient_id',$patient->id)!!}
            <img id="preview0" src="{{asset($photo->path)}}" name="image" alt="equipo" class="imgPerfilPaciente"/>
            <input type="file" data-id="0" id="image0" name="image" class="hiddenbutton"/>
            <a id="botonCamara" class="cambiarFoto hiddenList" href="javascript:changeProfile(0);">
              <button type="button" class="btn btn-green cameraButton"><i class="fas fa-camera fa-2x"></i></button>
            </a>
            <br>
          </div>
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-azul">Guardar</button>
        </div>
        {!!Form::close()!!}
        @else
        <div class="col-12">
          <div class="my-2 d-flex justify-content-center">
            {!!Form::open(['route'=>'patient_image_profile','method'=>'POST','files'=>true])!!}
            {!!Form::hidden('email',$patient->email)!!}
            {!!Form::hidden('patient_id',$patient->id)!!}
            <img id="preview0" src="{{asset('img/profile.png')}}" name="image" alt="equipo" class="imgPerfilPaciente"/>
            @if(Auth::check() and  Auth::user()->role == 'Paciente' and Auth::user()->patient_id == $patient->id)
            <input type="file" data-id="0" id="image0" name="image" class="hiddenbutton"/>
            <a id="botonCamara" class="cambiarFoto hiddenList" href="javascript:changeProfile(0);">
              <button type="button" class="btn btn-green cameraButton"><i class="fas fa-camera fa-2x"></i></button>
            </a>
            @endif
            <br>
          </div>
        </div>
        @if(Auth::check() and  Auth::user()->role == 'Paciente' and Auth::user()->patient_id == $patient->id)
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-azul">Guardar</button>
        </div>
        @endif
        {!!Form::close()!!}
        @endisset
      </div>
      <hr>
      <div class="m-2">
        <div class="row my-2">
          <div class="col-12">
            <h4 class="font-title-blue text-center">Datos Personales</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <ul>
              <li class="text-capitalize"><b>Nombres</b>: {{$patient->name}}</li>
              <li class="text-capitalize"><b>Apellidos</b>: {{$patient->lastName}}</li>
              <li class="text-capitalize"><b>Cédula</b>: {{$patient->identification}}</li>
              <li class="text-capitalize"><b>Sexo</b>: {{$patient->gender}}</li>
            </ul>
          </div>
          <div class="col-6">
            <ul>
              <li class="text-capitalize"><b>Télefono 1:</b> {{$patient->phone1}}</li>
              <li class="text-capitalize"><b>Télefono 2:</b> @isset($patient->phone2){{$patient->phone2}}@else <span class="text-muted">No específica @endisset</span></li>
              <li class="text-capitalize"><b>Fecha de Nacimiento:</b> @isset($patient->birthdate) {{\Carbon\Carbon::parse($patient->birthdate)->format('m-d-Y')}}@else <span class="text-muted">No específica @endisset</li>
              <li class="text-capitalize"><b>Edad:</b> {{$patient->age}}</li>
            </ul>
          </div>
          <div class="col-12 text-right">
              @if(Auth::check() and  Auth::user()->role == 'Paciente' and Auth::user()->patient_id == $patient->id)
                  <a href="{{route('patient_edit_data',\Hashids::encode($patient->id))}}" class="btn btn-green ">Editar</a>
              @endif

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
            <li class="text-capitalize"><b>Pais:</b> @isset($patient->country){{$patient->country}}@else <span class="text-muted">No específica @endisset</li>
            <li class="text-capitalize"><b>Estado:</b> @isset($patient->state){{$patient->state}}@else <span class="text-muted">No específica @endisset</li>
            <li class="text-capitalize"><b>Ciudad:</b> @isset($patient->city){{$patient->city}}@else <span class="text-muted">No específica @endisset</li>
            <li class="text-capitalize"><b>Codigo Postal:</b> @isset($patient->postal_code){{$patient->postal_code}}@else <span class="text-muted">No específica @endisset</li>
          </ul>
        </div>
        <div class="col-6">
          <ul>
            <li class="text-capitalize"><b>Colonia:</b>
              @isset($patient->colony){{$patient->colony}}@else <span class="text-muted">No específica @endisset
              </li>
              <li class="text-capitalize"><b>Calle/av:</b> @isset($patient->street){{$patient->street}}@else <span class="text-muted">No específica @endisset</li>
              <li class="text-capitalize"><b>Número Externo:</b>  @isset($patient->number_ext){{$patient->number_ext}}@else <span class="text-muted">No específica @endisset</li>
              <li class="text-capitalize"><b>Número Interno:</b>  @isset($patient->number_int){{$patient->number_int}}@else <span class="text-muted">No específica @endisset</li>
            </ul>
          </div>
          <div class="col-12 text-right">
              @if(Auth::check() and  Auth::user()->role == 'Paciente' and Auth::user()->patient_id == $patient->id)
            <a href="{{route('patient_edit_data',\Hashids::encode($patient->id))}}" class="btn btn-green ">Editar</a>
             @endif
          </div>
        </div>
        <hr>
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
<script type="text/javascript">
// Subir Foto Perfil
function changeProfile(id) {
$('#image'+id).click();
$('#image'+id).change(function () {
var imgPath = this.value;
var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
readURL(this);
else
M.toast({html: "La imagen debe tener la siguiente extensiones: jpg, jpeg, png, gif."})
});
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.readAsDataURL(input.files[0]);
reader.onload = function (e) {
$('#preview'+id).attr('src', e.target.result);
$("#remove").val(0);
if(id != 0){
var file_data = input.files[0];
var formData = new FormData();
formData.append('image', file_data);
$.ajax({
type:'post',
url:'/api/Teams/image/'+id,
contentType: false,
processData: false,
data: formData,
success: function(data){
M.toast({html: data});
},
error: function (xhr, ajaxOptions, thrownError) {
console.log(xhr.status);
console.log(thrownError);
console.log(ajaxOptions);
}
});
}
};
}
}
}
</script>
@endsection
