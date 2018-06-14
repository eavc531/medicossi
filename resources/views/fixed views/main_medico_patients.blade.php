<hr>
<div class="row mb-2">
  <div class="col-lg-6 m-auto text-center">
    <div class="row">
      <div class="col-lg col-12 d-flex justify-content-center">
        <a href="{{route('medico_appointments_patient',['medico_id'=>$medico->id,'patient_id'=>$patient['id']])}}" class="btn btn-lg btn-menu-medico btn-menu-medico-azul" data-toggle="tooltip" data-placement="top" title="Ver citas"><i class="far fa-calendar-alt"></i></a>
        <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-lg btn-menu-medico btn-menu-medico-verde" data-toggle="tooltip" data-placement="top" title="Crear nota"><i class="fas fa-notes-medical"></i></a>
        <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient])}}" class="btn btn-lg btn-menu-medico btn-menu-medico-morado" data-toggle="tooltip" data-placement="top" title="Agendar cita"><i class="far fa-calendar-check"></i></a>
        <a href="{{route('medico_patients',$medico->id)}}" class="btn btn-lg btn-menu-medico btn-menu-medico-amarillo" data-toggle="tooltip" data-placement="top" title="Mis pacientes"><i class="fas fa-users"></i></a>
      </div>
    </div>
  </div>
</div>
<hr>
