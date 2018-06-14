@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="row">
    <div class="col-12 text-right">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-config-blue">1</button>
        <button type="button" class="btn btn-secondary">2</button>
        <button type="button" class="btn btn-secondary">3</button>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12 mb-3">
          <h2 class="text-center font-title">Registro de centro médico</h2>
        </div>
      </div>


        {!!Form::open(['route'=>'medicalCenter.store','method'=>'POST'])!!}

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Centro Medico'])}}
                </div>
                <div class="form-group">
                  {{Form::text('nameAdmin',null,['class'=>'form-control','placeholder'=>'Nombre del Administrador'])}}
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="form-group">

                  {{Form::text('phone_admin',null,['class'=>'form-control','placeholder'=>'Telefono'])}}
                 </div>
                <div class="form-group">
                  {{Form::select('country',$countries,'México',['class'=>'form-control'])}}
                </div>
            </div>
          </div>
          <div class=row>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {{Form::email('emailAdmin',null,['class'=>'form-control','placeholder'=>'Correo del Administrador'])}}
              </div>

            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {{Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña'])}}
              </div>

            </div>
          </div>

          <div class="row">
    				<div class="col-lg-12 col-12">
    					<div class="form-group">
    						<a href="" class="btn btn-primary" data-toggle="modal" data-target="#terms">Leer términos y condiciones</a>
    					</div>
    					<div class="custom-control custom-checkbox">
    						{{Form::checkbox('terminos',null)}}
    						<label for="customCheck1">Al seleccionar este recuadro e leído y estoy de acuerdo con las políticas de la plataforma asi como el aviso de privacidad para el uso de mis datos personales</label>
    					</div>
    				</div>
    			</div>

          <div class="row">
            <div class="col-lg-6 col-12 mt-2">
              <a href="{{route('medicalCenter.create')}}" class="btn-config-blue btn btn-block">Limpiar</a>
            </div>
            <div class="col-lg-6 col-12 mt-2">
              <button type="submit" class="btn-config-green btn btn-block">Registrar</button>
            </div>
          </div>
         {!!Form::close()!!}
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal  fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Terminos y condiciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas odio, illum perferendis ratione laborum esse, veritatis aspernatur repellendus soluta sint nostrum, temporibus labore unde velit iusto? Excepturi dolorum, molestiae fugit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis ut perferendis ad, temporibus tempora eveniet ipsa incidunt eligendi molestias. Amet iusto quos ad est temporibus labore, magnam nihil quaerat dignissimos, saepe vero esse harum qui impedit laboriosam unde fugit doloribus ipsa totam rerum quia aliquam! Quis quam iure corporis unde? Voluptates officia necessitatibus, nisi sequi magni cum incidunt harum possimus aperiam, eos exercitationem dolorum, libero eligendi laboriosam maiores quisquam. Incidunt hic veritatis similique deleniti recusandae minima optio, assumenda delectus, velit officia doloribus magni voluptatum sequi dolor dicta debitis tempora excepturi nostrum at praesentium ut quisquam dolorum ea quidem! Architecto nisi repellat quis, totam, soluta harum culpa sit nam maiores quo voluptatibus. Doloribus corrupti ducimus fugit impedit aut maiores sequi suscipit magni facere perferendis, esse eveniet maxime aliquam natus earum, labore, aperiam? Velit est officiis, asperiores! Illo officiis optio, maxime esse doloremque. Deleniti doloribus voluptas error dolore magni, laborum, distinctio maxime voluptates itaque, blanditiis perspiciatis rerum incidunt. Autem assumenda excepturi eveniet amet nostrum numquam eos laborum iste non veniam illo, quasi modi sequi sint sapiente saepe repudiandae eligendi aliquid! Libero voluptatibus accusamus maxime consequuntur ipsam! Saepe provident cupiditate cum ipsam! Architecto distinctio officiis eligendi quia non obcaecati, repellendus quis minus! Asperiores nesciunt, voluptas? Amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias eveniet reiciendis illum, aliquam maiores necessitatibus quam incidunt accusantium, id eum mollitia dolorem doloribus veritatis! Ducimus laborum veniam eaque temporibus reprehenderit.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
@endsection
