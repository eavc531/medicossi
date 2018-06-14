
@if($medico['calification'] == 1)
  <h4><div class="row">
    <div class="col-12">
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
    </div>
  </div></h4>
@elseif($medico['calification'] > 1.5 and $medico['calification'] < 2 )
  <h4><div class="row">
    <div class="col-12">
      <span class="fa fa-star checked"></span>
      <i class="fas fa-star-half checked"></i>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
    </div>
  </div></h4>
  @elseif($medico['calification'] == 2)
    <h4>
      <div class="row">
      <div class="col-12">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
    </div>
  </h4>


  @elseif($medico['calification'] > 2.5 and $medico['calification'] < 3 )
    <h4><div class="row">
      <div class="col-12">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <i class="fas fa-star-half checked"></i>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
    </div></h4>
    @elseif($medico['calification'] == 3)
      <h4><div class="row">
        <div class="col-12">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
        </div>
      </div></h4>
    @elseif($medico['calification'] > 3.5 and $medico['calification'] < 4 )
      <h4><div class="row">
        <div class="col-12">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <i class="fas fa-star-half checked"></i>
          <span class="fa fa-star"></span>
        </div>
      </div></h4>
      @elseif($medico['calification'] == 4)
        <h4><div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
          </div>
        </div></h4>
      @elseif($medico['calification'] > 4.5 and $medico['calification'] < 5 )
        <h4><div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <i class="fas fa-star-half checked"></i>
          </div>
        </div></h4>
      @elseif($medico['calification'] == 5)
        <h4><div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
          </div>
        </div></h4>
      @else
        (Aun sin calificar)
      @endif
