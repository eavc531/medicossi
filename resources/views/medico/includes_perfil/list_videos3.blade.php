SON MAXIMO 4 VIDEOS AJUSTALOS Y BORRA ESTE TEXTO CUANDO LO HAGAS, ESTA VISTA ES CON AJAX SE ENCUENTRA EN MEDICO/includes_perfil/list_videos
@foreach ($videos as $video)

  <div class="row">
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          <button onclick="delete_video('{{$video->id}}')" type="button" name="button" class="close">x</button onclick="delete_video()">
        </div>
        <div class="card-body">
            <iframe width="220" height="170" src="{{$video->link}}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="card-footer">
          <strong>{{$video->name}}</strong>
        </div>
      </div>
    </div>
  </div>
@endforeach
