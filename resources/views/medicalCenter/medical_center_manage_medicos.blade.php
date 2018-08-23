@extends('layouts.app')

@section('content')
<section class="box-register">
    <div class="container-fluid">

      <div class="col-12">
        <h4 class="font-title-blue text-center mb-3">Profesionales de la salud</h4>
      </div>
      <div class="row mb-3">
        <div class="col-6 text-left">

        </div>
        <div class="col-6 text-right">
          <a class="btn btn-secondary" href="{{route('medicalCenter.edit',\Hashids::encode(request()->id))}}">Atras</a>
        </div>
      </div>

      <div class="row">


      <div class="col-6">
        {{Form::open(['route'=>['search_medico_belong_medical_center',\Hashids::encode(request()->id)],'method'=>'get'])}}
        <div class="form-inline">
          <label for="[object Object]">Buscar Médicos Agregados</label>
          <input class="form-control w-100 col-lg-10 col-12" type="search" placeholder="Cédula,nombre o apellido" aria-label="Buscar" name="search">

          <button class="btn btn-primary my-2 my-sm-2 col-lg-2 col-12" type="submit">Buscar</button>
        </div>
        {{Form::close()}}
      </div>


      <div class="col-6">
        {{Form::open(['route'=>['search_medico_medical_center',\Hashids::encode(request()->id)],'method'=>'get'])}}
        <div class="form-inline">
          <label for="[object Object]">Buscar Médicos no Agregados</label>
            <input class="form-control w-100 col-lg-10 col-12" type="search" placeholder="Cédula,nombre o apellido" aria-label="Buscar" name="search">

          <button class="btn btn-success my-2 my-sm-2 col-lg-2 col-12" type="submit">Buscar</button>
        </div>
        {{Form::close()}}
      </div>

        </div>
        {{-- BUSQUEDA DISTANCIA uLT --}}   {{-- BUSQUEDA DISTANCIA uLT --}}
        @if(isset($medicosSearchCount) and $medicosSearchCount != 0)

              <div class="card mt-4">

                <div class="card-header bg-success text-white">
                  <a href="{{route('medical_center_manage_medicos',\Hashids::encode(request()->id))}}" class="close text-right"><span aria-hidden="true">&times;</span></a>
                  <h5>Médicos no Registrados en este Centro Médico</h5>
                </div>
              <table class="table">
                <thead>
                  <tr>
                    <th>Cedula</th>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Especialidad</th>
                    <th>acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medicosSearch as $medico)
                    <tr>
                      <td>
                        {{$medico['identification']}}
                      </td>
                      <td>
                        {{$medico['name']}} {{$medico['lastName']}}
                      </td>
                      <td>
                          {{$medico['email']}}
                      </td>
                      <td>
                        {{$medico['phone']}}
                      </td>

                      <td>
                          {{$medico['specialty']}}
                      </td>
                      <td>

                        {{Form::open(['route'=>['medical_center_add_medico',\Hashids::encode(request()->id)],'method'=>'post'])}}
                          <input type="hidden" name="medico_id" value="{{$medico['id']}}">
                          <input type="hidden" name="medicalCenter_id" value="{{request()->id}}">
                          <button type="submit" name="button" class="btn btn-success">Agregar</button>
                          <a href="{{route("medico.edit",$medico['id'])}}" class="btn btn-primary">Perfil</a>
                        {{Form::close()}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <td colspan="4">{{$medicosSearch->appends(Request::all())->links()}}</td>
                  <td>
                    <a href="{{route('medical_center_manage_medicos',\Hashids::encode(request()->id))}}" class="btn btn-secondary">volver a medicos Agregados</a>
                  </td>
                </tfoot>
              </table>
              </div>
        @elseif(isset($medicosSearchCount))
          <div class="card">
            <div class="card-body">
              <h5>No se Encontraron Resultados para la Busqueda</h5>
              <a href="{{route('medical_center_manage_medicos',\Hashids::encode(request()->id))}}" class="close"><span aria-hidden="true">&times;</span></a>
            </div>
          </div>
        @endif

         @if($medicos->count() > 0 and !isset($medicosSearchCount))

           <div class="card mt-4">

             <div class="card-header">
               <h5>Médicos Agregados</h5>
             </div>
             <div class="body">

               <table class="table table-bordered">
                 <thead class="bg-primary text-white" >
                     <th>Cedula</th>
                     <th>Nombre Completo</th>
                     <th>Correo</th>
                     <th>Teléfono</th>
                     <th>Especialidad</th>
                     <th>acciones</th>
                 </thead>
                 @foreach ($medicos as $medico)
                   <tbody>
                     <td>
                       {{$medico['identification']}}
                     </td>
                     <td>
                       {{$medico['name']}} {{$medico['lastName']}}
                     </td>
                     <td>
                         {{$medico['email']}}
                     </td>
                     <td>
                       {{$medico['phone']}}
                     </td>

                     <td>
                         {{$medico['specialty']}}
                     </td>
                       <td><a href="{{route("medico.edit",$medico['id'])}}" class="btn btn-primary">Perfil</a></td>
                   </tbody>
                 @endforeach
                 <tfoot>
                     <td colspan="6">{{$medicos->appends(Request::all())->links()}}</td>
                 </tfoot>
                 </table>
               @elseif(!isset($medicosSearchCount))
                 <div class="card mt-5">
                   <h5>No ahi Profesionales de la salud registrados en este Centro Médico</h5>
                 </div>
               @endif
             </div>
             </div>




        </div>
</section>

@endsection
