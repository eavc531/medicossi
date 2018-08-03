@extends('layouts.app')

@section('content')



    <section class="box-register">
        <div class="container">
            <div class="col-12 mb-5">
                <h2 class="text-center font-title">Panel de Control</h2>
            </div>
            <div class="col-12 text-center mt-1">
                <h4 class="text-primary">Ultimo Mes</h4>
            </div>
            <div class="row mt-1">
                <div class="col-4 mt-4">
                    <div class="card" style="min-height:100px">
                        <div class="card-body">
                            <h5>Activaciones Planes: {{$activaciones_mes}} </h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="card" style="min-height:100px">
                        <div class="card-body">
                            <h5>Comisiones Generadas: {{$comisions_total}} MXN</h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="card" style="min-height:100px">
                        <div class="card-body">
                            <h5>Comisiones Recibidas: {{$comisions_recibidas}} MXN</h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="card" style="min-height:100px">
                        <div class="card-body">
                            <h5>Comisiones Pendientes: {{$comisions_pendientes}} MXN</h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="card" style="min-height:100px">
                        <div class="card-body">
                            <h5>Prospectos Visitados: {{$prospectos_visitados_totales}} </h5>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-4  mt-4">
                <div class="card" style="min-height:100px">
                <div class="card-body">
                <h5>Prospectos con Planes Activos: {{$activaciones_mes}} </h5>
            </div>
        </div>
    </div> --}}
</div>
<div class="col-12 text-center mt-3">
    <h4 class="text-primary">Hasta la fecha</h4>
</div>

<div class="row mt-1">
    <div class="col-4 mt-4">
        <div class="card" style="min-height:100px">
            <div class="card-body">
                <h5>Comisiones Totales: {{$comisions_total}} MXN</h5>
            </div>
        </div>
    </div>
    <div class="col-4 mt-4">
        <div class="card" style="min-height:100px">
            <div class="card-body">
                <h5>Comisiones Recibidas: {{$comisions_totales_recibidas}} MXN</h5>
            </div>
        </div>
    </div>
    <div class="col-4 mt-4">
        <div class="card" style="min-height:100px">
            <div class="card-body">
                <h5>Comisiones Pendientes: {{$comisions_totales_pendientes}} MXN</h5>
            </div>
        </div>
    </div>
    <div class="col-4 mt-4">
        <div class="card" style="min-height:100px">
            <div class="card-body">
                <h5>Prospectos Visitados: {{$prospectos_visitados}} </h5>
            </div>
        </div>
    </div>
    {{-- <div class="col-4  mt-4">
    <div class="card" style="min-height:100px">
    <div class="card-body">
    <h5>Prospectos con Planes Activos: {{$activaciones_mes}} </h5>
</div>
</div>
</div> --}}
</div>
<div class="row mt-5">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h5>Comisiones Recibidas por Mes</h5>
                <canvas id="myChart"></canvas>

            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h5>Comisiones Generadas por Mes</h5>
                <canvas id="myChart2"></canvas>

            </div>
        </div>
    </div>
</div>


<div class="col-12 text-center mt-5">
    <h3 class="">Tipos de Paquetes Colocados</h3>
</div>

<div class="card">
    <div class="card-header">
        Doctores y Especialistas
    </div>
    <div class="card-body row">
        <div class="col-4">
            <div class="card" style="min-height:110px">
                <div class="card-body">
                    <h3 class="mr-auto">{{$plan_mi_agenda_spcialties}}</h3>
                    Plan Mi Agenda
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="min-height:110px">
                <div class="card-body">
                    <h3 class="mr-auto">{{$plan_profesional_spcialties}}</h3>
                    Plan profesional
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="min-height:110px">
                <div class="card-body">
                    <h3 class="mr-auto">{{$plan_platino_spcialties}}</h3>
                    Plan Platino
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        Medicina Alternativa, Psicologos y Terapeutas
    </div>
    <div class="card-body row">
        <div class="col-4">
            <div class="card" style="min-height:110px">
                <div class="card-body">
                    <h3 class="mr-auto">{{$plan_mi_agenda}}</h3>
                    Plan Mi Agenda
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="min-height:110px">
                <div class="card-body">
                    <h3 class="mr-auto">{{$plan_profesional}}</h3>
                    Plan profesional
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="min-height:110px">
                <div class="card-body">
                    <h3 class="mr-auto">{{$plan_platino}}</h3>
                    Plan Platino
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</section>

<input type="hidden" name="" value="{{$ingresosgrafica['mes1']['name']}}" id="name_mes_1">
<input type="hidden" name="" value="{{$ingresosgrafica['mes1']['comision']}}" id="comision_mes_1">
<input type="hidden" name="" value="{{$ingresosgrafica['mes2']['name']}}" id="name_mes_2">
<input type="hidden" name="" value="{{$ingresosgrafica['mes2']['comision']}}" id="comision_mes_2">
<input type="hidden" name="" value="{{$ingresosgrafica['mes3']['name']}}" id="name_mes_3">
<input type="hidden" name="" value="{{$ingresosgrafica['mes3']['comision']}}" id="comision_mes_3">
<input type="hidden" name="" value="{{$ingresosgrafica['mes4']['name']}}" id="name_mes_4">
<input type="hidden" name="" value="{{$ingresosgrafica['mes4']['comision']}}" id="comision_mes_4">
<input type="hidden" name="" value="{{$ingresosgrafica['mes5']['name']}}" id="name_mes_5">
<input type="hidden" name="" value="{{$ingresosgrafica['mes5']['comision']}}" id="comision_mes_5">
<input type="hidden" name="" value="{{$ingresosgrafica['mes6']['name']}}" id="name_mes_6">
<input type="hidden" name="" value="{{$ingresosgrafica['mes6']['comision']}}" id="comision_mes_6">

<input type="hidden" name="" value="{{$ingresosgrafica['mes1']['comision_t']}}" id="comision_mes_t_1">
<input type="hidden" name="" value="{{$ingresosgrafica['mes2']['comision_t']}}" id="comision_mes_t_2">
<input type="hidden" name="" value="{{$ingresosgrafica['mes3']['comision_t']}}" id="comision_mes_t_3">
<input type="hidden" name="" value="{{$ingresosgrafica['mes4']['comision_t']}}" id="comision_mes_t_4">
<input type="hidden" name="" value="{{$ingresosgrafica['mes5']['comision_t']}}" id="comision_mes_t_5">
<input type="hidden" name="" value="{{$ingresosgrafica['mes6']['comision_t']}}" id="comision_mes_t_6">
@endsection
@section('scriptJS')
    <script src="{{asset('chart/Chart.min.js')}}"></script>
    <script type="text/javascript">

    $(document).ready(function(){

        name_mes_1 = $('#name_mes_1').val();
        comision_mes_1 = $('#comision_mes_1').val();
        name_mes_2 = $('#name_mes_2').val();
        comision_mes_2 = $('#comision_mes_2').val();
        name_mes_3 = $('#name_mes_3').val();
        comision_mes_3 = $('#comision_mes_3').val();
        name_mes_4 = $('#name_mes_4').val();
        comision_mes_4 = $('#comision_mes_4').val();
        name_mes_5 = $('#name_mes_5').val();
        comision_mes_5 = $('#comision_mes_5').val();
        name_mes_6 = $('#name_mes_6').val();
        comision_mes_6 = $('#comision_mes_6').val();



        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [name_mes_1, name_mes_2, name_mes_3, name_mes_4, name_mes_5, name_mes_6],
                datasets: [{
                    // label: color,
                    data: [comision_mes_1, comision_mes_2, comision_mes_3, comision_mes_4, comision_mes_5, comision_mes_6],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display:false
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        name_mes_t_1 = $('#name_mes_1').val();
        comision_mes_t_1 = $('#comision_mes_t_1').val();
        name_mes_t_2 = $('#name_mes_2').val();
        comision_mes_t_2 = $('#comision_mes_t_2').val();
        name_mes_t_3 = $('#name_mes_3').val();
        comision_mes_t_3 = $('#comision_mes_t_3').val();
        name_mes_t_4 = $('#name_mes_4').val();
        comision_mes_t_4 = $('#comision_mes_t_4').val();
        name_mes_t_5 = $('#name_mes_5').val();
        comision_mes_t_5 = $('#comision_mes_t_5').val();
        name_mes_t_6 = $('#name_mes_6').val();
        comision_mes_t_6 = $('#comision_mes_t_6').val();


        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [name_mes_1, name_mes_2, name_mes_3, name_mes_4, name_mes_5, name_mes_6],
                datasets: [{
                    // label: color,
                    data: [comision_mes_t_1, comision_mes_t_2, comision_mes_t_3, comision_mes_t_4, comision_mes_t_5, comision_mes_t_6],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display:false
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

    });



    </script>
@endsection
