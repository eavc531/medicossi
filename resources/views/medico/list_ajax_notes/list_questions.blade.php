{{-- lista servicios otorgados edit. --}}



  <div class="row">
    <div class="col-lg-8 col-12 m-auto">
      <ul class="list-group">
          @foreach ($questions as $service)

        <li>{{$service->question}}
        {{Form::text($service->id,null,)}}
        </li>
      @endforeach

      </ul>
    </div>
  </div>
