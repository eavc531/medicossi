<div class="row mt-5">
  <div class="col-10">
    <h6>¿Desea que se mande un mensaje de recordatorio a sus pacientes con citas confirmadas?</h6>

  </div>
  <div class="col-2">
    <div class="radio-switch">
      @if($reminder_confirmed != Null)
        @if ($reminder_confirmed->options == Null or $reminder_confirmed->options == 'No')
          <div class="radio-switch-field">

            <input id="switch-off" type="radio" name="radio-switch" value="No" checked onclick="switch_reminder1('No')">
            <label for="switch-off">No</label>
          </div>
          <div class="radio-switch-field">
            <input id="switch-on" type="radio" name="radio-switch" value="Si"  onclick="switch_reminder1('Si')">
            <label for="switch-on">Si</label>
          </div>
        @else
          <div class="radio-switch-field">
            <input id="switch-off" type="radio" name="radio-switch" value="off"  onclick="switch_reminder1('No')">
            <label for="switch-off">No</label>
          </div>
          <div class="radio-switch-field">
            <input id="switch-on" type="radio" name="radio-switch" value="on" checked onclick="switch_reminder1('Si')">
            <label for="switch-on">Si</label>
          </div>
        @endif
      @else
        <div class="radio-switch-field">

          <input id="switch-off" type="radio" name="radio-switch" value="No" checked onclick="switch_reminder1('No')">
          <label for="switch-off">No</label>
        </div>
        <div class="radio-switch-field">
          <input id="switch-on" type="radio" name="radio-switch" value="Si"  onclick="switch_reminder1('Si')">
          <label for="switch-on">Si</label>
        </div>
      @endif
    </div>
  </div>
</div>

@if($reminder_confirmed != Null and $reminder_confirmed->options == 'Si')
  {!!Form::model($reminder_confirmed,['route'=>'medico.store','method'=>'POST'])!!}
     {!!Form::radio('days_before','1',null,['onclick'=>'reminder_time_confirmed(1)'])!!}

      <label class="custom-control-label" for="customRadioInline1">1 Dia Antes</label>

      {!!Form::radio('days_before','2',null,['onclick'=>'reminder_time_confirmed(2)'])!!}
      <label class="custom-control-label" for="customRadioInline2">2 Dia Antes</label>

      {!!Form::radio('days_before','4',null,['onclick'=>'reminder_time_confirmed(4)'])!!}
      <label class="custom-control-label" for="customRadioInline3">4 dia antes</label>

  {!!Form::close()!!}
@else
  <div class="col-12" id="open-check" style="display:none;">
    <div class="custom-control custom-radio custom-control-inline">
      <input value="" type="radio" id="customRadioInline1" name="tyme_before" class="custom-control-input" onclick="reminder_time_confirmed('1h')">
      <label class="custom-control-label" for="customRadioInline1">Una hora antes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInline2" name="tyme_before" class="custom-control-input" onclick="reminder_time_confirmed('5h')">
      <label class="custom-control-label" for="customRadioInline2">5 horas antes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInline3" name="1d" class="custom-control-input" onclick="reminder_time_confirmed('1d')">
      <label class="custom-control-label" for="customRadioInline3">1 dia antes</label>
    </div>
  </div>
@endif


<div class="row my-5">
  <div class="col-lg-10 col-12 align-items-center">
    <h6>¿Desea que las citas que han sido pagadas con anticipacion, se marquen como completadas automaticamente despues de pasar la fecha de la misma?</h6>
  </div>
  <div class="col-lg-2 col-12">
    <div class="col-lg-2 col-12">
      <div class="radio-switch">
        @if ($config_past_and_payment_auto != Null)
          @if($config_past_and_payment_auto->options == 'Si')
            <label for="switch-off">No</label>
            <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('No')">
            <label for="switch-off">Si</label>
            <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('Si')" checked>
          @else
            <label for="switch-off">No</label>
            <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('No')" checked>
            <label for="switch-off">Si</label>
            <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('Si')">
          @endif
        @else
          <label for="switch-off">No</label>
          <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('No')" checked>
          <label for="switch-off">Si</label>
          <input type="radio" name="switch_payment_and_past" value="" onclick="switch_payment_and_past('Si')">
        @endif
      </div>
    </div>
  </div>
</div>
