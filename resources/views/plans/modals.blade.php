

<!-- Modal information-->
<div class="modal fade" id="information" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h4>qloq</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Agradecemos y respetamos mucho tu preferencia hacia con nosotros y es por eso que en este paquete <b>PLATINO PLUS</b> queremos pedirte que nos des la oportunidad de promoverte como minimo 6 meses de forma completa como lo señala el paquete, esto para integrarte a nuestras campañas de marqueting y de una forma profesional puedas ver los resultados.
        <p><strong style="color:rgb(173, 47, 16)">Nota de programador</strong></p>

          <p style="color:rgb(173, 47, 16)">Por Ahora no realiza pagos pero es posible asignar el plan seleccionado</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Asignar Plan Platino</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

{{-- ///////////////modals atencion --}}
<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Atencion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($plan_actual != Null)
          <p>Actualmente Posee activo el plan: {{$plan_actual->name}},con fecha de vencimiento: {{\Carbon\Carbon::parse($plan_actual->date_end)->format('d-m-Y')}}. </p>
          <p><strong>¿Esta segur@ de Querer contratar otro Plan?</strong></p>
        @endif
      </div>
      <div class="modal-footer">
          @if(Auth::user()->role == 'medico')

                <a href="{{route('plan_agenda_contract',Auth::user()->medico_id)}}" class="btn btn-primary btn-block">Contratar</a>

         @else

               <a href="{{route('plan_agenda_contract',Auth::user()->assistant->medico_id)}}" class="btn btn-primary btn-block">Contratar</a>

         @endif


      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Atencion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($plan_actual != Null)
        <p>Actualmente Posee activo el plan: {{$plan_actual->name}},con fecha de vencimiento: {{\Carbon\Carbon::parse($plan_actual->date_end)->format('d-m-Y')}}. </p>
        <p><strong>¿Esta segur@ de Querer contratar otro Plan?</strong></p>
          @endif
      </div>
      <div class="modal-footer">
          @if(Auth::user()->role == 'medico')
              <a href="{{route('plan_profesional_contract',Auth::user()->medico_id)}}" class="btn btn-primary">Contratar</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
         @else
             <a href="{{route('plan_profesional_contract',Auth::user()->assistant->medico_id)}}" class="btn btn-primary">Contratar</a>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
         @endif


      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal33" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Atencion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($plan_actual != Null)
        <p>Actualmente Posee activo el plan: {{$plan_actual->name}},con fecha de vencimiento: {{\Carbon\Carbon::parse($plan_actual->date_end)->format('d-m-Y')}}. </p>
        <p><strong>¿Esta segur@ de Querer contratar otro Plan?</strong></p>
          @endif
      </div>

      <div class="modal-footer">
          @if(Auth::user()->role == 'medico')
              <a href="{{route('plan_platino_contract',Auth::user()->medico_id)}}" class="btn btn-primary">Aceptar</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
         @else
             <a href="{{route('plan_platino_contract',Auth::user()->assistant->medico_id)}}" class="btn btn-primary">Aceptar</a>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
         @endif


      </div>
    </div>
  </div>
</div>
