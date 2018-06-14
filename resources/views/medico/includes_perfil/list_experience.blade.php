{{-- Botones redes sociales. --}}

<div class="row">
  <div class="col-lg-11 col-12 m-auto">
    <div class="card" style="max-height:300px;overflow:scroll;overflow-x:hidden;">

        @foreach ($experiences as $experience)
        <div class="mt-1 p-2" style="border:1px solid rgb(173, 178, 180);border-radius:5px">
          <button onclick="medico_experience_delete('{{$experience->id}}')" class="close text-danger">x</button>
          <i class="fas fa-angle-double-right"></i><span class="ml-3">{{$experience->name}}</span>
        </div>
        @endforeach


    </div>
  </div>
</div>
