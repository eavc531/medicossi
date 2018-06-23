@extends('layouts.app')
@section('css')
  <style media="screen">
    .form-control{
      border-color:rgb(200, 38, 38);
    }


  </style>
@endsection
@section('content')


  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12">
            @if ($medico->stateConfirm == 'medium')
              <h5 class="font-title-blue">Bienevenido: {{$medico->name}} {{$medico->lastName}}</h5>
              <p>Por Favor rellene los datos a continuación, requeridos para poder gestionar correctamente todas las funciones de nuestro  sistema.</p>
            @endif

        </div>
      </div>

      {!!Form::model($medico,['route'=>['medico.update',$medico],'method'=>'PUT','id'=>'person'])!!}

      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="" class="font-title">Nombres</label>
            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','id'=>'nameMedic'])!!}
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="" class="font-title">Apellidos</label>
            {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Apellido','id'=>'lastNameMedic'])!!}
          </div>
        </div>
      </div>
      <div class="row">

      	<div class="col-6">
      		<div class="form-group">
      			<label for="" class="font-title">Sexo</label>
      			{!!Form::select('gender',['Masculino'=>'Masculino','Femenino'=>'Femenino'],null,['class'=>'form-control','id'=>'genderMedic'])!!}
      		</div>
      	</div>
        <div class="col-lg-6">
         <div class="form-group">
          <label for="" class="font-title">Teléfono celular</label>
          {!!Form::number('phone',null,['class'=>'form-control','id'=>'phoneMedic'])!!}
        </div>
       </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="form-group">
           <label for="" class="font-title">Teléfono de Oficina 1 (Opcional)</label>
           {!!Form::number('phoneOffice1',null,['class'=>'form-control','id'=>'phoneOffice1Medic','style'=>'border-color:black'])!!}
         </div>
       </div>
       <div class="col-lg-6 col-12">
        <div class="form-group">
          <label for="" class="font-title">Teléfono de Oficina 2 (Opcional)</label>
          {!!Form::number('phoneOffice2',null,['class'=>'form-control','id'=>'phoneOffice2Medic','style'=>'border-color:black'])!!}
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="" class="font-title">Cedula</label>
            {!!Form::text('identification',null,['class'=>'form-control','id'=>'identificationMedic'])!!}
          </div>
        </div>
      	<div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="" class="font-title">Especialidad</label>
            {!!Form::select('specialty',$specialties,null,['placeholder'=>'seleccione una Especialidad','class'=>'form-control','id'=>'specialtyMedic'])!!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-12">
          {{-- <div class="form-group">
            <label for="" class="font-title">sub-Especialidad</label>
            {!!Form::select('sub_specialty',['sub-especialty1'=>'sub-especialty1','sub-especialty2'=>'sub-especialty2'],null,['placeholder'=>'seleccione una opción','class'=>'form-control','id'=>'sub_specialtyMedic'])!!}
          </div> --}}
        </div>

      </div>

      <hr>
      <div class="text-center mt-3">

        @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')

        @elseif(Auth::user()->medico->stateConfirm == 'complete' and Auth::user()->medico->plan != 'plan_profesional' and Auth::user()->medico->plan != 'plan_platino')
          <p style="color:rgb(127, 131, 128)">Selecciones disponibles para el plan Profesional o plan Platino activo</p>
        @endif

      </div>
    @if(Auth::user()->medico->stateConfirm == 'complete')
      <div class="row mt-3">
        <div class="col-12">
          <div class="form-group">
            <div class="row">
              <div class="col-8">
                <p for="">¿Desea que su teléfono celular aparezca visible en información a pacientes?</p>
              </div>
              <div class="col-4">

                @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
                  {{Form::select('showNumber',['si'=>'si','no'=>'no'],null,['class'=>'form-control','style'=>'border-color:black'])}}
                @else
                  {{Form::select('showNumber',['si'=>'si','no'=>'no'],null,['class'=>'form-control','disabled','style'=>'border-color:black'])}}
                @endif

             </div>
           </div>
         </div>
       </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <div class="row">
              <div class="col-8">
                <p for="">¿Desea que sus teléfonos de Oficina aparezcan visibles en información a pacientes?</p>
              </div>
              <div class="col-4">
                @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
                  {{Form::select('showNumberOffice',['si'=>'si','no'=>'no'],null,['class'=>'form-control','style'=>'border-color:black'])}}
                @else
                  {{Form::select('showNumberOffice',['si'=>'si','no'=>'no'],null,['class'=>'form-control','disabled','style'=>'border-color:black'])}}
                @endif

             </div>
           </div>
         </div>
       </div>
      </div>
    @endif
      <div class="row">
        <div class="col-lg-6 col-12">
          {{-- <button type="submit" name="button" class="btn btn-primary btn-block">Guardar Cambios</button>
          <button onclick="updateMedic()" type="button" name="button">test</button> --}}
        </div>
      </div>
      {{--/////////////////////// ALERTS --}}
      <div id="alert_error_update" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
      		<button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
      	<p id="text_error_medic"></p>
      </div>

      <div id="alert_success_update" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none">
       <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
       <p id="text_success_service"></p>
      </div>

      		 <div class="row">
             <div class="col-6">
               @if($medico->stateConfirm == 'complete')

                 <a href="{{route('medico.edit',$medico->id)}}" class="btn btn-primary btn-block">Cancelar</a>

               @endif
             </div>
      			 <div class="col-6">
      				 <button type="submit" name="button" class="btn btn-config-green btn-block">Guardar Cambios</button>
      			 </div>
      			 {!!Form::close()!!}
      	 </div>
      <hr>

    </div>
    </div>

@endsection
