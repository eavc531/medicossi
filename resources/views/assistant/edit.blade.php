@extends('layouts.app')

@section('content')

  <h1>Editar Categoria</h1>

						{!!Form::model($category,['route'=>['specialty_categories.update',$category],'method'=>'PUT'])!!}

								    {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])!!}

								    {!!Form::text('description',null,['class'=>'form-control','placeholder'=>'descripción'])!!}

                     {!!Form::submit('Enviar')!!}
					{!!Form::close()!!}
			</div>
		</div>
	</section>
@endsection
