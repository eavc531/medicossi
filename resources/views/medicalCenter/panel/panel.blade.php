@extends('layouts.app')

@section('content')
  <section class="section-dashboard">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-3 text-center">
          <img  class="img-dashboard" src="img/Medicossi-Marca original-04.png" alt="">
          <div class="col-12 border-head-panel">
            <span>Administrador firmado:</span>
            <span>juangonzalez239@hotmail.com</span>
          </div>
          <div class="col-12 my-1 nopadding border-panel-blue">
            <div class="col-12">
              <h5>Mis Profesionales</h5>
            </div>
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" class="form-control">
              </div>
              <hr>
            </div>
            <div class="col-12 nopadding">
              <div class="box-control-panel">
                <a href="" id="blue">
                  <i class="fas fa-user-plus"></i>
                  <h5>Agregar Profesional</h5>
                </a>
              </div>
            </div>
            <hr>
            <div class="col-12">
              <h5>Mis Asistentes</h5>
            </div>
            <div class="col-12">
              <div class="form-group">
                <span class="form-control">Juan Gonzalez</span>
              </div>
              <div class="form-group">
                <span class="form-control">Juan Gonzalez</span>
              </div>
              <div class="form-group">
                <span class="form-control">Juan Gonzalez</span>
              </div>
              <div class="form-group">
                <span class="form-control">Juan Gonzalez</span>
              </div>
              <hr>
            </div>
            <div class="col-12 nopadding">
              <div class="box-control-panel">
                <a href="" id="blue">
                  <i class="fas fa-user-plus"></i>
                  <h5>Agregar Asistente</h5>
                </a>
              </div>
            </div>
            <hr>
          </div>
          <div class="border-panel-green">
            <div class="col-12">
              <div class="row">
                <div class="col-12 box-control-panel">
                  <a href="">
                    <i class="fas fa-user-md"></i>
                    <h5>Mis calificaciones</h5>
                  </a>
                </div>
              </div>
            </div>
            <hr>
            <div class="col-12">
              <div class="col-12 box-control-panel">
                <a href="">
                  <i class="fas fa-chart-line"></i>
                  <h5>Mis Estadisticas</h5>
                </a>
              </div>
            </div>
            <hr>
            <div class="col-12">
              <label class="filebutton">
                <img src="img/botones-medicossi-31.png" alt="">
                <span><input type="file" id="myfile" name="myfile"></span>
                <h5 class="font-title">Respaldar mi información</h5>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <a href="" class="btn-config-green btn btn-block">Configuración</a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 box-mesage text-center">
          <div class="register">
            <div class="row">
              <div class="col-12">
                <h2 class="text-center font-title">Centro medico</h2>
                <hr>
              </div>
            </div>
            <div class="row justify-content-center mb-2">
              <div class="col-10">
                <div class="row">
                  <div class="col-lg-4 col-6">
                    <img src="img/botones-medicossi-26.png" alt="">
                  </div>
                  <div class="col-lg-4 col-6">
                    <img src="img/botones-medicossi-27.png" alt="">
                  </div>
                  <div class="col-lg-4 mt-3 col-12">
                    <a href=""><img src="img/botones-medicossi-32.png" alt=""></a>
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
