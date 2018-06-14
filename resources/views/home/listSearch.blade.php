<div class="text-justify">
  @if($medicosCercCount != 0)
  <h3>Medicos</h3>
  <table class="table table-bordered">
    <thead class="bg-primary text-white">
      <tr>
        <td>Nombre Completo</td>
        <td>Especialidad</td>
        <td>Teléfonos</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($medicosCerc as $medico)
        <tr>
          <td>{{$medico->name}} {{$medico->lastName}}</td>
          <td>

          </td>

        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        {{-- <td>{{$medicos->links()}}</td> --}}
      </tr>
    </tfoot>
  </table>
  @endif
