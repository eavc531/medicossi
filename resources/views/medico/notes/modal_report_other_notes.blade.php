


{{-- /////////NO SE ESTA USANDO SE PEGO DIRECTAMENTE EN MAIN NOTES OTHER --}}


{{-- /////////NO SE ESTA USANDO SE PEGO DIRECTAMENTE EN MAIN NOTES OTHER --}}{{-- /////////NO SE ESTA USANDO SE PEGO DIRECTAMENTE EN MAIN NOTES OTHER --}}{{-- /////////NO SE ESTA USANDO SE PEGO DIRECTAMENTE EN MAIN NOTES OTHER --}}{{-- /////////NO SE ESTA USANDO SE PEGO DIRECTAMENTE EN MAIN NOTES OTHER --}}{{-- /////////NO SE ESTA USANDO SE PEGO DIRECTAMENTE EN MAIN NOTES OTHER --}}


















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
        {{Form::open(['route'=>'store_report','method'=>'POST'])}}
        {{Form::textarea('diagnostic_report',null,['id'=>'text_diagnostic','class'=>'form-control area'])}}
        <input type="hidden" name="url" value="" id="url_form">
        <input type="hidden" name="medico_id" value="{{$medico->id}}">
        <input type="hidden" name="patient_id" value="{{$patient->id}}">

        <p id="alert_campo" class="text-danger" style="font-size:11px"></p>
        <div class="mt-3">
            <button name="button" type="submit" class="btn btn-success" onclick="validate_question()" value="si">Guardar Reporte</button>

            <button name="button" type="submit" class="btn btn-success" value="no">No y Continuar</button>
            <button name="button" type="button" class="btn btn-warning" value="no_preguntar" onclick="submitform(this)">No y no Volver a preguntar</button>
        {{Form::close()}}
        </div>
      </div>
      <div class="modal-footer">


              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="display:in-line-block">Cancelar</button>


      </div>
    </div>
  </div>
</div>
