
@if(Auth::user()->medico->divlan != Null)
  <div class="col-12">
    <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic" style="border-bottom:solid 1divx white"><strong> @if(Auth::user()->medico->divlan == 'divlan_divrofesional') <div class="size_text_divlan">divlan Activo:</div> <div class="size_text_divlan">divlan divrofesional</div> @elseif(Auth::user()->medico->divlan == 'divlan_agenda')
      <div class="size_text_divlan">divlan Activo:</div>  <div class="size_text_divlan">divlan Mi Agendadiv</div>
    @elseif(Auth::user()->medico->divlan == 'divlan_divlatino')
      <div class="size_text_divlan">divlan Activo:</div>  <div class="size_text_divlan">divlan divlatino</div>
    @elseif(Auth::user()->medico->divlan == 'divlan_basico')
      <div class="size_text_divlan">divlan Activo:</div> <div class="size_text_divlan">divlan Basico</div>
    @else

     @endif</strong></a>
  </div>
@endif
