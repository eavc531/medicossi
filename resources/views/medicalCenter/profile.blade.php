@extends('layouts.app')

@section('content')
  <section class="section-dashboard">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10 col-sm-9 col-12 box-mesage">
          <div class="row">
            <div class="col-12 p-5">
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 my-1">
                  <img class="img-profile-section" src="img/foto_de_perfil.jpg" alt="Perfil médico">
                </div>
                <div class="col-12 col-sm-6 col-lg-4 my-1">
                  <div class="form-group">
                    <h3 class="font-title">Nombre de la institución</h3>
                    <p class="font-title">Desarrollador web</p>
                  </div>
                  <div class="form-group">
                    <ul>
                      <li><i class="fas fa-home"></i> Street 111 lorem asdq</li>
                      <li><i class="fas fa-phone"></i> 0242353253</li>
                      <li><i class="fas fa-check"></i>Clave unica del establecimiento de salud</li>
                      <li><i class="fas fa-map-marker mr-2"></i>Pais</li>
                    </ul>
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                  <div class="form-group">
                    <div class="d-flex text-center">
                      <a href="" class="btn btn-dark mx-1"><i class="fas fa-home"></i></a>
                      <a href="" class="btn btn-dark mx-1"><i class="fas fa-print"></i></a>
                      <a href="" class="btn btn-dark mx-1"><i class="far fa-envelope"></i></a>
                      <a href="" class="btn btn-dark mx-1"><i class="fab fa-twitter"></i></a>
                      <a href="" class="btn btn-dark mx-1"><i class="fab fa-facebook-f"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row my-4">
                <div class="col-lg-4">
                  <h5 for="inputPassword3" class="font-title">Información General</h5>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-6">
                      <ul>
                        <li>Estado</li>
                        <li>Ciudad</li>
                        <li>Calle</li>
                        <li>Colonia</li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul>
                        <li>0242353253</li>
                        <li>C.P</li>
                        <li>Numero extra</li>
                        <li>Numero int</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row my-4">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Horario de atención</h5>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-3">
                    <label class="mx-3" for="inputPassword6">Lunes</label>
                  </div>
                  <div class="col-12 col-lg-9">
                    <span class="mx-3" for="">7:28 AM</span>
                    <span class="mx-3" for="">A</span>
                    <span class="mx-3" for="">4:32 PM</span>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Descripción</h5>
                </div>
                <div class="col-lg-8">
                  <label for="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam illum, vitae atque, iusto voluptatum fuga sint nostrum sit beatae, qui asperiores ullam tempore fugit dicta, debitis tempora neque dolore officiis.</label>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Especialidades</h5>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <ul>
                        <li>Medicina Ejemplos</li>
                        <li>Ejemplos</li>
                        <li>Medicina Ejemplos</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Profesionales de salud</h5>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <ul>
                        <li>Jose Perez</li>
                        <li>Juan Gonzalez</li>
                        <li>Juan Ramon</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Experiencias en trastornos o enfermedades</h5>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <ul>
                        <li class="my-1">Ingresa aqui el transtorno o apodo que mas se te conozca</li>
                        <li class="my-1">Ingresa aqui el transtorno o apodo que mas se te conozca</li>
                        <li class="my-1">Ingresa aqui el transtorno o apodo que mas se te conozca</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 class="font-title">Imagenes</h5>
                </div>
                <div class="col-lg-8 col-12">
                  <div class="row">
                    <div class="col-6 col-sm col-lg my-2">
                      <img src="img/foto_de_perfil.jpg" width="auto" height="80px" alt="">
                      <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')" href="">x</a>
                    </div>
                    <div class="col-6 col-sm col-lg my-2">
                      <img src="img/foto_de_perfil.jpg" width="auto" height="80px" alt="">
                      <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')" href="">x</a>
                    </div>
                    <div class="col-6 col-sm col-lg my-2">
                      <img src="img/foto_de_perfil.jpg" width="auto" height="80px" alt="">
                      <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')" href="">x</a>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Redes sociales</h5>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <ul>
                        <li><i class="far btn fa-envelope"></i>Email</li>
                        <li><i class="fab btn fa-twitter"></i>Twitter</li>
                        <li><i class="fab btn fa-facebook-f"></i>Facebook</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-4 pl-3">
                  <h5 for="inputPassword3" class="font-title">Aseguradoras</h5>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <ul>
                        <li>Clasificados de servicios profesionales otorgados</li>
                        <li>Solo pacientes otorgados</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>


@endsection
