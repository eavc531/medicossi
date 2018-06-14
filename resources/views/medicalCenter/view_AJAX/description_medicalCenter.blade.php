<div style="height:120px;border:1 px solid;"class="text-left" id=" text-justify">
  <p id="description_text">{{$medicalCenter->description}}</p>
  @if($medicalCenter->description == null )
    <button data-toggle="modal" data-target="#modal-service2" class="btn btn-primary text-left">Añadir Descripción</button>
  @else
  <button data-toggle="modal" data-target="#modal-service2" class="btn btn-success text-left">Editar Descripción</button>
  @endif
</div>
