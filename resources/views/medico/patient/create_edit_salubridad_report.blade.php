@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.css')}}">
@endsection
@section('content')
<section class="container">
    <div class="">

  <div class="row">
    <div class="col-12 mb-3">
      <h3 class="text-center font-title">Reporte de Salubridad del Paciente: {{$patient->nameComplete}}</h3>



          <div class="card mt-5">
              <div class="card-header">
                   <label for="">@if(isset($salubridad_report->diagnostic)) Editar @endif Diagnostico del Paciente: {{$patient->nameComplete}} para reporte de salubridad</label>
              </div>
              <div class="card-body">

                  {{Form::open(['route'=>'salubridad_reports_store_edit','method'=>'POST'])}}
                  <input type="hidden" name="medico_id" value="{{request()->m_id}}">
                  <input type="hidden" name="patient_id" value="{{request()->p_id}}">

                  @if(isset($salubridad_report->diagnostic) and $salubridad_report->diagnostic != Null)
                      {{Form::textarea('diagnostic',$salubridad_report->diagnostic,['class'=>'form-control','style'=>'height:80px','id'=>'diagnostic'])}}

                  @else
                      {{Form::textarea('diagnostic',null,['class'=>'form-control','style'=>'height:80px','id'=>'diagnostic'])}}


                  @endif
                   <a href="{{route('manage_patient',['m_id'=>\Hashids::encode(request()->m_id),'p_id'=>\Hashids::encode(request()->p_id)])}}" class="btn btn-secondary mt-2">Cancelar</a>
                  @if(isset($salubridad_report->diagnostic)) <button type="submit" name="button" class="btn btn-primary mt-2">Guardar Cambios</button> @else <button type="submit" name="button" class="btn btn-primary mt-2">Guardar</button> @endif
                  {{Form::close()}}
              </div>
          </div>


      <div class="my-5 text-center">
          <h5>Ultimos Reportes realizados</h5>
      </div>

      @if($salubridad_report_all->first() == Null)
          <div class="card">
              <div class="card-body text-center">
                  No ahi reportes registrados
              </div>
          </div>
      @else
          <a href="{{route('salubridad_reports',['m_id'=>Hashids::encode(request()->m_id),'patient_id'=>Hashids::encode(request()->p_id)])}}" class="btn btn-primary mb-1 float-right">ver todos los reportes</a>
          <table class="table">
              <thead>
                  <th>Cédula</th>
                  <th>Nombre Completo</th>
                  <th>Diagnostico</th>
                  <th>Edad</th>
                  <th>Género</th>
                  <th>Ciudad</th>
                  <th>Estado</th>
                  <th>Pais</th>
                  <th>Fecha de Reporte</th>
              </thead>
            <tbody>

                @foreach ($salubridad_report_all as $patient)
                    <tr>
                        <td>{{$patient->identification}}</td>
                        <td>{{$patient->nameComplete}}</td>
                        <td>{{$patient->diagnostic}}</td>
                        <td>{{$patient->age}}</td>
                        <td>{{$patient->gender}}</td>
                        <td>{{$patient->city}}</td>
                        <td>{{$patient->state}}</td>
                        <td>{{$patient->country}}</td>
                        <td>{{$patient->created_at}}</td>
                    </tr>
                @endforeach

            </tbody>
          </table>
    @endif

    </div>
  </div>

</div>
</section>
@endsection

@section('scriptJS')
    <script src="{{asset('jqueryui/jquery-ui.js')}}"></script>
    <script type="text/javascript">

    $(function()
    {
      $("#diagnostic").autocomplete({
        source: "{{route('autocomplete_diagnostic')}}",
        minLength: 2,
        select: function(event, ui) {
          $('#q').val(ui.item.value);
        }
      });
    });

    </script>
@endsection
