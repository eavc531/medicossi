<div class="row">
  <div class="col-lg-8 col-12 m-auto">
    <ul class="list-group">
    @foreach ($specialties as $specialty)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{$specialty->name}}
        <button onclick="medical_specialty_delete('{{$specialty->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
    @endforeach

    </ul>
  </div>
</div>
