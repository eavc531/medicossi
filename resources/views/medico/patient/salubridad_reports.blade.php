@extends('layouts.app')

@section('content')
<section class="container">
    <div class="">

  <div class="row">
    <div class="col-12 mb-3">
      <h3 class="text-center font-title">Reportes de Salubridad</h3>

      <div class="text-right">
          @isset(request()->patient_id)
              <a href="{{route('create_edit_salubridad_report',['m_id'=>Hashids::encode($medico->id),'patient_id'=>request()->patient_id])}}" class="btn btn-secondary mt-2">Atras</a>
          @endisset
      </div>

      <div class="card">
          <div class="card-body">
              {{Form::open(['route'=>['search_reports',Hashids::encode($medico->id)],'method'=>'GET'])}}
              <div class="form-inline">
                  {{-- <input type="hidden" name="medico_id" value="{{$medico->id}}"> --}}
                  <label for="">Mes:</label>{{Form::select('search_month',['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'],$month,['class'=>'form-control'])}}
                  <label for="">Año</label>
                  {{Form::number('search_year',$year,['class'=>'form-control','min'=>'2010','max'=>'2099'])}}

                  <button type="submit" name="button">Buscar</button>
              </div>
              {{Form::close()}}
          </div>
      </div>

      @if($salubridad_reports->first() == Null)
          <div class="card mt-5">
              <div class="card-body text-center">
                  No ahi reportes registrados
              </div>
          </div>
      @else

          {{Form::open(['route'=>['create_xml',Hashids::encode($medico->id)],'method'=>'GET'])}}
              <div class="form-inline">
                  <input type="hidden" name="medico_id_xml" value="{{$medico->id}}">
                  <input type="hidden" name="month_xml" value="{{$month}}">
                  <input type="hidden" name="year_xml" value="{{$year}}">
              </div>
          {{Form::close()}}

          <table class="table mt-5">
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
                @foreach ($salubridad_reports as $patient)
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
            <tfoot>
                <tr>
                    <td colspan="9">{{$salubridad_reports->appends(Request::all())->links()}}</td>
                </tr>
            </tfoot>
          </table>
    @endif

    </div>
  </div>

</div>
</section>
@endsection
