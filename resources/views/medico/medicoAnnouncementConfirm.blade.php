@extends('layouts.app')

@section('content')


	<section class="box-register">
		<div class="container">
			<div class="register">
			   <form action="" method="">
				<div class="row">
					<div class="col-12 text-right">
						<div class="btn-group " role="group" aria-label="Basic example">
						  <button type="button" class="btn btn-secondary">1</button>
						  <button type="button" class="btn btn-secondary">2</button>
						  <button type="button" class="btn btn-config-blue">3</button>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12 mb-3">
						<h5 class="text-center font-title">Ya eres miembro de la mejor red de médicos y profesionales de la salud</h5>
					</div>
				</div>
						<div class="row mt-3">
							<div class="col-6">
								<img src="img/foto_de_perfil.jpg" width="120px" height="80px" alt=""><a href="" class="link-photo"><input id="file-3" type="file" multiple=true value="..."></a>
							</div>
							<div class="col-6 text-center">
								<label for="">Barra de progreso</label>
								<div class="progress">
								  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%; vertical-align: center;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mt-2">
							<div class="col-lg-12 col-12">
								<div class="form-group">
								    <input type="id-cedula" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre(s)">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido paterno">
								</div>
							</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
									    <input type="last-name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Materno">
									 </div>
								</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    <input type="last-name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Cédula Profesional">
								 </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telefono Oficina">
								</div>
							</div>
								<div class="col-lg-5 col-12">
									<div class="form-group">
									    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Teléfono Celular">
									 </div>
								</div>
								<div class="col-lg-1 col-12">
									<div class="form-group">
									    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Teléfono Celular">
									 </div>
								</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Teléfono Oficina">
								 </div>
							</div>
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    <p for="">¿Desea que su numero celular aparezca visible en formatos e información a pacientes?</p>
								 </div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<span>Dirección del consultorio</span>
							<hr>
							</div>
						</div>
						<div class="box-form">
							<div class="row">
								<div class="col-lg-4 col-12">
									<div class="row">
										<div class="col-12">
											<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Calle">
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-12">
									<div class="row">
										<div class="col-12">
											<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Numero extra">
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-12">
									<div class="row">
										<div class="col-12">
											<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Numero int">
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-lg-3 col-12">
									<div class="row">
										<div class="col-12">
											<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Colonia">
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-12">
									<div class="row">
										<div class="col-12">
											<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="C.P">
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-12">
									<div class="row">
										<div class="col-lg-4 col-12">
											<label for="" class="center-label">Ciudad</label>
										</div>
										<div class="col-lg-8 col-12">
										  <div class="form-group">
										    	<select class="form-control" id="exampleSelect1" placeholer="Seleccione su sexo">
											      <option>Guanare</option>
											      <option>Barinas</option>
										    	</select>
										  </div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-12">
									<div class="row">
										<div class="col-lg-3 col-12">
											<label for="" class="center-label">Estado</label style="">
										</div>
										<div class="col-lg-9 col-12">
										  <div class="form-group">
										    	<select class="form-control" id="exampleSelect1" placeholer="Seleccione su sexo">
											      <option>Vargas</option>
											      <option>barcelona</option>
										    	</select>
										  </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					  <div class="row mt-3">
						<div class="col-4">
							<label for="" class="text-center height-register3">Clave unica de estalecimiento de la salud</label>
							<input type="example" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
						</div>
						<div class="col-4">
							<label for="" class="text-center height-register3">Nombre comercial del consultorio si lo tuviera</label>
							<input type="example" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
						</div>
						<div class="col-4 text-center height-register3">
							<br><br>
							<a href="" data-toggle="modal" data-target="#modal-work" class="btn btn-config-blue">Agregar otro directorio</a>
						</div>
					  </div>

					  	<div class="row mt-3">
					  		<div class="col-12 text-center">
					  			<button type="submit" class="btn btn-config-green">Guardar</button>
					  		</div>
					  	</div>
					  	<br>
						 <div class="box-panel-register">
						  	<div class="row mt-3">
						  		<div class="col-12 text-center">
						  			<h4 class="font-title-blue">Informacion General</h4>
						  		<hr>
						  		</div>
						  	</div>
						  	<div class="row">
						  		<div class="col-6 text-left">
									<ul style="text-decoration: none;">
										<li>Postgrado o residencia médica</li>
										<li>Subespecialidad</li>
										<li>Pregrado o carrera profesional</li>
									</ul>
						  		</div>
						  	</div>
						  	<div class="row">
						  		<div class="col-12 text-right">
						  			<a href="" data-toggle="modal" data-target="#modal-work2" class="btn btn-config-blue">Agregar campo</a>
						  		</div>
						  	</div>
						  	<br>
						  	<hr>
							<div class="row mt-4">
								<div class="col-12">
									<div class="form-group row">
									  <label for="example-text-input" class="col-3 col-form-label">Nombre de la institución</label>
									  <div class="col-8">
									    <input class="form-control" type="text" value="" id="example-text-input">
									  </div>
									</div>
									<div class="form-group row">
									  <label for="example-text-input" class="col-3 col-form-label">Especialidad que cursó</label>
									  <div class="col-8">
									    <input class="form-control" type="text" value="" id="example-text-input">
									  </div>
									</div>
									<div class="form-group row">
									  <label for="example-text-input" class="col-3 col-form-label">Cedula profesional</label>
									  <div class="col-8">
									    <input class="form-control" type="text" value="" id="example-text-input">
									  </div>
									</div>
									<div class="form-group row">
									  <label for="example-datetime-local-input" class="col-3 col-form-label">Periodo en que lo curso</label>
									  <div class="col-4">
									    <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
									  </div>
									  	<label for="example-text-input" class="col-form-label">/</label>
									  <div class="col-4">
									    <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
									  </div>
									</div>
								<hr>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Tipos de consultorios</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="custom-controls-stacked">
									  <label class="custom-control custom-radio">
									    <input id="radioStacked1" name="radio-stacked" type="radio" class="custom-control-input">
									    <span class="custom-control-indicator"></span>
									    <span class="custom-control-description">Medicina general o familiar</span>
									  </label>
									  <label class="custom-control custom-radio">
									    <input id="radioStacked2" name="radio-stacked" type="radio" class="custom-control-input">
									    <span class="custom-control-indicator"></span>
									    <span class="custom-control-description">Consultorio de especialidades</span>
									  </label>
									  <label class="custom-control custom-radio">
									    <input id="radioStacked1" name="radio-stacked" type="radio" class="custom-control-input">
									    <span class="custom-control-indicator"></span>
									    <span class="custom-control-description">Consultorio odontologica</span>
									  </label>
									  <label class="custom-control custom-radio">
									    <input id="radioStacked2" name="radio-stacked" type="radio" class="custom-control-input">
									    <span class="custom-control-indicator"></span>
									    <span class="custom-control-description">Otro tipo de servicio, especifique:</span>
									  </label>
									</div>
								</div>
							</div>
							<div class="row">
						  		<div class="col-12 text-right">
						  			<a href="" data-toggle="modal" data-target="#modal-service" class="btn btn-config-blue">Especifique el típo de servicio</a>
						  		<hr>
						  		</div>
						  	</div>
							<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Servicios otorgados</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-7">
									<div class="col-12">
										<div class="form-group">
										    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el servicio o terapia que atiendas">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el servicio o terapia que atiendas">
										 </div>
									</div>
									<div class="col-12">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el servicio o terapia que atiendas">
										 </div>
									</div>
									<div class="col-12">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el servicio o terapia que atiendas">
										 </div>
									</div>
								</div>
							</div>
							<div class="row">
						  		<div class="col-12 text-right">
						  			<a href="" data-toggle="modal" data-target="#modal-service2" class="btn btn-config-blue">Agregar servicio</a>
						  			<button type="submit" class="btn btn-config-green">Guardar</button>
								<hr>
						  		</div>
						  	</div>
						  	</div>
						  	<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Experiencia en transtornos mentales</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="col-12">
										<div class="form-group">
										    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el transtorno o enfermedad en la que tengas mas experiencía o por el que te busquen mas">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el transtorno o enfermedad en la que tengas mas experiencía o por el que te busquen mas">
										 </div>
									</div>
									<div class="col-12">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el transtorno o enfermedad en la que tengas mas experiencía o por el que te busquen mas">
										 </div>
									</div>
									<div class="col-12">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa aquí el transtorno o enfermedad en la que tengas mas experiencía o por el que te busquen mas">
										 </div>
									</div>
								</div>
							</div>
							<div class="row">
						  		<div class="col-12 text-center">
						  			<a href="" data-toggle="modal" data-target="#modal-service2" class="btn btn-config-green">Guardar</a>
						  			<hr>
						  		</div>
						  	</div>
						  	<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Agrega videos y fotos</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
								 <div class="form-group">
								    <input type="file" name="img[]" class="file">
								    <div class="input-group col-xs-12">
								      <span class="input-group-addon"><i class="fas fa-images"></i></span>
								      <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
								      <span class="input-group-btn">
								        <button class="browse btn btn-config-blue input-lg" type="button"> Agrega una imagen</button>
								      </span>
								    </div>
								  </div>
								</div>
								<div class="col-6">
									<div class="form-group">
									   <input type="file" name="img[]" class="file">
									   <div class="input-group col-xs-12">
									     <span class="input-group-addon"><i class="fas fa-video"></i></span>
									     <input type="text" class="form-control input-lg" disabled placeholder="Upload Video">
									     <span class="input-group-btn">
									       <button class="browse btn btn-config-blue input-lg" type="button"> Agrega un video</button>
									     </span>
									   </div>
									 </div>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Mis redes sociales</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="col-6">
										<div class="form-group">
										    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Facebook">
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Twitter">
										 </div>
									</div>
									<div class="col-6">
										<div class="form-group">
										    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Google+">
										 </div>
									</div>
								</div>
							</div>
							<div class="row">
						  		<div class="col-12 text-center">
						  			<button type="submit" class="btn btn-config-green">Guardar</button>
								<hr>
						  		</div>
						  	</div>
						  <div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Mis redes sociales</h4>
									<hr>
								</div>
							</div>

  						</div>
					  </div>
				</form>
			</div>
		</div>
	</section>

	<!-- Modal add info-directory-->
<div class="modal fade" id="modal-work" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	        <div class="row">
	        	<div class="col-12 text-center">
	        		<h4>Agregar otro directorio</h4>
	        	</div>
				<div class="col-12 mt-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
				</div>
	        </div>
	        <div class="row mt-3">
	        	<div class="col-12">
	        		<a href="" class="btn btn-block btn-config-green">Agregar</a>
	        	</div>
	        </div>
		</div>
    </div>
   </div>
  </div>

  	<!-- Modal add info2-->
<div class="modal fade" id="modal-work2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	        <div class="row">
	        	<div class="col-12 text-center">
	        		<h4>Agregar información personal</h4>
	        	</div>
				<div class="col-12 mt-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Agregar campo">
				</div>
	        </div>
	        <div class="row mt-3">
	        	<div class="col-12">
	        		<a href="" class="btn btn-block btn-config-green">Agregar</a>
	        	</div>
	        </div>
		</div>
    </div>
   </div>
  </div>


      	<!-- Modal add service2-->
<div class="modal fade" id="modal-service2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	        <div class="row">
	        	<div class="col-12 text-center">
	        		<h4>Agregar otro servicio</h4>
	        	</div>
				<div class="col-12 mt-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
				</div>
	        </div>
	        <div class="row mt-3">
	        	<div class="col-12">
	        		<a href="" class="btn btn-block btn-config-green">Agregar</a>
	        	</div>
	        </div>
		</div>
    </div>
   </div>
  </div>
</body>





   


@include('users.modalresendMailConfirm')
@endsection
