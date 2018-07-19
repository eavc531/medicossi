
<!-- Modal -->
<div class="modal fade" id="mail_cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Rechazar/Cancelar Cita médica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro de cancelar/Rechazar este evento?</p>
        <button class="btn btn-warning btn-block" onclick="cancel('enviar')">Rechazar y enviar mail notificacion a paciente</button>
        <button class="btn btn-danger btn-block" onclick="cancel('no_enviar')">Solo Rechazar</button>
        {{-- <a href="#" class="btn btn-secondary btn-block">cancelar proceso</a> --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      </div>
    </div>
  </div>
</div>
