<div class="card mb-2">
    <div class="row justify-content-center">
        <a href="{{route('manage_patient',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-menu-medico btn-menu-medico-azul" data-toggle="tooltip" data-placement="top" title="Panel de Control Paciente">
            <i class="fas fa-tasks"></i>
             {{-- Paciente --}}
        </a>

            <a href="{{route('patient_appointments_all',['medico_id'=>\Hashids::encode($medico->id),'patient_id'=>\Hashids::encode($patient['id'])])}}" class="btn btn-menu-medico btn-menu-medico-azul" data-toggle="tooltip" data-placement="top" title="Citas Paciente">

                <i class="far fa-calendar-alt"><span style="font-size:11"></span></i>
                {{-- Citas --}}

            </a>
            @if($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
            <a href="{{route('notes_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-menu-medico btn-menu-medico-verde" data-toggle="tooltip" data-placement="top" title="Notas de Paciente">
                <i class="fas fa-notes-medical"></i><span style="font-size:11"></span>
                {{-- Notas --}}
             </a>
            <a href="{{route('expedients_patient',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-menu-medico btn-menu-medico-amarillo" data-toggle="tooltip" data-placement="top" title="Expedientes de Paciente">
                <i class="fas fa-folder"></i>
                {{-- Expedientes --}}
                <span style="font-size:11"></span>
            </a>

            <a href="{{route('medico_stipulate_appointment',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-menu-medico btn-menu-medico-morado" data-toggle="tooltip" data-placement="top" title="Agendar cita">
                <i class="far fa-calendar-check"></i><span style="font-size:11">
                    {{-- Agendar Cita --}}
                </span>
            </a>
            @endif
            <a href="{{route('patient_files',['m_id'=>\Hashids::encode($medico->id),'p_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-menu-medico btn-menu-medico-verde" data-toggle="tooltip" data-placement="top" title="Archivos de Paciente">
                <i class="fas fa-upload"></i><span style="font-size:11"></span>
                {{-- Archivos --}}
             </a>

            {{-- <a href="{{route('medico_patients',\Hashids::encode($medico->id))}}" class="btn-menu-medico btn-menu-medico-amarillo" data-toggle="tooltip" data-placement="top" title="Mis pacientes">
                <i class="fas fa-users"></i>

                <span style="font-size:11"></span>
            </a> --}}

            <a href="{{route('medico_diary',\Hashids::encode($medico->id))}}" class="btn btn-menu-medico btn-menu-medico-azul" data-toggle="tooltip" data-placement="top" title="Mi Agenda">
                <i class="fas fa-calendar-alt"></i>

                 <span style="font-size:11"></span>
             </a>
             @plan_platino

              @endplan_platino
    </div>
</div>
{{-- <hr>
<div class="row mb-2">
  <div class="col-lg-6 m-auto text-center">
    <div class="row">
      <div class="col-lg col-12 d-flex justify-content-center">















      </div>
    </div>
  </div>
</div>
<hr> --}}
