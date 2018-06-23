@foreach ($videos as $video)

  <div class="row">
    <div class="col-4" style="max-width: 100%;">
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
