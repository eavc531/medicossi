@extends('layouts.app')

@section('content')

  <div class="container my-2">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="font-title">Subscripción al plán "{{$plan->name}}"</h2>
        <h5 class="my-4">Selecciona el metodo de pago de su plán "{{$plan->name}}"</h5>
      </div>
    </div>
    <div class="text-right">
      <a href="{{route('planes_medic',$medico->id)}}" class="btn btn-secondary">Vovler</a>
    </div>
    <div class="row my">
      <div class="col-12 col-lg-10 m-lg-auto">
        <div class="radio-tile-group">
          <div class="input-container">
            <input class="radio-button" type="radio" name="radio" value="{{$plan->price3}}" onclick="selec_price(this)" id="anual"/>
            <div class="radio-tile">
              <div class="icon walk-icon">
                <i class="fas fa-check fa-3x"></i>
              </div>
              <label for="walk" class="radio-tile-label">Anual</label>
              <p class="radio-tile-label2"><b>{{$plan->price3}} MXN</b></p>
            </div>
          </div>
          <div class="input-container">
              <input class="radio-button" type="radio" name="radio" value="{{$plan->price2}}" onclick="selec_price(this)" id="6 meses"/>
            <div class="radio-tile" >
              <div class="icon">
                <i class="fas fa-check fa-3x"></i>
              </div>
              <label for="bike" class="radio-tile-label">6 Meses</label>
              <p class="radio-tile-label2"><b>{{$plan->price2}} MXN</b></p>
            </div>
          </div>
          <div class="input-container">
              <input class="radio-button" type="radio" name="radio" value="{{$plan->price1}}" onclick="selec_price(this)" id="mensual"/>
            <div class="radio-tile" >
              <div class="icon car-icon">
                <i class="fas fa-check fa-3x"></i>
              </div>
              <label for="drive" class="radio-tile-label">Mensual</label>
              <p class="radio-tile-label2"><b>{{$plan->price1}} MXN</b></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">
      <div class="col-12 col-lg-8 m-lg-auto">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="form-group ml-4" id="div_impuestos" style="display:none">
              <label class="">Importe total <span id="import_total"></span> MXN (Con impuestos incluidos)</label>
            </div>
            <div class="form-group ml-4">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Renovación automatica</label>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 align-self-center text-center">
            {!!Form::open(['route'=>'set_plan','method'=>'POST'])!!}
            {!!Form::hidden('medico_id',$medico->id,['id'=>'m_id'])!!}
            {!!Form::hidden('namePlan',$plan->name,['id'=>'namePlan'])!!}
            {!!Form::hidden('pricePlan',null,['id'=>'pricePLan'])!!}
            {!!Form::hidden('period',null,['id'=>'period'])!!}
            <button type="submit" name="button" class="btn btn-primary">Continuar</button>
            {!!Form::close()!!}

         </div>
       </div>
     </div>
   </div>
 </div>

@endsection

@section('scriptJS')
  <script type="text/javascript">
    function selec_price(result){

      $('#pricePLan').val(result.value);
      $('#period').val(result.id);
      $('#div_impuestos').show();
      $('#import_total').html(result.value);

    }
  </script>
@endsection
