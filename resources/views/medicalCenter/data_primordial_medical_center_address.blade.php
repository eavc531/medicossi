@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="row">
    <div class="col-12 text-right">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary">1</button>
        <button type="button" class="btn btn-secondary">2</button>
        <button type="button" class="btn btn-config-blue">3</button>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12 mb-3 mt-3">
          <p>Por Favor rellene los datos correspondientes a la direccion del Centro Medico, es importante que sea lo mas preciso, para que los usarios ubiquen con mayor facilidad su cuenta, a travez del sistema de busquedas.</p>
        </div>
      </div>


        {!!Form::model($medicalCenter,['route'=>['medicalCenter.update',$medicalCenter],'method'=>'PUT'])!!}
        <div class="row align-items-center">
         <div class="col-lg-6 col-sm-6 col-12">
           <div class="form-group">
             <label for=""><strong>Dirección del Centro Médico u Hostpital</strong></label>

           </div>
         </div>
       </div>


       <div class="row my-3">
         <div class="col-lg-3 col-12">
           <div class="form-group row">
             <label for="" class="col-4 col-form-label">Pais</label>
            {{Form::select('country',$countries,'Mexico',['class'=>'form-control'])}}
           </div>
         </div>
         <div class="col-lg-3 col-12">
           <div class="form-group row">
             <label for="" class="col-4 col-form-label">Estado</label>
             {{Form::select('state',$states,null,['class'=>'form-control'])}}
           </div>
         </div>

       </div>
       <div class="col-lg-3 col-12">
         <div class="form-group row">
           <label for="" class="col-4 col-form-label">Ciudad</label>
           {{Form::select('state',$cities,null,['class'=>'form-control'])}}
         </div>
       </div>
       <div class="col-lg-3 col-12">
         <div class="form-group row">
           <label for="" class="col-4 col-form-label" >Codigo Postal</label>
           {{Form::number('postal_code',null,['class'=>'form-control'])}}
         </div>
       </div>
       <div class="row mt-2">
         <div class="col-lg-3 col-12">
           <div class="form-group row">
             <label for="" class="col-4 col-form-label" >Colonia</label>
             {{Form::text('colony',null,['class'=>'form-control'])}}
           </div>
         </div>
         <div class="col-lg-3 col-12">
           <div class="form-group row">

            {{Form::select('street',['calle'=>'calle','Av'=>'Av'],null,['class'=>'form-control col-4',])}}
           </div>
         </div>
         <div class="col-lg-3 col-12">
           <div class="form-group row">
             <label for="" class="col-lg-7 col-12 col-form-label">Numero Externo</label>
              {{Form::text('number_ext',null,['class'=>'form-control'])}}
           </div>
         </div>
         <div class="col-lg-3 col-12">
           <div class="form-group row">
             <label for="" class="col-lg-7 col-12 col-form-label">Numero Interno</label>
             {{Form::text('number_int',null,['class'=>'form-control'])}}
           </div>
         </div>
       </div>
       <div class="row my-4">
         <div class="col-12 text-center">
           <button class="btn btn-success">Guardar</button>
         </div>
       </div>

            <div class="col-lg-6 col-12 mt-2">

            </div>
            <div class="col-lg-6 col-12 mt-2">
              <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
            </div>
          </div>
         {!!Form::close()!!}
    </div>
  </div>
</section>
@endsection
