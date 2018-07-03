{{-- Botones redes sociales. --}}
<div class="row">
  <div class="col-lg-12 col-12 m-auto">
    @if ($social_networks->first() == Null)
      <h5 style="color:rgb(212, 212, 212)">No posee direcciónes de redes sociales registradas</h5>
    @else
      <div class="row">


        @foreach ($social_networks as $social)

          @if($social->name == 'Facebook')
            <div class="card col-4">
              <div class="form-inline">
                <a href="{{$social->link}}" class="btn btn-primary my-2" id="facebook"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
                <button onclick="social_network_delete('{{$social->id}}')" class="btn badge badge-danger ml-auto"><i class="fas fa-ban fa-2x"></i></button>
              </div>

            </div>


          @elseif($social->name == 'Twiter')
            <div class="card col-4">
              <div class="form-inline">
              <a href="{{$social->link}}" class="btn btn-info my-2" id="facebook"><i class="fab fa-facebook-f mr-2"></i>Twiter</a><button onclick="social_network_delete('{{$social->id}}')" class="btn badge badge-danger ml-auto"><i class="fas fa-ban fa-2x"></i></button>
            </div>

          </div>

          @elseif($social->name == 'Instagram')
            <div class="card col-4">
              <div class="form-inline">
              <a href="btn" class="btn btn-light my-2" id="instagram"><i class="fab fa-instagram mr-2"></i>Instagram</a></a><button onclick="social_network_delete('{{$social->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
            </div>
          </div>
          @endif
        @endforeach

    @endif
</div>
