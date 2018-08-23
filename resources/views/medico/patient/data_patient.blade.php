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
                        <h2 class="text-center font-title">Datos del Paciente: {{$patient->name}} {{$patient->lastName}}</h2>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <h5 class="text-center font-title-blue">Datos Personales</h5>
                        <hr>
                    </div>
                </div>

                @if(isset($extract))
                    <div class="text-right my-2">

                        {{-- @if(isset(request()->expedient))
                        <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>$patient->id,'ex_id'=>request()->expedient])}}" class="btn btn-secondary mr-1">Atras</a>
                    @else
                    <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>$patient->id])}}" class="btn btn-secondary ml-1">atras</a>
                @endif --}}

            </div>
            <div class="alert alert-success">
                <p>Se han extraido los datos del perfil de la cuenta del paciente: {{$patient->nameComplete}}, es posible que estos datos esten desactualizados, depende del uso de la cuenta por parte del paciente, puede guardar los cambios, editarlos o presionar el boton cancelar para mantener la información antigua.<b>Modificar esta información no altera los datos de la cuenta Médicossi del paciente,el campo email, e identificación se mantienen para evitar confusiones, solo el paciente puede editar estos datos en su cuenta.</p>
                    <a href="{{route('data_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-outline-warning"><strong>Cancelar Extraccion</strong></a>
                </div>
            @else
                <div class="text-right my-2">
                    <a href="{{route('data_patient_extract_perfil',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-success">Extraer Datos del perfil del paciente</a>
                    @if(isset(request()->expedient))
                        <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'ex_id'=>request()->expedient])}}" class="btn btn-secondary mr-1">Atras</a>
                    @else
                        <a href="{{route('manage_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-secondary ml-1">atras</a>
                    @endif
                </div>

                <p style="color:rgb(156, 154, 151)">Estos son los Datos se mostraran en las cabeceras de las notas Médicas y expedientes, puede editarlos manualmente, o extraer la información del perfil del paciente.<b>Modificar esta información no altera los datos de la cuenta Médicossi del paciente,el campo email, e identificación se mantienen para evitar confusiones, solo el paciente puede editar estos datos en su cuenta.</b></p>
            @endif

            {!!Form::model($data_patient,['route'=>['data_patient_store'],'method'=>'POST'])!!}
            <div class="row">
                <div class="col-lg-6 col-12">
                    <label for="" class="font-title">Email</label>
                    <div class="form-group">
                        {!!Form::email('email',$patient->email,['class'=>'form-control','readonly'])!!}
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
                        {!!Form::text('identification',$patient->identification,['class'=>'form-control','readonly'])!!}
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
                <div class="col-lg-6 col-12 mt-2">
                    <a href="{{route('manage_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-secondary btn-block">Cancelar</a>

                </div>
                <div class="col-lg-6 col-12 mt-2">
                    @if(isset(request()->expedient))
                        <input type="hidden" name="expedient_id" value="{{request()->expedient}}">
                        <input type="submit" name="boton_submit" value="Guardar" class="btn btn-success btn-block">
                    @else
                        <input type="submit" name="boton_submit" value="guardar" class="btn btn-success btn-block">
                    @endif

                </div>
            </div>
            {{Form::hidden('medico_id',$medico->id)}}
            {{Form::hidden('patient_id',$patient->id)}}
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
