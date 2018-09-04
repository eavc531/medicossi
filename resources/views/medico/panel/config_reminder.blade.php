<div class="row mt-5">
  <div class="col-9">
    <h6>¿Desea que se mande un mensaje de recordatorio a sus pacientes con citas confirmadas?</h6>

  </div>
  <div class="col-3">
    <div class="radio-switch">
      @if($reminder_confirmed != Null)
        @if ($reminder_confirmed->options == Null or $reminder_confirmed->options == 'No')

             <label class="switch" style="display:block;margin-left:auto;">
                {{Form::checkbox('name',$reminder_confirmed->options, false,['onclick'=>'switch_reminder1(this)','id'=>$medico->id])}}
                <span class="slider round text-white"><span class="ml-1">on</span> of</span>
             </label>
         @else
             <label class="switch" style="display:block;margin-left:auto;">
                {{Form::checkbox('name',$reminder_confirmed->options, true,['onclick'=>'switch_reminder1(this)','id'=>$medico->id])}}
                <span class="slider round text-white"><span class="ml-1">on</span> of</span>
             </label>
         @endif
      @endif
    </div>
  </div>
</div>

@if($reminder_confirmed != Null and $reminder_confirmed->options == 'Si')
  <div class="time-check">
      {!!Form::model($reminder_confirmed,['route'=>'medico.store','method'=>'POST'])!!}
         {!!Form::radio('times_before','1',null,['onclick'=>'reminder_time_confirmed(1)'])!!}

          <label class="custom-control-label" for="customRadioInline1">1 Dia Antes</label>

          {!!Form::radio('times_before','2',null,['onclick'=>'reminder_time_confirmed(2)'])!!}
          <label class="custom-control-label" for="customRadioInline2">2 Dia Antes</label>

          {!!Form::radio('times_before','4',null,['onclick'=>'reminder_time_confirmed(4)'])!!}
          <label class="custom-control-label" for="customRadioInline3">4 dia antes</label>

      {!!Form::close()!!}
  </div>
@else
    <div class="time-check" style="display:none">
    {!!Form::model($reminder_confirmed,['route'=>'medico.store','method'=>'POST'])!!}
       {!!Form::radio('times_before','1',null,['onclick'=>'reminder_time_confirmed(1)'])!!}

        <label class="custom-control-label" for="customRadioInline1">1 Dia Antes</label>

        {!!Form::radio('times_before','2',null,['onclick'=>'reminder_time_confirmed(2)'])!!}
        <label class="custom-control-label" for="customRadioInline2">2 Dia Antes</label>

        {!!Form::radio('times_before','4',null,['onclick'=>'reminder_time_confirmed(4)'])!!}
        <label class="custom-control-label" for="customRadioInline3">4 dia antes</label>

    {!!Form::close()!!}
    </div>
@endif


{{-- <div class="row my-5">
  <div class="col-lg-10 col-12 align-items-center">
    <h6>¿Desea que las citas que han sido pagadas con anticipacion, se marquen como completadas automaticamente despues de pasar la fecha de la consulta?</h6>
  </div>
  <div class="col-lg-2 col-12">
    <div class="col-lg-2 col-12">
      <div class="radio-switch">
          @if($config_past_and_payment_auto != Null)
            @if ($config_past_and_payment_auto->options == Null or $config_past_and_payment_auto->options == 'No')

                 <label class="switch" style="display:block;margin-left:auto;">
                    {{Form::checkbox('name',$config_past_and_payment_auto->options, false,['onclick'=>'switch_payment_and_past(this)','id'=>$medico->id])}}
                    <span class="slider round text-white"><span class="ml-1">on</span> of</span>
                 </label>
             @else
                 <label class="switch" style="display:block;margin-left:auto;">
                    {{Form::checkbox('name',$config_past_and_payment_auto->options, true,['onclick'=>'switch_payment_and_past(this)','id'=>$medico->id])}}
                    <span class="slider round text-white"><span class="ml-1">on</span> of</span>
                 </label>
             @endif
          @endif

      </div>
    </div>
  </div>
</div> --}}
