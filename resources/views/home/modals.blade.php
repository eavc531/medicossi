<!-- Modal register -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card-body">
          <h5 class="btn btn-success mt-1 registro-text" style="white-space: normal; color: #fff; text-transform: none;">¿Es usted un profesional de la salud o nucleo de diagnóstico?</h5>
          <div class="d-flex justify-content-between">
            <a href="{{route('medico.create')}}" class="btn-block btn btn-primary mt-3 registro-text" style="width:47%; white-space: normal; color: #fff;"><i class="fa fa-user-md"></i> Médico
            </a>
            <a href="{{route('medicalCenter.create')}}" class="btn-block btn btn-primary mt-3 registro-text" style="width:47%; white-space: normal; color: #fff;"><i class="fa fa-user"></i> Centro medico
            </a>
          </div>
          <p align="center" class="mt-3" style="font-weight: 600;">Ahora sus pacientes podrán encontrarte mas fácil</p>
          <p align="center" style="font-weight: 500;">Con nuestra plataforma web:</p>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Sus pacientes podrán agendar una cita o servicio médico, según especialidades, horarios y médicos disponibles</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Tus pacientes obtendran toda la información como núcleo de diagnóstico y/o hospital así como perfiles completos de los especialistas que colaboran en ese centro</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Encontrarán la ubicación de tu núcleo de diagnóstico o centro médico a través de geolocalización</p>
          </div>
          <div id="demo" class="collapse">
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Podrán tener tus colaboradores sus expedientes clínicos organizados de manera cronológica, completos e inter consultas por si necesitaran compartir</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Podrán tener cada colaborador su asistente, si lo prefieren una asistente podrá administrar las agendas de varios especialistas, con opción a configurar los accesos de información para cada uno de ellos</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked"></i>
            <p>Alertas de recordatorio de las citas confirmadas de sus profesionales en la salud, así como recordatorio a sus pacientes</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Todas tu información en el momento que quieras 24/7, reporte de estadísticas, consultas hechas por cada profesional, de manera opcional cada profesional</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Podrán si así lo prefieren respaldar y migrar la información en el momento que lo decidan mediante nuestro módulo de respaldos</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Tendrán la oportunidad de ser recomendados y así obtener mas pacientes mediante nuestro módulo califica a tu profesional</p>
          </div>
          <div class="d-flex justify-content-start reg-p">
            <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
            <p>Soporte telefónico y en linea</p>
          </div>
        </div>
          <button class="btn-block btn btn-primary" style="width:25%;" data-toggle="collapse" data-target="#demo" style="float:right: ">Ver Más</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Inicio Sesion-->
<div class="modal fade" id="modal_calification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="" id="list_calification">

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Large modal search-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="flip">
          <div class="col-lg-12">
              <div class="input-group search">
                <span class="mr-2 white" id="filter"><i class="fas fa-filter fa-2x"></i></span>
                  <label for="[object Object]"><h5>Buscar Por:</h5></label>
                  {{Form::select('search',['Centro Medico'=>'Centro Medico','Especialidad'=>'Especialidad',  'Medico'=>'Medico'],null)}}
                  <input type="text" class="form-control" placeholder="Search for..." id="searchVar">

              <button onclick="search()" type="button" class="ml-2 white" data-toggle="modal" data-target=".bd-example-modal-lg"><span id="filter"><i class="fas fa-search fa-2x"></i></span></button>
              </div>
          </div>
        </div>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="listSearchAjax">

        </div>
      </div>

    </div>
  </div>
</div>
