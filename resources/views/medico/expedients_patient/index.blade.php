@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">
<style media="screen">
.dropdown-menu {
  width: 430px !important;

}
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-12">
      <div class="register">
        <div class="row">
          <div class="col-12">
            <h3 class="text-center font-title">Expedientes de Paciente: <span>{{$patient->name }} {{$patient->lastName }}</span></h3>
          </div>
        </div>

        {{-- MENU DE PACIENTES --}}
        @include('medico.includes.main_medico_patients')

      </div>
      {{-- ////////////////////////////////////////////centro de menu////////////centro de menu// --}}

      {!!Form::model(request()->all(),['route'=>'expedient_search','method'=>'GET'])!!}
      <div class="form-inline p-2 my-3" style="border:solid 1px rgb(115, 115, 115)">
        <label for="">Buscar Por:</label>
        <input type="hidden" name="medico_id" value="{{$medico->id}}">
        <input type="hidden" name="patient_id" value="{{$patient->id}}">

        {!!Form::select('select',['Nombre'=>'Nombre','Fecha'=>' Fecha'],null,['class'=>'form-control ml-1','id'=>'select_input'])!!}

        {!!Form::text('search_name',null,['class'=>'form-control ml-1','placeholder'=>'busqueda por nombre','id'=>'search_name'])!!}

        {!!Form::date('search_date',null,['class'=>'form-control ml-1','placeholder'=>'busqueda por nombre','id'=>'search_date','style'=>'display:none'])!!}

        <button class="btn btn-primary ml-1" type="submit" name="button"><i class="fas fa-search"></i></button>
        <a href="{{route('expedients_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-info ml-1">Todos los expedientes</a>
      </div>
      {!!Form::close()!!}

      <div class="mb-3">
        <button class="btn btn-primary" onclick="create_exp()">Crear expediente</button>
      </div>



        {{-- <input type="hidden" name="" value="{{$name_exp = 'expediente Nro'$expedients->count() + 1}}"> --}}
        @if(Session::Has('creando'))
          <div class="card my-3" id="create_exp">
            <div class="card-header bg-primary text-white">
              Crear Expediente
              <button type="button" name="button" class="close" onclick="cerrar_exp()">x</button>
            </div>
            <div class="card-body">
              {!!Form::open(['route'=>'expedient_store','method'=>'POST'])!!}
              {!!Form::hidden('medico_id',$medico->id)!!}
              {!!Form::hidden('patient_id',$patient->id)!!}
        			<div class="row">
        				<div class="col-lg-4 col-12">
        					<div class="form-group">
                    <label for=""  class="font-title">Nombre</label>
        						{!!Form::text('name',null,['class'=>'form-control'])!!}
        					</div>
        				</div>
        				<div class="col-lg-4 col-12">
        					<div class="form-group">
                    <label for="" class="font-title">Fecha de Creación</label>
        						{!!Form::date('date_start',\carbon\carbon::now(),['class'=>'form-control'])!!}
        					</div>
        				</div>
                <div class="col-lg-4 col-12">
                  <div class="form-group">

                    <button type="submit" name="button" class="btn btn-success" style="margin-top:35px">Crear</button>
                    <button type="button" name="button" class="btn btn-secondary" style="margin-top:35px" onclick="cerrar_exp()">Cancelar</button>

                  </div>
                </div>
        			</div>
              {!!Form::close()!!}

            </div>
          </div>
        @else
          <div class="card my-3" id="create_exp" style="display:none">
            <div class="card-header bg-primary text-white">
              Crear Expediente <button type="button" name="button" class="close" onclick="cerrar_exp()">x</button>
            </div>
            <div class="card-body">
              {!!Form::open(['route'=>'expedient_store','method'=>'POST'])!!}
              {!!Form::hidden('creando',null)!!}
              {!!Form::hidden('medico_id',$medico->id)!!}
              {!!Form::hidden('patient_id',$patient->id)!!}
        			<div class="row">
        				<div class="col-lg-4 col-12">
        					<div class="form-group">
                    <label for=""  class="font-title">Nombre</label>
        						{!!Form::text('name',null,['class'=>'form-control'])!!}
        					</div>
        				</div>
        				<div class="col-lg-4 col-12">
        					<div class="form-group">
                    <label for="" class="font-title">Fecha de Creación</label>
        						{!!Form::date('date_start',\carbon\carbon::now(),['class'=>'form-control'])!!}
        					</div>
        				</div>
                <div class="col-lg-4 col-12">
                  <div class="form-group">

                    <button type="submit" name="button" class="btn btn-success" style="margin-top:35px">Crear</button>
                    <button type="button" name="button" class="btn btn-secondary" style="margin-top:35px" onclick="cerrar_exp()">Cancelar</button>

                  </div>
                </div>
        			</div>
              {!!Form::close()!!}

            </div>
          </div>
        @endif



      @if($expedients->first() != Null and !isset($search))

        <table class="table table-bordered">
          <thead>
              <td>Nombre</td>
              <td>Creación</td>

              <td>Acciones</td>
          </thead>
          <tbody>
            @foreach ($expedients as $expedient)
            <tr>
              <td><span class="pre">{{$expedient->name}}</span>
                <form class="" action="{{route('expedient_update',\Hashids::encode($patient->id))}}" method="post">
                  {{csrf_field()}}

                <div class="input-group" style="display:none">
                    <input name="name_exp" type="text" value="{{$expedient->name}}" class="form-control inp">
                  <div class="input-group-append">
                    <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="fas fa-save"></i></button>
                      <button class="cancel_edit" type="button" name="button" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                </form>


               </td>
              <td>{{\Carbon\Carbon::parse($expedient->created_at)->format('d-m-Y')}}</td>
              {{-- <td>{{$expedient->date_edit}}</td> --}}
              <td>
                <div class="form-inline">

                  <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'ex_id'=>\Hashids::encode($expedient->id)])}}" class="btn btn-success mr-1"><i class="fas fa-folder-open"></i></a>

                  <a class="btn btn-warning mr-1 editar text-white"><i class="fas fa-edit"></i></a>
                  <a href="{{route('expedient_delete',\Hashids::encode($expedient->id))}}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                </div>

              </td>

            </tr>
              @endforeach
          </tbody>
        </table>
          <div class="">
          {{$expedients->appends(Request::all())->links()}}
          </div>



      @elseif($expedients->first() != Null and isset($search))

        <table class="table table-bordered">
          <thead>
              <td>Nombre</td>
              <td>Creación</td>
              <td>ultima Edicion</td>
              <td>Acciones</td>
          </thead>
          <tbody>
            @foreach ($expedients as $expedient)
            <tr>
              <td><span class="pre">{{$expedient->name}}</span>
                <form class="" action="{{route('expedient_update',\Hashids::encode($patient->id))}}" method="post">
                  {{csrf_field()}}

                <div class="input-group" style="display:none">
                    <input name="name_exp" type="text" value="{{$expedient->name}}" class="form-control inp">
                  <div class="input-group-append">
                    <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="fas fa-save"></i></button>
                      <button class="cancel_edit" type="button" name="button" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                </form>


               </td>
              <td>{{\Carbon\Carbon::parse($expedient->created_at)->format('d-m-Y')}}</td>
              <td>{{$expedient->date_edit}}</td>
              <td>
                <div class="form-inline">

                  <a href="{{route('expedient_open',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'ex_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-success mr-1"><i class="fas fa-folder-open"></i></a>

                  <a class="btn btn-warning mr-1 editar text-white"><i class="fas fa-edit"></i></a>
                  <a href="{{route('expedient_delete',\Hashids::encode($patient->id))}}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                </div>

              </td>

            </tr>
              @endforeach
          </tbody>
        </table>
          <div class="">
          {{$expedients->appends(Request::all())->links()}}
          </div>
        @elseif($expedients->first() == Null and isset($search))
          <div class="card">
            <div class="card-body">
              <h5 class="font-title-blue text-center">No se encontraron resultados para la Busqueda</h5>
            </div>
          </div>
      @elseif($expedients->first() == Null)
        <div class="card">
          <div class="card-body">
            <h5 class="font-title-blue text-center">No ahi registro de Expedientes</h5>
          </div>
        </div>
      @endif
      {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
    </div>

    {{-- <div class="col-12 col-sm-6 m-sm-auto col-lg-3 bg-primary">


    </div> --}}

  </div>
</div>
</div>

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
{{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
<script type="text/javascript">
  function create_exp(){

    $('#create_exp').fadeIn();
  }

  function cerrar_exp(){
    $('#create_exp').fadeOut();
  }

  $('.editar').click(function(){
              variable = $(this).parents("tr").find("td").eq(0).html();
              $(this).parents("tr").find("td").find('.pre').hide();
              $(this).parents("tr").find("td").find('.input-group').show();
  });

  $('.cancel_edit').click(function(){
              $(this).parents("tr").find("td").find('.pre').show();
              $(this).parents("tr").find("td").find('.input-group').hide();
  });

  $(document).ready(function(){
    if($('#select_input').val() == 'Fecha'){
      $('#search_name').hide();
      $('#search_date').show();
    }

  });

  $('#select_input').change(function(){

    if($('#select_input').val() == 'Fecha'){
      $('#search_name').hide();
      $('#search_date').show();
    }else{
      $('#search_date').hide();
      $('#search_name').show();
    }
  });

</script>


    @endsection
