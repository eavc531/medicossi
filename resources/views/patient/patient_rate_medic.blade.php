@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
      <div class="col-12 mb-3">
        <h2 class="text-center font-title">Calificar Médico: {{$medico->name}} {{$medico->lastName}} </h2>
      </div>
    </div>

    @if($count_rate == 0)

    <div class="card mt-3" id="create">
     {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
     {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
     {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
     {{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}
     <div class="card-edit card-header">
       <h5 class="" style="font-size: 18px;">Tu Opinion sobre el Médico: {{$medico->name}} {{$medico->lastName}}</h5>
     </div>
     <div class="row my-2">
      <div class="col-12 col-lg text-center">
        {{Form::radio('rate',1,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
        <label for="radio2" class="font-title-grey"> Malo</label>
     </div>
     <div class="col-12 col-lg text-center">
       {{Form::radio('rate',2,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender',])}}  <br>
       <label for="radio2" class="font-title-grey"> Malo</label>
     </div>
     <div class="col-12 col-lg text-center">
       {{Form::radio('rate',3,['class'=> 'mr-1', 'id' => 'radio3', 'name'=> 'gender'])}}  <br>
       <label for="radio3" class="font-title-grey">Regular</label>
     </div>
     <div class="col-12 col-lg text-center">
      {{Form::radio('rate',4,['class'=> 'mr-1', 'id' => 'radio4', 'name'=> 'gender'])}} <br>
      <label for="radio4" class="font-title-grey">Bueno</label>
     </div>
     <div class="col-12 col-lg text-center">
      {{Form::radio('rate',5,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
      <label for="radio2" class="font-title-grey"> Malo</label>
      <div class="" style="Display:none">
        {{Form::radio('rate',6,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}
      </div>
     </div>
     </div>
  <div class="form-group">
    <div class="col-12">
     <label for="" class="font-title-blue">Comentario:</label>
     {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:60px'])!!}
   </div>
   <div class="col-12 mt-2 d-flex">
    <input type="submit" name="" value="Guardar" class="btn btn-success mr-2">
    <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
  </div>
</div>
{{Form::close()}}

</div>
@else
  <div class="text-center">
    <p class="font-title-grey">Ya has Calificado al Médico: {{$medico->name}} {{$medico->lastName}}, pero puedes cambiar tu opinion respecto a tu ultima cita si asi lo prefieres.</p>

  </div>


    <div class="card" id="edit">

      <div class="card-edit card-header">
        {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
        <h5 class="" style="font-size: 18px;">Tu Opinion sobre el Médico: {{$medico->name}} {{$medico->lastName}}</h5>
      </div>
      <div class="card-body form-inline">
        <span class="mr-2">Puntaje:</span>

        @isset($you_rate->rate)
          @include('patient.star_rate')
        @endisset
      </div>
      <div class="col-12 form-group">
        <label for="" class="font-title-grey">Comentario:</label>
        {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:60px','disabled'])!!}
        <div class="mt-3 form-inline">
          <button onclick="editar()" type="button" name="button" class="btn btn-success mr-2">Editar</button>
          {{Form::close()}}

          {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
          {{Form::hidden('conservar','conservar')}}
          {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
          {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
          {{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}
          {{Form::submit('Conservar Opinion',['class'=>'btn btn-primary mr-2'])}}
          {{Form::close()}}



          <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>


        </div>
      </div>
    </div>





<div class="card mt-3 " id="create" style="Display:none">

 {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
 {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
 {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
 {{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}
 <div class="card-edit card-header">
   <h5 class="" style="font-size: 18px;">Tu Opinion sobre el Médico: {{$medico->name}} {{$medico->lastName}}</h5>
 </div>
 <div class="row my-2">
  <div class="col-12 col-lg text-center">
    {{Form::radio('rate',1,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
    <label for="radio2" class="font-title-grey"> Malo</label>
 </div>
 <div class="col-12 col-lg text-center">
   {{Form::radio('rate',2,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
   <label for="radio2" class="font-title-grey"> Malo</label>
 </div>
 <div class="col-12 col-lg text-center">
   {{Form::radio('rate',3,['class'=> 'mr-1', 'id' => 'radio3', 'name'=> 'gender'])}}  <br>
   <label for="radio3" class="font-title-grey">Regular</label>
 </div>
 <div class="col-12 col-lg text-center">
  {{Form::radio('rate',4,['class'=> 'mr-1', 'id' => 'radio4', 'name'=> 'gender'])}} <br>
  <label for="radio4" class="font-title-grey">Bueno</label>
</div>
<div class="col-12 col-lg text-center">
  {{Form::radio('rate',5,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
  <label for="radio2" class="font-title-grey"> Malo</label>
</div>
</div>
<div class="form-group">
<div class="col-12">
 <label for="" class="font-title-blue">Comentario:</label>
 {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:60px'])!!}
</div>
<div class="col-12 mt-2 d-flex">
<input type="submit" name="" value="Guardar" class="btn btn-success mr-2">
{{Form::close()}}
{!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
{{Form::hidden('conservar','conservar')}}
{{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
{{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
{{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}
{{Form::submit('Conservar Opinion',['class'=>'btn btn-primary mr-2'])}}
{{Form::close()}}
<a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
</div>
</div>

</div>
@endif


</div>
</div>
</div>
</div>
</section>
@endsection

@section('scriptJS')
<script type="text/javascript">
  function editar(){
    $('#create').show();
    $('#edit').hide();

  }

</script>

@endsection
