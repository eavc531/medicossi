<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Recordatorio MédicosSi."</h2>
    <p><strong>Fecha:</strong>{{\Carbon\Carbon::now()->format('d-m-Y')}}</p>

    <h5>Un Cordial saludo: {{$medico->nameComplete}}, Este es un recordatorio creado por usted para la fecha: {{$record->start}} con los siguientes datos. </h5>

    <p><strong>Nombre de Recordatorio:</strong> {{$record->title}}</p>
    <p><strong>Descripción:</strong> @if($record->description != Null) {{$record->description}} @else "no aplcia" @endif</p>
    <p><strong>Fecha de Inicio:</strong> {{\Carbon\Carbon::parse($record->start)->format('d-m-Y')}}</p>
    <p><strong>Hora:</strong> {{\Carbon\Carbon::parse($record->start)->format('H:i')}}</p>
    <p>Feliz Día</p>

</body>
</html>
