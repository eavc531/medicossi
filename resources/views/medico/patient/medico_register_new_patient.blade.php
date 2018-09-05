@extends('layouts.app')

@section('css')
  <style media="screen">
  .form-control{
    border-color:rgb(200, 38, 38);
  }

  </style>
@endsection
@section('content')

  <section class="box-register">

    <div class="container">

      <div class="register">
        <div class="row">
          <div class="col-12 mb-3">
            <h2 class="text-center font-title">Registrar Nuevo Paciente</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <h5 class="text-center text-azul">Datos Personales</h5>
            <hr>
          </div>
        </div>
        {!!Form::open(['route'=>['medico_store_new_patient',\Hashids::encode($medico->id)],'method'=>'POST'])!!}
          <div class="row">
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Email</label>
              <div class="form-group">
                  {!!Form::email('email',null,['class'=>'form-control'])!!}
              </div>
            </div>

            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Genero</label>
              <div class="form-group">
                  {!!Form::select('gender',['Masculino'=>'Masculino','Femenino'=>'Femenino'],null,['class'=>'form-control'])!!}
               </div>
            </div>
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Nombre</label>
              <div class="form-group">
                  {!!Form::text('name',null,['class'=>'form-control'])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Apellido</label>
              <div class="form-group">
                  {!!Form::text('lastName',null,['class'=>'form-control'])!!}
               </div>
            </div>
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Fecha de Nacimiento</label>
              <div class="form-group">
                  {!!Form::date('birthdate',null,['class'=>'form-control'])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Cedula</label>
              <div class="form-group">
                 {!!Form::text('identification',null,['class'=>'form-control',])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <label for="" class="font-title">Teléfono</label>
              <div class="form-group">
                  {!!Form::number('phone1',null,['class'=>'form-control'])!!}
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 mb-3">
              <h5 class="text-center font-title-blue">Dirección</h5>
              <hr>
            </div>
          </div>
            <div class="row">
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="" class="font-title">Pais</label>
                  {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="" class="font-title">Estado</label>
                  {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for=""  class="font-title">Colonia</label>
                  {{Form::text('colony',null,['class'=>'form-control'])}}
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="" class="font-title">Ciudad</label>
                  {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}
                </div>
              </div>
            </div>
            <div class= "row mt-2">
              <div class="col-lg-6 col-12">
                <div class="form-group">

                 <label for="[object Object]" class="font-title">Calle/Av (especifique)</label>
                 {{Form::text('street',null,['class'=>'form-control'])}}
               </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for=""  class="font-title">Codigo Postal</label>
                  {{Form::number('postal_code',null,['class'=>'form-control','style'=>'border-color:black'])}}
                </div>


             </div>
             <div class="col-lg-6 col-12">
              <div class="form-group">
                <label for="" class="font-title">Numero Externo (Opcional)</label>
                {{Form::text('number_ext',null,['class'=>'form-control','style'=>'border-color:black'])}}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                <label for="" class="font-title">Numero Interno (Opcional)</label>
                {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2','style'=>'border-color:black'])}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mt-2 text-right">
              <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn btn-green">Cancelar</a>
              {!!Form::submit('Registrar',['class'=>'btn btn-azul','onclick'=>'confirm(" Atencion es importante que agregue un correo real para el paciente,Al registrar un paciente se creara una cuenta Médicossi de forma automatica, que le permitira al paciente ver sus citas pendientes, agendar nuevas citas y calificar los servicios del Médico,¿Esta Seguro de haber ingresado los datos correctos?");loader();this.form.submit();'])!!}
            </div>
          </div>
          {{Form::hidden('medico_id',$medico->id)}}
        {!!Form::close()!!}
      </div>
    </div>
  </section>
@endsection

@section('scriptJS')
  <script type="text/javascript">

  /////////////////////////////

  $('#state').on('change', function() {

    state = $('#state').val();

    route = "{{route('inner_cities_select3')}}";
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'post',
      url: route,
      data:{name:state},
      success:function(result){
        console.log(result);
        $("#city").empty();
        $('#city').append($('<option>', {
         value: null,
         text: 'opciones'
       }));
        $.each(result,function(key, val){
         $('#city').append($('<option>', {
          value: val,
          text: val
        }));
       });
      },
      error:function(error){
        console.log(error);
      },
    });
  })

  </script>
@endsection
