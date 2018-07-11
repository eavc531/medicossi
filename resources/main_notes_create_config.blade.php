<div class="mb-3">


  <div class="btn-group">

    <button type="button" class="btn btn-primary">Agregar Nota a Expediente</button>
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

            @if($note->title == 'Nota Médica Inicial')
              <div class="col-4">

                <form class="line" action="{{route('note_medic_ini_create')}}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="medico_id" value="{{$medico->id}}">
                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                  <input type="hidden" name="note_id" value="{{$note->id}}">
                  <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
                  <button type="submit" name="button" class="btn btn-primary mr-1 btn-sm "><i class="fas fa-plus"></i></button>
                </form>
                <form class="line" action="{{route('note_config')}}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="medico_id" value="{{$medico->id}}">
                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                  <input type="hidden" name="note_id" value="{{$note->id}}">
                  <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
                  <button type="submit" name="button" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></button>
                </form>


              </div>
            </div>
          </div>
        @elseif($note->title == 'Nota Médica de Evolucion')
          <div class="col-4">
            <form class="line" action="{{route('note_evo_create')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="medico_id" value="{{$medico->id}}">
              <input type="hidden" name="patient_id" value="{{$patient->id}}">
              <input type="hidden" name="note_id" value="{{$note->id}}">
              <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
              <button type="submit" name="button" class="btn btn-primary mr-1 btn-sm"><i class="fas fa-plus"></i></button>
            </form>

            <form class="line" action="{{route('note_config')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="medico_id" value="{{$medico->id}}">
              <input type="hidden" name="patient_id" value="{{$patient->id}}">
              <input type="hidden" name="note_id" value="{{$note->id}}">
              <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
              <button type="submit" name="button" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></button>
            </form>

          </div>
        </div>
      </div>
    @elseif($note->title == 'Nota de Interconsulta')
      <div class="col-4">
        <form class="line" action="{{route('note_inter_create')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="medico_id" value="{{$medico->id}}">
          <input type="hidden" name="patient_id" value="{{$patient->id}}">
          <input type="hidden" name="note_id" value="{{$note->id}}">
          <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
          <button type="submit" name="button" class="btn btn-primary mr-1 btn-sm"><i class="fas fa-plus"></i></button>
        </form>
        <form class="line" action="{{route('note_config')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="medico_id" value="{{$medico->id}}">
          <input type="hidden" name="patient_id" value="{{$patient->id}}">
          <input type="hidden" name="note_id" value="{{$note->id}}">
          <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
          <button type="submit" name="button" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></button>
        </form>

      </div>
    </div>
  </div>
@elseif($note->title == 'Nota médica de Urgencias')
  <div class="col-4">
    <form class="line" action="{{route('note_urgencias_create')}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="medico_id" value="{{$medico->id}}">
      <input type="hidden" name="patient_id" value="{{$patient->id}}">
      <input type="hidden" name="note_id" value="{{$note->id}}">
      <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
      <button type="submit" name="button" class="btn btn-primary mr-1 btn-sm"><i class="fas fa-plus"></i></button>
    </form>
    <form class="line" action="{{route('note_config')}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="medico_id" value="{{$medico->id}}">
      <input type="hidden" name="patient_id" value="{{$patient->id}}">
      <input type="hidden" name="note_id" value="{{$note->id}}">
      <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
      <button type="submit" name="button" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></button>
    </form>

  </div>
</div>
</div>
@elseif($note->title == 'Nota médica de Egreso')
<div class="col-4">
<form class="line" action="{{route('note_egreso_create')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="medico_id" value="{{$medico->id}}">
  <input type="hidden" name="patient_id" value="{{$patient->id}}">
  <input type="hidden" name="note_id" value="{{$note->id}}">
  <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
  <button type="submit" name="button" class="btn btn-primary mr-1 btn-sm"><i class="fas fa-plus"></i></button>
</form>
<form class="line" action="{{route('note_config')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="medico_id" value="{{$medico->id}}">
  <input type="hidden" name="patient_id" value="{{$patient->id}}">
  <input type="hidden" name="note_id" value="{{$note->id}}">
  <input type="hidden" name="expedient_id" value="{{$expedient->id}}">
  <button type="submit" name="button" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></button>
</form>

</div>
</div>
</div>
@elseif($note->title == 'Nota de Referencia o traslado')
<div class="col-4">
<form class="line" action="{{route('note_referencia_create')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="medico_id" value="{{$medico->id}}">
<input type="hidden" name="patient_id" value="{{$patient->id}}">
<input type="hidden" name="note_id" value="{{$note->id}}">
<input type="hidden" name="expedient_id" value="{{$expedient->id}}">
<button type="submit" name="button" class="btn btn-primary mr-1 btn-sm"><i class="fas fa-plus"></i></button>
</form>
<form class="line" action="{{route('note_config')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="medico_id" value="{{$medico->id}}">
<input type="hidden" name="patient_id" value="{{$patient->id}}">
<input type="hidden" name="note_id" value="{{$note->id}}">
<input type="hidden" name="expedient_id" value="{{$expedient->id}}">
<button type="submit" name="button" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></button>
</form>

</div>
</div>
</div>
@endif

@endforeach

</div>
</div>
