@extends('layouts.app')

@section('css')
    <style media="screen">


</style>
@endsection
@section('content')


    <section>
        <div class="register">

            <div class="row">
                <div class="col-12 mb-3">
                    <h2 class="text-center font-title">Archivos de Paciente: {{$patient->nameComplete}}</h2>
                </div>
            </div>

            {{-- @include('medico.includes.main_medico_patients') --}}

            <button onclick="show()" type="button" name="button" class="btn btn-primary mt-3">Subir Archivo</button>

            @if($errors->any() or Session::has('warning'))

                <div class="card mt-4" style="max-width:400px" style="" id="div_upload">
                    <div class="card-header bg-primary text-white">
                        Subir Archivo o Imagen
                        <button type="button" name="button" class="btn close" onclick="$(this).parent('.card-header').parent('.card').hide()">x</button>

                    </div>
                    <div class="card-body">

                            {{Form::open(['route'=>'patient_file_store','method'=>'POST','files'=>true])}}
                            {{Form::hidden('patient_id',$patient->id)}}
                            {{Form::hidden('medico_id',$medico->id)}}
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Archivo (Opcional)'])}}
                            {{Form::text('description',null,['class'=>'form-control mt-2','placeholder'=>'Descripción (Opcional)'])}}

                            <label for="">
                            {{Form::file('archivo',['class'=>'mt-3'])}}
                            </label>

                            <div class="mt-3">
                                <button type="submit" name="button" class="btn btn-primary"><i class="fas fa-upload"></i> subir</button>
                            </div>

                            {{Form::close()}}


                    </div>
                </div>
            @else

                <div class="card mt-4" style="max-width:400px;display:none" id="div_upload">
                    <div class="card-header bg-primary text-white">
                        Subir Archivo o Imagen
                        <button type="button" name="button" class="btn close" onclick="$(this).parent('.card-header').parent('.card').hide()">x</button>
                    </div>
                    <div class="card-body">

                            {{Form::open(['route'=>'patient_file_store','method'=>'POST','files'=>true])}}
                            {{Form::hidden('patient_id',$patient->id)}}
                            {{Form::hidden('medico_id',$medico->id)}}
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Archivo (Opcional)'])}}
                            {{Form::text('description',null,['class'=>'form-control mt-2','placeholder'=>'Descripción (Opcional)'])}}

                            <label for="">
                            {{Form::file('archivo',['class'=>'mt-3'])}}
                            </label>

                            <div class="mt-3">
                                <button type="submit" name="button" class="btn btn-primary"><i class="fas fa-upload"></i> subir</button>

                            </div>

                            {{Form::close()}}


                    </div>
                </div>
            @endif



            <div class="text-center mt-5">
                <h4 class="text-primary">Archivos Subidos</h4>
            </div>
            <div class="mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                        <th>Vista Previa:</th>
                        <th>
                            Nombre:
                        </th>
                        <th>
                            Descripción:
                        </th>
                        <th>
                            tipo (extension):
                        </th>
                        <th>
                            tamaño:
                        </th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>

                        @foreach ($files as $value)
                            <tr>
                                <td>
                                    @if($value->extension != 'jpg' and $value->extension != 'jpeg' and $value->extension != 'gif' and $value->extension != 'png')
                                        <img src="{{asset('img/archivo_de_texto.jpg')}}" alt="" width="80px">
                                    @else
                                        <img src="{{asset($value->path)}}" alt="" width="80px">
                                    @endif



                                </td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->extension}}</td>
                                <td>{{$value->size}}</td>
                                <td>
                                    <a onclick="return confirm('¿Esta seguro de elimianr este archivo?')" href="{{route('file_delete',Hashids::encode($value->id))}}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>

                                    <a onclick="" href="{{route('file_download',Hashids::encode($value->id))}}" class="btn btn-info btn-sm"><i class="fas fa-download"></i></a>




                                </td>
                                {{-- <td>{{$value->upload_for}}</td> --}}
                            </tr>
                        @endforeach

                    </tbody>
                    <thead>
                        <tr>
                            <td colspan="6">{!!$files->links()!!}</td>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </section>
@endsection

@section('scriptJS')
    <script type="text/javascript">
        function show(){
            $('#div_upload').fadeIn();
        }
    </script>
@endsection
