@extends('layouts.app')

@section('content')

<section>
<div class="row">
  <div class="col-12 mb-3">
    <h4 class="text-center font-title">Signos Vitales predefinidos</h4>

  </div>
</div>
{{-- MENU DE PACIENTES --}}

<div class="text-right">
  <a class="btn btn-secondary my-2" href="{{route(request()->get('back'),['m_id'=>$medico->id,'p_id'=>$patient->id,'note_id'=>$note->id])}}">Atras</a>
</div>


<div class="card mb-3" style="max-width:400px">
    <div class="card-header bg-success text-white">
        Agregar Campo Signo vital
    </div>
    <div class="card-body">
        {{Form::open(['route'=>'medico_vital_sign_store','method'=>'post'])}}
        <input type="hidden" name="atras" value="{{Session::get('atras')}}">
        <input type="hidden" name="note_customize_id" value="{{$note_customize->id}}">
        <input type="hidden" name="medico_id" value="{{$medico->id}}">
        <div class="form-inline">
            {{Form::text('name_question',null,['class'=>'form-control','placeholder'=>'',])}}
            <button type="submit" name="button" class="btn btn-success ml-2">Agregar</button>
        </div>

        {{Form::close()}}
    </div>
</div>

<div class="mb-5">
  <div class="text-center">
    <h4 class="font-title-blue">Signos Vitales</h4>
  </div>
</div>



<div class="row">
        @foreach ($vital_signs as $vital)
            <div class="col-4">
            <div class="card mt-2">
                <div class="card-body">
                        {{Form::open(['route'=>'vital_sign_delete','method'=>'POST'])}}
                    {{$vital->name_question}}
                    <input type="hidden" name="name_question" value="{{$vital->name_question}}">
                    <input type="hidden" name="medico_id" value="{{$medico->id}}">
                        <button type="submit" name="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-times"></i></button>
                        {{Form::close()}}

                </div>
            </div>
        </div>
        @endforeach

</div>

</section>




@endsection
