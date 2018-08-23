@extends('layouts.app')

@section('content')


<section class="box-register">
	<div class="row">
		<div class="col-12 text-right">
			<h2 class="font-title text-center" id="title">Agregar/Eliminar Imagenes</h2>
			<div class="btn-group " role="group" aria-label="Basic example">
		</div>
	</div>
	<div class="container">
		<div class="text-right">
			<a class="btn btn-secondary mb-1"href="{{route('medico.edit',\Hashids::encode($medico->id))}}">Volver</a>

		</div>
		<div class="register">
      <div class="row">
        <div class="col-12">
         <div class="form-group">


					 <div class="card">
					 		<div class="card-body">
								<div class="form-inline">
									{!!Form::open(['route'=>'image_store','method'=>'POST','files'=>true])!!}
									<div class="">
										{!!Form::file('image',[])!!}

									</div>
									<div class="mt-2">
										{!!Form::text('name',null,['placeholder'=>'Nombre de la Imagen','class'=>'form-control'])!!}
										{!!Form::submit('Subir imagen',['class'=>'btn btn-success'])!!}
										{!!Form::hidden('medico_id',$medico->id)!!}
										{!!Form::hidden('email',$medico->email)!!}
										{!!Form::close()!!}
									</div>

								</div>

					 		</div>
					 </div>

        </div>
      </div>
      </div>

			<div class="row mt-5" id="">
			 @foreach ($images as $image)
			 {{-- div que encierra cada imagen --}}

			 <div class="col-4 card">
				 <div class="card-body">
					 <img onclick="expandir(this)" id="myImg" src="{{asset($image->path)}}" width="auto" height="150px" alt="">
  				 <a  class="close" 	onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')"href="{{route('photo_delete',$image->id)}}">x</a>
				 </div>
				 <div class="card-footer text-center">
					 <p>{{$image->name}}</p>
				 </div>
			 </div>
			 <!-- The Modal -->
			 <div id="myModal-img" class="modal-img">
				 <span class="cerrar">&times;</span>
				 <img class="modal-content-img" id="img01">
				 <div id="caption"></div>
			 </div>
			 @endforeach
		 </div>
		</div>
	</section>

	@endsection

	@section('scriptJS')
		<script type="text/javascript">
		// Get the modal
		var modal = document.getElementById('myModal-img');

		// Get the image and insert it inside the modal - use its "alt" text as a caption

		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");

		function expandir(result){
			var modalImg = document.getElementById("img01");
			var captionText = document.getElementById("caption");
			modal.style.display = "block";
			modalImg.src = result.src;
			captionText.innerHTML = result.alt;
		}
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("cerrar")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
				modal.style.display = "none";
		}

		</script>
	@endsection
