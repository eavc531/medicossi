<div class="modal fade" id="app_cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


        {{Form::open(['route'=>'cancel_appointment','method'=>'POST'])}}
        <input type="hidden" name="send" value="enviar">
        <input type="hidden" name="event_id" value="{{$event_edit->id}}">
        <button onclick="$(this).parents('#app_cancel').modal('hide');loader()" type="submit" class="btn btn-warning btn-block">Rechazar y enviar correo notificacion a paciente</button>
        {{Form::close()}}

        {{Form::open(['route'=>'cancel_appointment','method'=>'POST'])}}
        <input type="hidden" name="send" value="no_enviar">
        <input type="hidden" name="event_id" value="{{$event_edit->id}}">
        <button onclick="$(this).parents('#app_cancel').modal('hide');loader()" type="submit" class="btn btn-danger btn-block mt-2">Solo Rechazar</button>

        {{Form::close()}}
        {{-- <a href="#" class="btn btn-secondary btn-block">cancelar proceso</a> --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      </div>
    </div>
  </div>
</div>
