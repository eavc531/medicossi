<div class="card">
    <div class="card-body">
        <div class="row">


    {{-- <input type="hidden" name="vital_sign_config_id" value="{{$test_labs->id}}"> --}}
    {{-- {{Form::model()}} --}}

    @foreach ($test_labs as $question)
        @if($question->show == 'on')
            <div class="col-4">
                <label for="" class="font-title">{{$question->name_question}}</label>
                  {{Form::text($question->question,$question->answer,['class'=>'form-control input-text',"id"=>"Altura"])}}
            </div>


        @endif
    @endforeach

    {{-- {{Form::close()}} --}}
    <div class="col-12">

        <button onclick="show_modal()" type="button" class="btn btn-secondary btn-sm float-right mt-3" data-toggle="modal">Editar Campos Pruebas de laboratorio</button>
    </div>

</div>

</div>
</div>
