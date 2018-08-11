<input type="hidden" name="" value="{{$suma = 0}}">
<table>

    @foreach ($vital_signs as $question)

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
