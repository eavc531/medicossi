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
                  <a href="{{route('note_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id])}}" class="btn btn-primary mr-1 btn-sm "><i class="fas fa-plus"></i></a>
                  <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id])}}" class="btn btn-secondary mr-1 btn-sm "><i class="fas fa-cog"></i></a>

              </div>
            </div>
          </div>
        

@endforeach
</div>
</div>
