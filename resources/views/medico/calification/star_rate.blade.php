@if($medico->calification >= 1 and  $medico->calification < 1.5)
  <div class="row">
    <div class="col-12">
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
    </div>
  </div>
@elseif($medico->calification >= 1.5 and $medico->calification < 2 )
  <div class="row">
    <div class="col-12">
      <span class="fa fa-star checked"></span>
      <span><i class="fas fa-star-half-alt checked"></i></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
    </div>
  </div>
@elseif($medico->calification >= 2 and $medico->calification < 2.5 )
    <div class="row">
      <div class="col-12">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
    </div>
@elseif($medico->calification >= 2.5 and $medico->calification < 3 )
    <div class="row">
      <div class="col-12">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span><i class="fas fa-star-half-alt checked"></i></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
    </div>
@elseif($medico->calification >= 3 and $medico->calification < 3.5)
      <div class="row">
        <div class="col-12">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
        </div>
      </div>
  @elseif($medico->calification >= 3.5 and $medico->calification < 4 )
      <div class="row">
        <div class="col-12">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span><i class="fas fa-star-half-alt checked"></i></span>
          <span class="fa fa-star"></span>
        </div>
      </div>
  @elseif($medico->calification >= 4 and $medico->calification < 4.5)
        <div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
          </div>
        </div>
    @elseif($medico->calification >= 4.5 and $medico->calification < 5 )
        <div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span><i class="fas fa-star-half-alt checked"></i></span>
          </div>
        </div>
      @elseif($medico->calification == 5)
        <div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
          </div>
        </div>
      @endif
