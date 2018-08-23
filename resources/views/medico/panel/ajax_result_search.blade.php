<strong class="mt-3 mb-3">Resultado:</strong>
@if ($patients->count() != 0)
  <div class="card mt-3" style="max-height:500px;overflow:scroll;overflow-x:hidden;">
    <table class="table table-bordered table-sm" >
      <thead class="bg-success text-white">
        <th>Cedula</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Estado</th>
        <th>Ciudad</th>
        <th>Acciones</th>
      </thead>
      <tbody>
        @foreach ($patients as $patient)
          <tr>
            <td>{{$patient->identification}}</td>
            <td>{{$patient->name}}</td>
            <td>{{$patient->lastName}}</td>
            <td>{{$patient->state}}</td>
            <td>{{$patient->city}}</td>
            <td><a href="{{route('medico_stipulate_appointment',['medico_id'=>\Hashids::encode($medico_id),'patient_id'=>\Hashids::encode($patient->id)])}}" class="btn btn-primary btn-sm">Agendar Cita</a></td>
          </tr>
        @endforeach

      </tbody>

    </table>
  </div>

@else
  <p>No se encontraron resultados</p>
@endif
