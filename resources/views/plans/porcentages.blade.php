@extends('layouts.app')

@section('content')
    <section class="box-register">

        <div class="container">
            <div class="register">
                <div class="row">
                    <div class="col-12 mb-5">
                        <h2 class="text-center font-title">Procentajes de comision de Planes para los Promotores</h2>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 text-right">
                        <a href="{{route('plans.index')}}" class="btn btn-success">Precio planes</a>
                        <a class="btn btn-secondary" href="{{route('home')}}">Inicio</a>
                    </div>
                    <div class="col-12 mt-3">
                        <p class="text-secondary text-center">Al seleccionar un porcentaje este se calcula de acuerdo a los precios añadido a cada plan segun su periodo de tiempo en el panel "Precios planes", tambien es posible añadir la comisión de forma manual. <strong>Recuerde presionar el boton guardar para mantener los cambios.</strong></p>

                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-12 mb-5">
                        <h3>Planes para Medicos y Especialistas</h3>
                    </div>

                    <table class="table table-responsive table-config table-bordered">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" colspan="3"></th>
                                <th class="text-center" colspan="3">Precio</th>

                            </tr>
                            <tr>

                                <th class="text-center">Nombre</th>
                                <th class="text-center">Aplicable a</th>
                                <th>% Comisión</th>

                                <th class="text-center">Mensual</th>
                                <th class="text-center">6 meses</th>
                                <th class="text-center">Anual</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($plans1 as $plan)
                                @if($plan->name != 'Plan Basico')
                                <tr>
                                    <td>{{$plan->name}}</td>
                                    <td class="text-center">{{$plan->applicable}}</td>
                                    {!!Form::open(['route'=>'porcentage_store','method'=>'POST'])!!}
                                    <td>
                                        <div class="input-group">
                                            <div class="form-inline">

                                                <input type="text" class="form-control ml-2 mr-2" name="porcentage" value="{{$plan->porcentage}}" class="porcentage1">

                                                <button class="porcentage_apply" type="button" name="button" class="btn btn-warning">%</button>
                                            </div>
                                        </div>
                                        <td class="text-center">
                                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                            <div class="input-group">
                                                <div class="form-inline">

                                                    <input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2 procentage_price1" name="porcentage_price1" value="{{$plan->porcentage_price1}}">



                                                    <input type="hidden" name="" value="{{$plan->price1}}" class="price1">
                                                    <input type="hidden" name="" value="{{$plan->price2}}" class="price2">
                                                    <input type="hidden" name="" value="{{$plan->price3}}" class="price3">
                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                            <div class="input-group">
                                                <div class="form-inline">


                                                    <input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2 procentage_price2" name="porcentage_price2" value="{{$plan->porcentage_price2}}">

                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                            <div class="input-group">
                                                <div class="form-inline">



                                                    <input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2 procentage_price3" name="porcentage_price3" value="{{$plan->porcentage_price3}}">
                                                    <button class="btn btn-config-blue" data-toggle="tooltip" data-placement="top" title="Guardar precio" type="submit"><i class="fas fa-save"></i></button>


                                                </div>
                                            </div>

                                        </td>
                                        {!!Form::close()!!}
                                    @endif
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>

                                    </tr>
                                </tfoot>
                            </table>

                            <div class="col-12 mb-5">
                                <h3>Planes para Medicina Alternativa, Psicologos y Terapeutas</h3>
                            </div>

                            <table class="table table-responsive table-config table-bordered">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th class="text-center" colspan="3"></th>
                                        <th class="text-center" colspan="3">Precio</th>

                                    </tr>
                                    <tr>

                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Aplicable a</th>
                                        <th>% Comisión</th>

                                        <th class="text-center">Mensual</th>
                                        <th class="text-center">6 meses</th>
                                        <th class="text-center">Anual</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($plans2 as $plan)
                                        @if($plan->name != 'Plan Basico')
                                        <tr>
                                            <td>{{$plan->name}}</td>
                                            <td class="text-center">{{$plan->applicable}}</td>
                                            {!!Form::open(['route'=>'porcentage_store','method'=>'POST'])!!}
                                            <td>
                                                <div class="input-group">
                                                    <div class="form-inline">

                                                        <input type="text" class="form-control ml-2 mr-2" name="porcentage" value="{{$plan->porcentage}}" class="porcentage1">

                                                        <button class="porcentage_apply" type="button" name="button" class="btn btn-warning">%</button>
                                                    </div>
                                                </div>
                                                <td class="text-center">
                                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                                    <div class="input-group">
                                                        <div class="form-inline">

                                                            <input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2 procentage_price1" name="porcentage_price1" value="{{$plan->porcentage_price1}}">



                                                            <input type="hidden" name="" value="{{$plan->price1}}" class="price1">
                                                            <input type="hidden" name="" value="{{$plan->price2}}" class="price2">
                                                            <input type="hidden" name="" value="{{$plan->price3}}" class="price3">
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="text-center">
                                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                                    <div class="input-group">
                                                        <div class="form-inline">


                                                            <input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2 procentage_price2" name="porcentage_price2" value="{{$plan->porcentage_price2}}">

                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="text-center">
                                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                                    <div class="input-group">
                                                        <div class="form-inline">



                                                            <input onFocus="mostrar('{{$plan->id}}')" type="text" class="form-control ml-2 mr-2 procentage_price3" name="porcentage_price3" value="{{$plan->porcentage_price3}}">
                                                            <button class="btn btn-config-blue" data-toggle="tooltip" data-placement="top" title="Guardar precio" type="submit"><i class="fas fa-save"></i></button>


                                                        </div>
                                                    </div>

                                                </td>
                                                {!!Form::close()!!}
                                            @endif
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>

                                            </tr>
                                        </tfoot>
                                    </table>

                                    </div>

                                </div>
                            </div>
                        </section>

                        {{-- modal-price edit --}}



                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Precio plan: <span id="namePlan"></span></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!!Form::open(['route'=>'assistant.store','method'=>'POST'])!!}
                                        <label for="">Precio de <span id="namePlan"></span></label>
                                        {!!Form::number('price',null,['class'=>'form-control','id'=>'price'])!!}

                                        {!!Form::hidden('plan_id',null,['class'=>'form-control','placeholder'=>'Apellido','id'=>'plan_id'])!!}

                                        {!!Form::submit('Establecer Precio',['class'=>'btn btn-primary'])!!}
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        {!!Form::close()!!}
                                    </div>
                                    <div class="modal-footer">


                                    </div>
                                </div>
                            </div>
                        </div>

                    @endsection

                    @section('scriptJS')
                        <script type="text/javascript">

                        $('.porcentage_apply').click(function(){

                            porcentage = $(this).prev().val();

                            price1 = $(this).parents("tr").find("td").eq(3).find('.price1').val();
                            price2 = $(this).parents("tr").find("td").eq(3).find('.price2').val();
                            price3 = $(this).parents("tr").find("td").eq(3).find('.price3').val();
                            procentage_price1 = price1 * porcentage / 100;
                            procentage_price2 = price2 * porcentage / 100;
                            procentage_price3 = price3 * porcentage / 100;

                            $(this).parents("tr").find("td").eq(3).find('.procentage_price1').val(procentage_price1);
                            $(this).parents("tr").find("td").eq(4).find('.procentage_price2').val(procentage_price2);
                            $(this).parents("tr").find("td").eq(5).find('.procentage_price3').val(procentage_price3);


                        });

                        </script>
                    @endsection
