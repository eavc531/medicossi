@extends('layouts.app')

@section('content')
<section class="section-dashboard">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <h3 class="font-title text-center">Editar Horario</h3>
      </div>
    <div class="col-lg col-12 text-right">
      <a class="btn btn-primary" href="{{route('medicalCenter.edit',\Hashids::encode(request()->id))}}">Atras</a>
    </div>
    </div>
    <div class="my-4 card p-3">
      <div class="form-inline">
        {!!Form::open(['route'=>['medical_center_store_schedule',\Hashids::encode($medicalCenter->id)],'method'=>'post'])!!}

        <label for="" class="font-title col-label-form">Agregar horas a dia:</label>
        {{Form::select('day',['lunes'=>'Lunes',
        'martes'=>'Martes',
        'miércoles'=>'Miércoles',
        'jueves'=>'Jueves',
        'viernes'=>'Viernes',
        'sabado'=>'Sabado',
        'domingo'=>'Domingo'],null,['class' => 'form-control my-2','placeholder'=>'Opciones'])}}
      </div>
      <div class="row my-4">
        <div class="col-lg-8 m-auto">
          <div class="row">
            <div class="col-5">
              <label class="font-title" for="[object Object]">Hora de inicio</label>
              <div class="form-inline">
                {!!Form::select('hour_start',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control mr-1','id'=>'hourEndUp'])!!}
                {!!Form::select('mins_start',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control mr-1','id'=>'minsEndUp'])!!}
              </div>

            </div>
            <div class="col-2">
              <label class="font-title" for="">A</label>
            </div>
            <div class="col-5">
              <label class="font-title" for="[object Object]">Hora Finalizacion</label>
              <div class="form-inline">
                {!!Form::select('hour_end',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control ml-1','id'=>'hourEndUp'])!!}
                {!!Form::select('mins_end',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control ml-1','id'=>'minsEndUp'])!!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
       <div class="col-6">
        <a href="{{route('medicalCenter.edit',\Hashids::encode($medicalCenter->id))}}" class="btn btn-primary btn-block">Cancelar</a>
      </div>
      <div class="col-6">
        <input type="submit" name="" value="Guardar" class="btn btn-success btn-block">
      </div>
    </div>
    {!!Form::close()!!}
  </div>
</div>
<div class=" mt-3">
  <table class="table table-bordered table-config table-responsive">
    <thead class="thead-color">
      <tr>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miercoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sabado</th>
        <th>Domingo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          @foreach ($lunes as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>

          </ul>
          @endforeach
        </td>
        <td>
          @foreach ($martes as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>

          </ul>
          @endforeach
        </td>
        <td>
          @foreach ($miercoles as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>

          </ul>
          @endforeach
        </td>
        <td>
          @foreach ($jueves as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>

          </ul>
          @endforeach
        </td>
        <td>
          @foreach ($viernes as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>

          </ul>
          @endforeach
        </td>
        <td>
          @foreach ($sabado as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>

          </ul>
          @endforeach
        </td>
        <td>
          @foreach ($domingo as $day)
          <ul style="list-style: none;">
            <li>
              {{$day->hour_ini}}
              a
              {{$day->hour_end}}
              <a href="{{route('medical_center_schedule_delete',\Hashids::encode($day->id))}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
            </li>
          </ul>
          @endforeach
        </td>
      </tr>
    </tbody>
    <tfoot>

    </tfoot>
  </table>
</div>
</div>
</div>
</div>
</section>

@endsection
