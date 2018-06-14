{{-- lista servicios otorgados edit. --}}



  <div class="row">
    <div class="col-lg-8 col-12 m-auto">
      <ul class="list-group">
          @foreach ($services as $service)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          {{$service->name}}
          <button onclick="medico_service_delete('{{$service->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
        </li>
      @endforeach

      </ul>
    </div>
  </div>
