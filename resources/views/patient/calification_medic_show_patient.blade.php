
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Calificación Médico: {{$medico->name}} {{$medico->lastName}}</h2>
  </div>
</div>

@if($rate_medic->first() != Null)
<div class="card">
  <h3>Calificación Total: @include('medico.star_rate_calification') de {{$medico->votes}} voto(s)</h3>
</div>
<div class="row">
  <div class="col-12 mb-3 mt-4">
    <h5 class="text-center">Calificación Otorgada por los Pacientes</h5>
  </div>
</div>

  @foreach ($rate_medic as $value)
    <div class="card mt-2">
      <div class="card-header">
        {{$value->patient['name']}} {{$value->patient['lastName']}}
      </div>
      <div class="card-body">
        <div class="form-inline">
          Puntaje otorgado:
          @include('medico.star_rate')
        </div>

      </div>
      <div class="card-footer">
        {{-- @if($value->show == 'Si') --}}
          <div class="" id="comentary">
            @if(isset($value->comentary) and $value->show == 'Si')
            <span style="">Comentario: {{$value->comentary}}</span>
            @else
              <span style="">Comentario: Sin Comentarios</span>
            @endif
          </div>
            </div>
    </div>
  @endforeach
  {{-- //pagiate_ajax --}}

  @if($rate_medic->count() == 5 or $page_calification > 1) {{-- //marcar --}}
  <div class="card-footer">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><button class="page-link" onclick="paginate_calification('Ant')">Ant.</button></li>{{-- //marcar --}}
        <input type="hidden" name="" value="{{$number = 0}}">
        @for ($i = 0; $i < $cant_page; $i++)
          <input type="hidden" name="" value="{{$page_calification}}" id="page_calificatione_exp">{{-- //marcar --}}
          <input type="hidden" name="" value="{{$number = $number + 1}}">
          @if($number == $page_calification)
            <li class="page-item"><button class="page-link  bg-primary text-white" onclick="paginate_calification('{{$number}}')">{{$number}}</button></li>{{-- //marcar --}}
          @else
            <li class="page-item"><button class="page-link" onclick="paginate_calification('{{$number}}')">{{$number}}</button></li>{{-- //marcar --}}
          @endif
        @endfor
        <li class="page-item"><button class="page-link" onclick="paginate_calification('Sig')">Sig.</button></li>{{-- //marcar --}}
      </ul>
    </nav>
  </div>
@endif
{{-- //pagiate_ajax --}}
@else
  <div class="text-center mt-5">
    <h3 class="text-primary"><strong>El Médico aun no ha sido Calificado</strong></h3>
  </div>
@endif

@if($rate_medic->count() > 5)
<div class="card-footer">
  <div class="mt-3">
      {{$rate_medic->links()}}
  </div>
</div>
@endif

{{-- <input type="button" name="btnPaciente"  id="idetest"
value="NombrePaciente" /> --}}



  <script type="text/javascript">



  </script>
