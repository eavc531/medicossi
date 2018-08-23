<div class="mb-3">
  <div class="btn-group">

    <button type="button" class="btn btn-primary">Agregar Nota</button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">

      @foreach ($notes_pre as $note)
        <div class="dropdown-item" style="border:solid 1px rgb(187, 178, 178);background:rgb(231, 240, 249)">
          <div class="row col-12">
            <div class="col-8">
              <span class="mr-3">{{$note->title}}</span>
            </div>


              <div class="col-4">
                  <button onclick="verify_report(this)" type="button" name="{{route('note_create',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'n_id'=>\Hashids::encode($note->id)])}}" id="{{$note->title}}" class="btn btn-primary mr-1 btn-sm "><i class="fas fa-plus"></i></button>
                  {{-- <a onclick="verify_report(this)" href="{{route('note_create',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'n_id'=>\Hashids::encode($note->id)])}}" value="{{$note->title}}" class="btn btn-primary mr-1 btn-sm "><i class="fas fa-plus"></i></a> --}}
                  <a href="{{route('note_config',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id),'n_id'=>\Hashids::encode($note->id)])}}" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></a>

              </div>
            </div>
          </div>


@endforeach
</div>
</div>


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
        <p class="text-primary">¿Te gustaria crearlo ahora mismo?</p>
        {{Form::open(['route'=>'store_report','method'=>'POST','id'=>'form-report'])}}
        {{Form::textarea('diagnostic_report',null,['id'=>'text_diagnostic','class'=>'form-control area'])}}
        <input type="hidden" name="url" value="" id="url_form">
        <input type="hidden" name="medico_id" value="{{$medico->id}}">
        <input type="hidden" name="patient_id" value="{{$patient->id}}">

        <p id="alert_campo" class="text-danger" style="font-size:11px"></p>
        <div class="mt-3">
        {{Form::close()}}
        <button onclick="verify_empty(this);" name="button" type="button" class="btn btn-success" onclick="validate_question()" value="si">Guardar Reporte</button>

        <button onclick="verify_empty(this);" name="button" type="button" class="btn btn-success" value="no">No y Continuar</button>
        <button onclick="verify_empty(this);" name="button" type="button" class="btn btn-warning" value="no_preguntar" >No y no Volver a preguntar</button>
        </div>
      </div>
      <div class="modal-footer">


              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="display:in-line-block">Cancelar</button>


      </div>
    </div>
  </div>
</div>
