{{-- //modal experience --}}
<div class="modal fade" id="modal_experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_experience" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_experience"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agregar Experiencia</h4>
     </div>

     <div class="col-12 mt-3">
       <input type="text" name="description" value="" id="input_experience" class="form-control">
       {{-- {!!Form::hidden('medicalCenter_id',$medicalCenter->id,['class'=>'form-control','id'=>'medicalCenter_id'])!!} --}}

     </div>

   </div>
   <div class="row mt-3">
    <div class="col-12">
      <div class="row">
        <div class="col-6">
          <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
        </div>
        <div class="col-6">
          <button onclick="medical_center_experience_store()" name="button" class="btn btn-block btn-primary">Guardar</button>
        </div>
      </div>

   </div>
 </div>
</div>
</div>
</div>
</div>

{{-- //modal specialty --}}
<div class="modal fade" id="modal-specialty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_specialty" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_specialty"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agregar Especialidad</h4>
     </div>

     <div class="col-12 mt-3">
       <input type="text" name="description" value="" id="input_specialty" class="form-control">
       {{-- {!!Form::hidden('medicalCenter_id',$medicalCenter->id,['class'=>'form-control','id'=>'medicalCenter_id'])!!} --}}

     </div>

   </div>
   <div class="row mt-3">
    <div class="col-12">
      <div class="row">
        <div class="col-6">
          <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
        </div>
        <div class="col-6">
          <button onclick="medical_center_specialty_store()" name="button" class="btn btn-block btn-primary">Guardar</button>
        </div>
      </div>

   </div>
 </div>
</div>
</div>
</div>
</div>

{{-- //modal description --}}
<div class="modal fade" id="modal-service2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_service" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_service"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Descripción del Centro Médico</h4>
     </div>

     <div class="col-12 mt-3">

       {!!Form::text('description',null,['class'=>'form-control','id'=>'input_description'])!!}
       {{-- {!!Form::hidden('medicalCenter_id',$medicalCenter->id,['class'=>'form-control','id'=>'medicalCenter_id'])!!} --}}

     </div>

   </div>
   <div class="row mt-3">
    <div class="col-12">
      <div class="row">
        <div class="col-6">
          <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
        </div>
        <div class="col-6">
          <button onclick="store_description()" name="button" class="btn btn-block btn-primary">Guardar</button>
        </div>
      </div>

   </div>
 </div>
</div>
</div>
</div>
</div>

<!-- Modal note medic -->
<div class="modal fade bd-example-modal-lg" id="add-pad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title font-title text-center" id="exampleModalLabel">Configura las que utilices</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row align-self-center">
        <div class="col-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck2">
            <label class="custom-control-label" for="customCheck2">Altura</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck3">
            <label class="custom-control-label" for="customCheck3">Peso</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck4">
            <label class="custom-control-label" for="customCheck4">Teperatura</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck5">
            <label class="custom-control-label" for="customCheck5">Frecuencia cardiaca</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck6">
            <label class="custom-control-label" for="customCheck6">Frecuencia respiratoria</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck7">
            <label class="custom-control-label" for="customCheck7">Oxigenación</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck8">
            <label class="custom-control-label" for="customCheck8">Indice de masa corporal</label>
          </div>
        </div>
        <div class="col-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck9">
            <label class="custom-control-label" for="customCheck9">Perimetro cefalico</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck10">
            <label class="custom-control-label" for="customCheck10">Porcentaje de masa muscular</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck11">
            <label class="custom-control-label" for="customCheck11">Cintura</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck12">
            <label class="custom-control-label" for="customCheck12">Cadera</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck13">
            <label class="custom-control-label" for="customCheck13">Pierna</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck14">
            <label class="custom-control-label" for="customCheck14">Brazo</label>
          </div>
        </div>
        <hr>
      </div>
      <div class="row mt-3">
        <div class="col-8">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Escriba aquí si quiere agregar mas">
          </div>
        </div>
        <div class="col-4">
          <a href="" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-config-green" data-dismiss="modal">Atras</button>
      <button type="button" class="btn btn-config-blue">Agregar</button>
    </div>
  </div>
</div>
</div>
<!-- Modal test-laboratory-->
<div class="modal fade bd-example-modal-lg" id="test-laboratory2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title font-title text-center" id="exampleModalLabel">Configura las que utilices</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row align-self-center">
        <div class="col-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck15">
            <label class="custom-control-label" for="customCheck15">Altura</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck16">
            <label class="custom-control-label" for="customCheck16">Peso</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck17">
            <label class="custom-control-label" for="customCheck17">Teperatura</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck18">
            <label class="custom-control-label" for="customCheck18">Frecuencia cardiaca</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck19">
            <label class="custom-control-label" for="customCheck19">Frecuencia respiratoria</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck20">
            <label class="custom-control-label" for="customCheck20">Oxigenación</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck21">
            <label class="custom-control-label" for="customCheck21">Indice de masa corporal</label>
          </div>
        </div>
        <div class="col-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck22">
            <label class="custom-control-label" for="customCheck22">Perimetro cefalico</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck23">
            <label class="custom-control-label" for="customCheck23">Porcentaje de masa muscular</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck24">
            <label class="custom-control-label" for="customCheck24">Cadera</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck25">
            <label class="custom-control-label" for="customCheck25">Pierna</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck26">
            <label class="custom-control-label" for="customCheck26">Brazo</label>
          </div>
        </div>
        <hr>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <a href="">Mis parametros de monitoreo</a>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre de mis parametros de laboratorio">
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <input type="text" class="form-control" placeholder="Abreviatura">
        </div>
        <div class="col-lg-3 col-6">
          <a href="" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-config-green" data-dismiss="modal">Atras</button>
      <button type="button" class="btn btn-config-blue">Agregar</button>
    </div>
  </div>
</div>
</div>
