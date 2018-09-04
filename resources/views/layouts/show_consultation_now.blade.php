<div class="text-right mb-4">
    @if(Auth::check() and Auth::user()->medico->event_id != Null)
        <div class="" id="div_consulta_abierta">
                                    <div class="dropdown">
         <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <strong class="text-primary">Realizando Consulta:</strong> <span class="text-success" style="">{{Auth::user()->medico->event->title}}
          {{Auth::user()->medico->event->start}}</span>
          <div class="">
              <strong class="text-primary">Paciente:</strong> <span class="text-success" style="">{{Auth::user()->medico->event->namePatient}}
           </span>
          </div>
         </button>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


           <a class="dropdown-item" href="{{route('ending_appointment',['id'=>\Hashids::encode(Auth::user()->medico->event->medico_id),'p_id'=>\Hashids::encode(Auth::user()->medico->event->patient_id),'app_id'=>\Hashids::encode(Auth::user()->medico->event_id)])}}">Editar/Finalizar Consulta</a>
         </div>
        </div>


        </div>

    @endif
</div>
