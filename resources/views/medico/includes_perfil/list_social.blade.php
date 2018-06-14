{{-- Botones redes sociales. --}}
<div class="row">
  <div class="col-lg-8 col-12 m-auto">
    <ul class="list-group">
      @foreach ($social_networks as $social)
        @if($social->name == 'Facebook')
          <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="{{$social->link}}" class="btn btn-primary my-2" id="facebook"><i class="fab fa-facebook-f mr-2"></i>Facebook</a><button onclick="social_network_delete('{{$social->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
          </li>
        @elseif($social->name == 'Twiter')
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{$social->link}}" class="btn btn-info my-2" id="facebook"><i class="fab fa-facebook-f mr-2"></i>Twiter</a><button onclick="social_network_delete('{{$social->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
            </li>

        @elseif($social->name == 'Instagram')
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="btn" class="btn btn-light my-2" id="instagram"><i class="fab fa-instagram mr-2"></i>Instagram</a></a><button onclick="social_network_delete('{{$social->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
            </li>
        @endif
      @endforeach
    </ul>
  </div>

  </div>
