<!-- Modal -->
<div class="modal fade" id="modal-end-consult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-title" id="exampleModalLabel">Agregar monto de la consulta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <div class="row">
        <div class="col-12">
           <label for="form-control">Indique precio de consulta</label>
       </div>
       <div class="input-group col-lg-8 col-12 mb-3">
           <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
           <div class="input-group-append">
               <span class="input-group-text">$</span>
           </div>
       </div>
       <hr>
   </div>
   <div class="row">
       <div class="col-12">
           <label for="" class="font-title">Confirmada con paciente</label>
       </div>
   </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-config-green" data-dismiss="modal">Atras</button>
    <button type="button" class="btn btn-config-blue">Confirmar pago</button>
</div>
</div>
</div>
</div>

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
Launch demo modal
</button> --}}

<!-- ///////////////////////////Modal CREATE-Modal CREATE-Modal CREATE-Modal CREATE-Modal CREATE-->
<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align:justify">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bg-primary" style="color:white">
      <h5 class="modal-title" id="exampleModalLabel">Crear Evento</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      {!!Form::open(['route'=>'medico_diary.store','method'=>'POST'])!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      <div class="form-group">
        <label for="">Tipo de Evento</label>
        {!!Form::select('eventType',['Cita Medica'=>'Cita Médica','Cita Medica Importante'=>'Cita Médica Importante','Consulta Medica'=>'Consulta Médica','Consulta Medica Importante'=>'Consulta Médica Importante','Recordatorio'=>'Recordatorio'],null,['class'=>'form-control','id'=>'eventType'])!!}
      </div>
      <div class="form-group">
        <label for="">Titulo</label>
        {!!Form::text('title',null,['class'=>'form-control','id'=>'title'])!!}
      </div>
      <div class="form-group">
        <label for="">Descripción (Opcional)</label>
        {!!Form::text('description',null,['class'=>'form-control','id'=>'description'])!!}
      </div>

      <div class="form-group">
        <label for="">Precio:</label>
        {!!Form::number('price',null,['class'=>'form-control','id'=>'price'])!!}
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-6">
            <label for="">Inicio</label>
            {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start'])!!}
          </div>
          <div class="col-6">
            <label for="">Culminación (Opcional)</label>
            {!!Form::date('date_End',null,['class'=>'form-control','id'=>'date_End'])!!}
          </div>
        </div>

      </div>
      <div class="form-group">
        <div class="form-inline">
        <label for="">Hora de Inicio</label>
          {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStart'])!!}
            {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStart'])!!}
          </div>
      </div>



      <div class="form-group">
        <div class="form-inline">
        <label for="">Hora de Culminación (Opcional)</label>
          {!!Form::select('hourEnd',['--'=>'--','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEnd'])!!}
            {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEnd'])!!}
          </div>
      </div>

      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
      {!!Form::close()!!}
    </div>
  </div>
  </div>
</div>

<!-- /////////Modal EDITARRRR-Modal EDITARRRR-Modal EDITARRRR-///////////////////Modal EDITARRRR-->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align:justify">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Editar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>['medico_diary.update',$medico->id],'method'=>'PUT'])!!}
        {!!Form::hidden('medico_id',$medico->id)!!}
        {!!Form::hidden('event_id',null,['id'=>'event_id'])!!}
        <div class="form-group">
          <label for="">Tipo de Evento</label>
          {!!Form::select('eventType',['Cita Medica'=>'Cita Médica','Cita Medica Importante'=>'Cita Médica Importante','Consulta Medica'=>'Consulta Médica','Consulta Medica Importante'=>'Consulta Médica Importante','Recordatorio'=>'Recordatorio'],null,['class'=>'form-control','id'=>'title'])!!}
        </div>
        <div class="form-group">
          <label for="">Titulo</label>
          {!!Form::text('title',null,['class'=>'form-control','id'=>'titleUp'])!!}
        </div>
        <div class="form-group">
          <label for="">Descripción</label>
          {!!Form::text('description',null,['class'=>'form-control','id'=>'descriptionUp'])!!}
        </div>
        <div class="form-group">
          <label for="">Precio:</label>
          {!!Form::number('price',null,['class'=>'form-control','id'=>'priceUp'])!!}
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label for="">Fecha de inicio</label>
              {!!Form::date('date_start',null,['class'=>'form-control','id'=>'dateStartUp'])!!}
            </div>
            <div class="col-6">
              <label for="">Culminación (Opcional)</label>
              {!!Form::date('date_End',null,['class'=>'form-control','id'=>'date_End'])!!}
            </div>
          </div>
        </div>

        <div class="form-group">

        </div>
        <div class="form-group">
          <div class="form-inline">
          <label for="">Hora de Inicio:</label>
            {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStartUp'])!!}
              {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStartUp'])!!}
            </div>
        </div>

        <div class="form-group">
          <div class="form-inline">
          <label for="">Hora de Culminación (Opcional): </label>
            {!!Form::select('hourEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp'])!!}
              {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEndUp'])!!}
            </div>
        </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>

        {!!Form::close()!!}
        {!!Form::open(['route'=>['medico_diary.destroy',$medico->id],'method'=>'DELETE'])!!}
        {!!Form::hidden('event_id',null,['id'=>'event_id_destroy'])!!}

          <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estas Segur@ de querer Eliminar este Evento?')">Eliminar</button>
        {!!Form::close()!!}
      </div>
    </div>
    </div>
  </div>
