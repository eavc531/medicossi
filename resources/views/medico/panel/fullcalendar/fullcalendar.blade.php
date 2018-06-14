@extends('layouts.app')
@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.min.css')}}">
  {{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}
  <style>

    body {
      margin: 40px 10px;
      padding: 0;
      font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
      font-size: 14px;
    }

    #calendar {
      max-width: 900px;
      margin: 0 auto;
    }

  </style>
@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}
@section('content')

  <div id='calendar' style="margin:50px;width:700px"></div>

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('scriptJS')
  <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script>
  <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
  <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
  <script src='{{asset('fullcalendar/locale/es.js')}}'></script>
  <script type="text/javascript">

    $(document).ready(function(){
      var BASEURL = "{{url('/')}}";
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listWeek'
        },
        // defaultDate: '2018-03-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: "{{route('events')}}"
      });

    });

  </script>
@endsection
