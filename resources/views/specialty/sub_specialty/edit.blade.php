@extends('layouts.app')
@section('css')
    <style media="screen">
        .red{
            border-color:red;
        }
    </style>
@endsection
@section('content')


  <section class="box-register">
    <div class="container">
      <div class="register">
        <div class="row">
          <div class="col-12 mb-3">
            <h2 class="text-center font-title">Editar Sub-Especialidad</h2>
            <hr>
          </div>
        </div>
        {!!Form::model($sub_specialty,['route'=>['sub_specialty.update',$sub_specialty->id],'method'=>'PUT'])!!}

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="" class="font-title">Nombre</label>
                  {!!Form::text('name',null,['class'=>'form-control red','placeholder'=>''])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="" class="font-title">Descripción</label>
                    {!!Form::text('description',null,['class'=>'form-control','placeholder'=>''])!!}
               </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="" class="font-title">sinonimo 1 (Opcional)</label>
                 {!!Form::text('synonymous1',null,['class'=>'form-control','placeholder'=>''])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="" class="font-title">sinonimo 2 (Opcional)</label>
                {!!Form::text('synonymous2',null,['class'=>'form-control','placeholder'=>''])!!}

              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="" class="font-title">sinonimo 3 (Opcional)</label>
                    {!!Form::text('synonymous3',null,['class'=>'form-control','placeholder'=>''])!!}
              </div>
            </div>
            <div class="col-lg-6 col-12">


            </div>
            <div class="col-6">
                <label for="" class="font-title-blue">filtrar especialidades por Categoria:</label>


                {!!Form::select('specialty_category_id',$categories,null,['class'=>'form-control','placeholder'=>'Todas','id'=>'category'])!!}
            </div>
            <div class="col-6">

                <label for="" class="font-title">Especialidad</label>
                 {!!Form::select('specialty_id',$specialty,null,['class'=>'form-control red','placeholder'=>'Especialidades','id'=>'specialty'])!!}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12 mt-2">
              <a href="{{route('specialty.index')}}" class="btn-config-blue btn btn-block">Cancelar</a>

            </div>
            <div class="col-lg-6 col-12 mt-2">
              {!!Form::submit('Guardar Cambios',['class'=>'btn-config-green btn btn-block'])!!}
            </div>
          </div>
        {!!Form::close()!!}
      </div>
    </div>
  </section>


@endsection
@section('scriptJS')
    <script type="text/javascript">

    $('#category').on('change', function() {
     specialty_category_id = $(this).val();

     //$('#dist').val(null);
     route = "{{route('llenar_especialidad')}}";

     $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'post',
      url: route,
      data:{specialty_category_id:specialty_category_id},
      success:function(result){
          console.log(result)
        //  console.log(result);
        $("#specialty").empty();
        $('#specialty').append($('<option>', {
         value: 'Seleccione especialidad',
         text: 'Seleccione especialidad'
       }));
        $.each(result,function(key, val){
          $('#specialty').append($('<option>', {
            value: key,
            text: val
          }));
        });
      },
      error:function(error){
       console.log(error);
     },
   });
   })

    </script>
@endsection
