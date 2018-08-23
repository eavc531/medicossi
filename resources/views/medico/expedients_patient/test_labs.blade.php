
<input type="hidden" name="" value="{{$suma = 0}}">
<table>

    @foreach ($test_labs as $question)

        @if($question->show == 'on')
            <input type="hidden" name="" value="{{$suma = $suma + 1}}">
            @if($suma%2!=0)
            <tr>
                <td width="500px">
                    <br>
                    <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
            @else
                <td width="500px">
                    <br>
                    <span class="font-title">{{$question->name_question}}: </span><span>{{$question->answer}}</span></td>
            </tr>
            @endif
        @endif
    @endforeach

</table>
{{-- <div class="row col-12">

    @foreach ($test_labs as $question)
        @if($question->show == 'on')
            <div class="col-6 p-1">

                  <p><span class="font-title">{{$question->name_question}}: </span>{{$question->answer}}</p>
            </div>


        @endif
    @endforeach
</div> --}}

{{-- <div class="" style="width:800px;border:solid 2px green;display:flex;flex-wrap:wrap;">
@foreach ($test_labs as $question)
        <div class="" style="width:350px;border:solid 1px red;margin-top:10px">
            xxxxx
        </div>
@endforeach

</div> --}}
