@extends('layouts.app')
@section('css')
    <style media="screen">
        .form-control{
            border-color: red;
        }
    </style>
@endsection
@section('content')
    <section class="box-register">
        <div class="container">
            <div class="register">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h2 class="text-center font-title">Crear Nuevo Asistente</h2>
                    </div>
                </div>
                {!!Form::open(['route'=>'assistant.store','method'=>'POST'])!!}
                <input type="hidden" name="medico_id" value="{{$medico->id}}">
                <div class="row mt-4">
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            {!!Form::number('identification',null,['class'=>'form-control','placeholder'=>'Cedula'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'nombre'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Apellido'])!!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!!Form::number('phone1',null,['class'=>'form-control','placeholder'=>'Telefono 1'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {!!Form::number('phone2',null,['class'=>'form-control','placeholder'=>'Telefono 2','style'=>'border-color:black'])!!}
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-6 col-12 mt-2">
                    <a href="{{route('medico_assistant_create',\Hashids::encode($medico->id))}}" class="btn-config-blue btn btn-block">Limpiar</a>
                </div>
                <div class="col-lg-6 col-12 mt-2">

                    <button type="submit" class="btn-config-green btn btn-block">Registrar</button>

                </div>
            </div>
            <div class="row">

                {!!Form::close()!!}
            </div>
        </div>
    </section>
@endsection
