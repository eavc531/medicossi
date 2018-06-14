<div class="modal fade" id="modalresendMailConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reenviar Correo de Confiramción</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         {!!Form::open(['route'=>'resendMailMedicoConfirm', 'method'=>'POST'])!!}
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="form-group">
               <label for=""><strong>Reenviar Correo de Confirmación</strong></label>
               {!!Form::email('email',$user->email,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico Asociado', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
            </div>

            <div class="form-group col-sm-12">
               {!!Form::submit('Reenviar',['class'=>'btn btn-primary'])!!}
               <a style=""class="btn btn-default" href="{{route('home')}}"><strong>Cancelar</strong>
               </a>
            </div>


         {!!Form::close()!!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>

      </div>
    </div>
  </div>
</div>
