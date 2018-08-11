
@extends('layouts.app')

@section('content')
    <section class="box-register">

        <div class="container">
            <div class="register">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h2 class="text-center font-title">Asistentes</h2>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{route('panel_control_administrator')}}" class="btn btn-secondary float-right">Atras</a>
                    </div>
                </div>

                @if($assistants->first() != Null)
                    <div class="row">
                        <table class="table table-responsive table-config table-bordered">
                            <thead class="thead-color">
                                <tr>

                                    <th class="text-center">Fecha de Alta</th>
                                    <th class="text-center">cedula</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Apellido</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Médicos al que asiste</th>
                                    <th class="text-center">Teléfonos</th>

                                    <th>perfil</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($assistants as $assistant)
                                    <tr>

                                        <td class="text-center">{{$assistant->created_at->format('d-m-Y')}}</td>
                                        <td class="text-center">{{$assistant->identification}}</td>

                                        <td class="text-center">{{$assistant->name}} </td>
                                        <td class="text-center">{{$assistant->lastName}} </td>
                                        {{-- <td class="text-center">{{$assistant->lastName}}</td> --}}
                                        <td class="text-center">{{$assistant->email}}</td>
                                        <td>
                                            <ul>
                                                @foreach ($assistant->medico_assistant as $value)
                                                    <li>{{$value->medico->nameComplete}} id:{{$value->medico->identification}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{$assistant->phone1}}</li>
                                                <li>{{$assistant->phone2}}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{route('assistant.edit',$assistant->id)}}" class="btn btn-primary btn-sm">Perfil</a>
                                        </td>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">{{ $assistants->links() }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="card mt-5 text-center">
                            <div class="card-body">
                                <h5 class="font-title-blue">No Ahi Asistentes registrados</h5>

                        </div>
                    </div>
                @endif
                </div>
            </div>
        </section>


    @endsection
