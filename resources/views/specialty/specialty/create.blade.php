@extends('layouts.app')

@section('content')


  <section class="box-register">
    <div class="container">
      <div class="register">
        <div class="row">
          <div class="col-12 mb-3">
            <h2 class="text-center font-title">Crear Especialidad</h2>
            <hr>
          </div>
        </div>
        {!!Form::open(['route'=>'specialty.store','method'=>'POST'])!!}

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                    {!!Form::text('description',null,['class'=>'form-control','placeholder'=>'descripción'])!!}
               </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                 {!!Form::text('synonymous1',null,['class'=>'form-control','placeholder'=>'sinonimo 1 (Opcional)'])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {!!Form::text('synonymous2',null,['class'=>'form-control','placeholder'=>'sinonimo 2 (Opcional)'])!!}

              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                    {!!Form::text('synonymous3',null,['class'=>'form-control','placeholder'=>'sinonimo 3 (Opcional)'])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                      {!!Form::select('specialty_category_id',$categories,null,['class'=>'form-control','placeholder'=>'Categoria'])!!}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12 mt-2">
              <a href="{{route('specialty.index')}}" class="btn-config-blue btn btn-block">Cancelar</a>

            </div>
            <div class="col-lg-6 col-12 mt-2">
              {!!Form::submit('Registrar',['class'=>'btn-config-green btn btn-block'])!!}
            </div>
          </div>
        {!!Form::close()!!}
      </div>
    </div>
  </section>














@endsection
