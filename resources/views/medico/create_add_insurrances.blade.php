@extends('layouts.app')

@section('content')
<section class="container">
  <div class="row">
    <div class="col-12 mb-3">
      <h3 class="text-center font-title">Aseguradoras</h3>
    
    </div>
  </div>
  <div class="row">
    <div class="col-6">

    </div>
    <div class="col-6 text-right">
      <a href="{{route('medico.edit',request()->id)}}" class="btn btn-secondary">Atras</a>
    </div>
  </div>
  <div class="row mt-3">

    @foreach ($insurrance_show as $insurance)
    <div class="col-12 col-lg-6 mt-2">
      <div class="row">
        <div class="col-6 m-auto">
         {!!Form::open(['route'=>['medico_store_insurrances',request()->id],'method'=>'POST'])!!}
         <input type="hidden" name="name" value="{{$insurance->name}}" class="form-control mt-2">
         <label class="" for="customRadio11">{{$insurance->name}}</label>
       </div>
       <div class="col-3">
         <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i></button>
       </div>
     </div>
     {!!Form::close()!!}
   </div>
   @endforeach
 </div>
 <div class="col-12 col-sm-10 m-sm-auto col-lg-10 m-lg-auto">
  {!!Form::open(['route'=>['medico_store_insurrances',request()->id],'method'=>'POST'])!!}
  <label for="" class="font-title mt-4">Otra, Especifique:</label>
    <div class="input-group-prepend">
      <input type="text" name="name" value="" class="form-control">
      <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i></button>
    </div>
  {!!Form::close()!!}
</div>

<div class="row  my-5">
  <div class="col-lg-10 m-lg-auto">
    <h4 class="text-center font-title">Aseguradoras Aceptadas</h4>
    <ul class="list-group mt-3">
      <div class="row">
        @foreach ($insurances as $i)
          <div class="col-6">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{$i->name}}
              <a href="{{route('delete_insurance',$i->id)}}" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></a>
            </li>
          </div>
        @endforeach
      </div>

    </ul>
  </div>
</div>
</section>
@endsection
