<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_vital_signs">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Configurar Campos Signos Vitales</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
           <div class="text-center">
               <p>Selecciona los Campos que deseas mostrar en signos Vitales</p>
           </div>
           {{Form::open(['route'=>'vital_sign_config_update','method'=>'POST','id'=>'vital_sign_config_update'])}}
           <div class="row p-1">
               <input type="hidden" name="note_id" value="{{$note->id}}">
              @foreach ($vital_signs as $test)
                  <div class="col-4 borde">

                      <div class="card mt-2 p-1">

                      @if($test->show == 'on')
                      <label for="">{{Form::checkbox($test->question,null,true)}} {{$test->name_question}}</label>
                  @else
                       <label for="">{{Form::checkbox($test->question,null,false)}} {{$test->name_question}}</label>
                        @endif
                    </div>
                                        </div>
              @endforeach
          </div>

          <div class="text-right">
              @if(Route::currentRouteName() == 'note_config')
                  <a href="{{route('medico_test_labs',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id,'back'=>Route::currentRouteName()])}}" class="btn btn-success btn-sm">Agregar Eliminar nuevos Campos a la lista</a>
              @else
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Agregar Eliminar nuevos Campos a la lista
                  </button>
              @endif


          </div>
       </div>
       <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            {{Form::close()}}
       </div>
        </div>
     </div>
  </div>

  <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p class="text-danger">Para Agregar o eliminar campos de la lista "Signos vitales" debera salir del panel actual,se perderan los datos no guardados de la nota actual, le invitamos a antes guardar la nota e ingresar al panel configuracion de "{{$note->title}}" para realizar esta accción, podra utilizar los campos agregados en la creación y edición de notas.Tambien puede continuar y configurar por este medio aceptando las consecuencias.</p>
          <p>¿Que desea hacer?</p>
          <div class="text-center">

              <a href="{{route('medico_vital_signs',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id,'back'=>Route::currentRouteName()])}}" class="btn btn-success">Aceptar y Continuar</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>

      </div>

    </div>
  </div>
</div>
