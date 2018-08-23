<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte Salubridad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="">No has realizado el reporte de salubridad para este Médico.</p>
        <p class="text-primary">¿Te gustaria crearlo ahora mismo utilizando el diagnostico de la nota actual?</p>
        {{Form::textarea('diagnostic_modal',null,['id'=>'text_diagnostic','class'=>'form-control area'])}}

        <p id="alert_campo" class="text-danger" style="font-size:11px"></p>
        <div class="mt-3">
            <button type="button" class="btn btn-success" onclick="submitform(this)" value="si">Si y continuar</button>
            <button type="button" class="btn btn-primary" onclick="submitform(this)" value="no">No y continar</button>
            <button type="button" class="btn btn-warning" value="no_preguntar" onclick="submitform(this)">No Volver a preguntar</button>
        </div>
      </div>
      <div class="modal-footer">


              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="display:in-line-block">Cancelar</button>


      </div>
    </div>
  </div>
</div>
