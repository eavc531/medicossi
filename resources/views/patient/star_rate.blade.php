@if($you_rate->rate == 1)
  <div class="row">
    <div class="col-12">
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
    </div>
  </div>
@elseif($you_rate->rate > 1.5 and $you_rate->rate < 2 )
  <div class="row">
    <div class="col-12">
      <span class="fa fa-star checked"></span>
      <i class="fas fa-star-half checked"></i>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
    </div>
  </div>
  @elseif($you_rate->rate == 2)
    <div class="row">
      <div class="col-12">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
    </div>
  @elseif($you_rate->rate > 2.5 and $you_rate->rate < 3 )
    <div class="row">
      <div class="col-12">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <i class="fas fa-star-half checked"></i>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
    </div>
    @elseif($you_rate->rate == 3)
      <div class="row">
        <div class="col-12">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
        </div>
      </div>
    @elseif($you_rate->rate > 3.5 and $you_rate->rate < 4 )
      <div class="row">
        <div class="col-12">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <i class="fas fa-star-half checked"></i>
          <span class="fa fa-star"></span>
        </div>
      </div>
      @elseif($you_rate->rate == 4)
        <div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
          </div>
        </div>
      @elseif($you_rate->rate > 4.5 and $you_rate->rate < 5 )
        <div class="row">
          <div class="col-12">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <i class="fas fa-star-half checked"></i>
          </div>
        </div>
      @elseif($you_rate->rate == 5)
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
